<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Company;
use App\Models\Customer;
use App\Models\QuotationPolicy;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Policy;
use App\Models\RenewalComment;
use App\Models\RenewalContactHistory;
use App\Models\RenewalPolicies;
use App\Models\Statement;
use Illuminate\Support\Facades\Auth;
use App\Models\QuotationPolicyData;
use App\Models\DispatchPolicies;

class RenewalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {

       

        $filter                = [];
        $filter['policy_no']   = $request->policy_no;
        $filter['customer_id'] = $request->customer_id;
        $filter['exp_date']  = $request->exp_date;
        $filter['status']      = $request->status;

        $renewals = RenewalPolicies::with('policy', 'quotation', 'customer');
        if(isset($filter['policy_no']))
        {
            $policy_id = QuotationPolicyData::where('meta_key','policy_no')->where('meta_value',  'LIKE', "%{$filter['policy_no']}%")->pluck('policy_id');

            $renewals = isset($filter['policy_no']) ?   $renewals->whereIn('policy_id', $policy_id ) :  $renewals;
        }
        $renewals = isset($filter['customer_id']) ?  $renewals->where('customer_id', $filter['customer_id']) :  $renewals;
        if(isset($filter['exp_date']))
        {

            $policy_id = QuotationPolicy::where('expiry_date', $filter['exp_date'])->pluck('id');
            $renewals = isset($filter['exp_date']) ?  $renewals->whereIn('policy_id', $policy_id) :  $renewals;
        }

        $renewals  = isset($filter['status']) ?  $renewals->where('status', $filter['status']) :  $renewals;

        $renewals = $renewals->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.renewal.list', compact('renewals','filter'));
    }

    public function showRenewal($id)
    {
        $renewal = RenewalPolicies::where('id', $id)->with('policy', 'quotation', 'customer')->first();
        $users = Administrator::whereNotIn('id', [1])->get();
        return view('admin.renewal.show', compact('renewal', 'users'));
    }

    public function renewalTransfer(Request $request)
    {
        RenewalPolicies::find($request->renewal_id)->update([
            'user_id' => $request->user_id
        ]);
        return response()->json([
            'success' => 'Renewal has been successfully transfered!'
        ]);
    }

    public function destroyRenewal(string $id)
    {
        RenewalPolicies::find($id)->delete();
        return redirect()->route('admin.renewal.list')->with('success', 'Renewal deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        RenewalPolicies::whereIn('id', $request->leads)->delete();
        return response()->json(['success' => 'Renewal deleted successfully!'], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        RenewalPolicies::find($id)->update(['status' => $request->status]);

        $renewal = RenewalPolicies::find($id);

        if ($request->status == "Contacted" || $request->status == "Nurturing") {
            switch ($request->contacted_via) {
                case 'Via Phone':
                    $history =  RenewalContactHistory::create([
                        'renewal_id'                    => $renewal->id,
                        'contacted_via'                 => $request->contacted_via,
                        'caller_name'                   => $request->caller_name,
                        'receiver_name'                 => $request->receiver_name,
                        'calling_date'                  => $request->calling_date,
                        'calling_time'                  => $request->calling_time,
                        'subject'                       => $request->subject,
                        'comment'                       => $request->comment,
                        'attachment_call_recording'     => null,
                        'follow_up_date'                => $request->follow_up_date,
                        'follow_up_time'                => $request->follow_up_time,
                        'added_by'                      => Auth::guard('administrator')->user()->id,
                    ]);
                    if ($request->hasfile('attachment_call_recording')) {

                        $attachment_call_recording             = $request->file('attachment_call_recording');

                        $attachment_call_recording_name        = $attachment_call_recording->getClientOriginalName();

                        $attachment_call_recording->storeAs('uploads/renewal/' . $renewal->id . '/' . 'history', $attachment_call_recording_name, 'public');

                        RenewalContactHistory::find($history->id)->update(['attachment_call_recording' => $attachment_call_recording_name]);
                    }
                    break;

                case 'Via Email':
                    $history =  RenewalContactHistory::create([
                        'renewal_id'                       => $renewal->id,
                        'contacted_via'                 => $request->contacted_via,
                        'email_sent_date'               => $request->email_sent_date,
                        'email_sender_id'               => $request->email_sender_id,
                        'email_receiver_id'             => $request->email_receiver_id,
                        'email_subject'                 => $request->email_subject,
                        'email_body'                    => $request->email_body,
                        'attachment_email'              => null,
                        'follow_up_date'                => $request->follow_up_date,
                        'follow_up_time'                => $request->follow_up_time,
                        'added_by'                      => Auth::guard('administrator')->user()->id,
                    ]);
                    if ($request->hasfile('attachment_email')) {

                        $attachment_email             = $request->file('attachment_email');

                        $attachment_email_name        = $attachment_email->getClientOriginalName();

                        $attachment_email->storeAs('uploads/renewal/' . $renewal->id . '/' . 'history', $attachment_email_name, 'public');

                        RenewalContactHistory::find($history->id)->update(['attachment_email' => $attachment_email_name]);
                    }
                    break;

                case 'Via WhatsApp':
                    $history =  RenewalContactHistory::create([
                        'renewal_id'                       => $renewal->id,
                        'contacted_via'                 => $request->contacted_via,
                        'message_date'                  => $request->message_date,
                        'whats_app_from'                => $request->whats_app_from,
                        'whats_app_from_dialcode'       => $request->whats_app_from_dialcode,
                        'whats_app_to'                  => $request->whats_app_to,
                        'whats_app_to_dialcode'         => $request->whats_app_to_dialcode,
                        'whatsapp_message'              => $request->whatsapp_message,
                        'attachment_whatsapp'           => null,
                        'follow_up_date'                => $request->follow_up_date,
                        'follow_up_time'                => $request->follow_up_time,
                        'added_by'                      => Auth::guard('administrator')->user()->id,
                    ]);
                    if ($request->hasfile('attachment_whatsapp')) {

                        $attachment_whatsapp             = $request->file('attachment_whatsapp');

                        $attachment_whatsapp_name        = $attachment_whatsapp->getClientOriginalName();

                        $attachment_whatsapp->storeAs('uploads/renewal/' . $renewal->id . '/' . 'history', $attachment_whatsapp_name, 'public');

                        RenewalContactHistory::find($history->id)->update(['attachment_whatsapp' => $attachment_whatsapp_name]);
                    }
                    break;

                case 'Via Meet':
                    $history =  RenewalContactHistory::create([
                        'renewal_id'                       => $renewal->id,
                        'contacted_via'                 => $request->contacted_via,
                        'who_meet'                      => $request->who_meet,
                        'whom_meet'                     => $request->whom_meet,
                        'meeting_date'                  => $request->meeting_date,
                        'meeting_time'                  => $request->meeting_time,
                        'meeting_location'              => $request->meeting_location,
                        'meeting_discussion'            => $request->meeting_discussion,
                        'follow_up_date'                => $request->follow_up_date,
                        'follow_up_time'                => $request->follow_up_time,
                        'added_by'                      => Auth::guard('administrator')->user()->id,
                    ]);
                    break;

                default:
                    # code...
                    break;
            }
        }

        return redirect()->back()->with('success', 'Renewal Status updated successfully!');
    }

    public function convertRenewal(Request $request, $id)
    {
        $ren = RenewalPolicies::find($id);

        $cus = $ren->customer;
        $lead               = $cus;
        $customer_exists    = Customer::where('phone', $cus?->phone)->exists();
        $customer           = $customer_exists ? Customer::where('phone', $cus?->phone)->first() : [];
        $policies           = Policy::get();
        $companies          = Company::get();
        $pid = $ren->policy?->id;
        $policy_id            =  policy_data($pid, 'policy_id');
        $policy_type_id       =  policy_data($pid, 'policy_type_id');
        $service_executive_id =  policy_data($pid, 'service_executive_id');
        $description          =  policy_data($pid, 'description');
        $sales_executive_id   =  policy_data($pid, 'sales_executive_id');
        $renewal              =  1;

        return view('admin.quotations.convert', compact('lead', 'customer_exists', 'customer', 'policies', 'companies', 'policy_id', 'policy_type_id', 'service_executive_id', 'description', 'sales_executive_id', 'renewal'));
    }

    public function contactHistory($id)
    {
        $renewal = RenewalPolicies::find($id);
        return view('admin.renewal.contact-history', compact('renewal'));
    }

    public function addComment($id, Request $request)
    {

        $this->validate($request, [
            'comment' => 'required'
        ]);

        RenewalComment::create([
            'renewal_id' => $id,
            'comment' => $request->comment,
            'comment_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.renewal.show', $id)->with('success', 'Comment saved successfully!');
    }
}
