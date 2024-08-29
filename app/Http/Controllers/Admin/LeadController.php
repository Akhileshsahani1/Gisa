<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\LeadImport;
use App\Models\Administrator;
use App\Models\Company;
use App\Models\Customer;
use App\Models\DropdownValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Models\LeadAttachment;
use App\Models\LeadComment;
use App\Models\LeadContactHistory;
use App\Models\Policy;
use App\Models\LeadFollowup;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {
        $filter  = [];
        $filter['id']                           = $request->id;
        $filter['lead_type']                    = $request->lead_type;
        $filter['name']                         = $request->name;
        $filter['phone']                        = $request->phone;
        $filter['whats_app']                    = $request->whats_app;
        $filter['email']                        = $request->email;
        $filter['gender']                       = $request->gender;
        $filter['address']                      = $request->address;
        $filter['lead_source']                  = $request->lead_source;
        $filter['assigned_to']                  = $request->assigned_to;
        $filter['lead_status']                  = $request->lead_status;
        $filter['policy_id']                    = $request->policy_id;
        $filter['policy_type_id']               = $request->policy_type_id;
        $filter['previous_policy_expiry_date']  = $request->previous_policy_expiry_date;
        $filter['by_time']                      = $request->by_time;
        $filter['created_at']                   = $request->created_at;

        $leads                                  = Lead::query();

        $leads                                  = isset($filter['id']) ? $leads->where('id', $filter['id']) : $leads;
        $leads                                  = isset($filter['name']) ? $leads->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $filter['name'] . '%') : $leads;
        $leads                                  = isset($filter['phone']) ? $leads->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $leads;
        $leads                                  = isset($filter['whats_app']) ? $leads->where('whats_app', 'LIKE', '%' . $filter['whats_app'] . '%') : $leads;
        $leads                                  = isset($filter['email']) ? $leads->where('email', 'LIKE', '%' . $filter['email'] . '%') : $leads;
        $leads                                  = isset($filter['lead_type']) ? $leads->where('lead_type', 'LIKE', '%' . $filter['lead_type'] . '%') : $leads;
        $leads                                  = isset($filter['gender']) ? $leads->where('gender', $filter['gender']) : $leads;
        $leads                                  = isset($filter['address']) ? $leads->where('address', 'LIKE', '%' . $filter['address'] . '%') : $leads;
        $leads                                  = isset($filter['lead_source']) ? $leads->where('lead_source', $filter['lead_source']) : $leads;
        $leads                                  = isset($filter['assigned_to']) ? $leads->where('assigned_to', $filter['assigned_to']) : $leads;
        $leads                                  = isset($filter['lead_status']) ? $leads->where('lead_status', $filter['lead_status']) : $leads;
        $leads                                  = isset($filter['policy_id']) ? $leads->where('policy_id', $filter['policy_id']) : $leads;
        $leads                                  = isset($filter['policy_type_id']) ? $leads->where('policy_type_id', $filter['policy_type_id']) : $leads;
        $leads                                  = isset($filter['previous_policy_expiry_date']) ? $leads->where('previous_policy_expiry_date', $filter['previous_policy_expiry_date']) : $leads;
        $leads                                  = isset($filter['created_at']) ? $leads->whereDate('created_at', $filter['created_at']) : $leads;
        $leads                                  = isset($filter['by_time']) &&  $filter['by_time'] == 'This Week' ? $leads->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]) : $leads;
        $leads                                  = isset($filter['by_time']) &&  $filter['by_time'] == 'This Month' ? $leads->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]) : $leads;
        if(auth()->user()->id == 1){
            $leads                                  = $leads->orderBy('seen_by')->paginate(30);
        }else{
            $leads                                  = $leads->where('assigned_to', auth()->user()->id)->orderBy('seen_by')->paginate(30);
        }
        $users                                  = Administrator::get(['id', 'firstname', 'lastname']);
        $policies                               = Policy::where('enabled', true)->get();
         //dd($leads);
        return view('admin.leads.list', compact('leads', 'filter', 'users', 'policies',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dropdown = dropdowns();
        $policies = Policy::where('enabled', true)->get();
        $users    = Administrator::get(['id', 'firstname', 'lastname']);
        return view('admin.leads.create', compact('policies', 'users','dropdown'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'lead_type'                       => ['required'],
            'salutation'                      => ['required'],
            'firstname'                       => ['required'],
            'lastname'                        => ['required'],
            'phone'                           => ['required'],
            'whats_app'                       => ['required'],
            'email'                           => ['required'],
            'gender'                          => ['required'],
            'address'                         => ['required'],
            'lead_source'                     => ['required'],
            'assigned_to'                     => ['required'],
            'lead_status'                     => ['required'],
            'company_name'                    => $request->salutation == 'M/s.' ? 'required' : '',
            'company_phone'                   => $request->salutation == 'M/s.' ? 'required' : '',
            // 'policy_id'                       => ['required'],
            // 'policy_type_id'                  => ['required'],
            // 'previous_policy_expiry_date'     => ['required'],
        ];

        $messages = [
            'lead_type.required'                     => 'Please choose Lead type',
            'salutation.required'                    => 'Please choose Title',
            'firstname.required'                     => 'Please enter Firstname',
            'lastname.required'                      => 'Please enter Lastname',
            'phone.required'                         => 'Please enter Phone Number',
            'whats_app.required'                     => 'Please enter Whatsapp Number',
            'email.required'                         => 'Please enter Email ID',
            'gender.required'                        => 'Please choose Gender',
            'date_of_birth.required'                 => 'Please choose Date of Birth',
            'address.required'                       => 'Please enter Address',
            'lead_source.required'                   => 'Please choose Lead Source',
            'assigned_to.required'                   => 'Please choose Assigned User',
            'lead_status.required'                   => 'Please choose Lead Status',
            'policy_id.required'                     => 'Please choose Policy',
            'policy_type_id.required'                => 'Please choose Policy type',
            'previous_policy_expiry_date.required'   => 'Please choose Previous Policy Expiry Date',
            'company_name.required'                  => 'Please enter company name',
            'company_phone.required'                 => 'Please enter company phone',
        ];

        $this->validate($request, $rules, $messages);

        $lead = Lead::create([
            'lead_type'                             =>  $request->lead_type,
            'salutation'                            =>  $request->salutation,
            'firstname'                             =>  $request->firstname,
            'lastname'                              =>  $request->lastname,
            'phone'                                 =>  $request->phone,
            'whats_app'                             =>  $request->whats_app,
            'email'                                 =>  $request->email,
            'gender'                                =>  $request->gender,
            'date_of_birth'                         =>  $request->date_of_birth,
            'address'                               =>  $request->address,
            'lead_source'                           =>  $request->lead_source,
            'assigned_to'                           =>  $request->assigned_to,
            'lead_status'                           =>  $request->lead_status,
            'policy_id'                             =>  $request->policy_id,
            'policy_type_id'                        =>  $request->policy_type_id,
            'previous_policy_expiry_date'           =>  $request->previous_policy_expiry_date,
            'special_remark'                        =>  $request->special_remark,
            'company_name'                          =>  $request->company_name,
            'company_phone'                         =>  $request->company_phone,
        ]);

        // if ($request->hasfile('documents')) {
        //     foreach ($request->file('documents') as $file) {
        //         $document_name = time() . rand(1, 50) . '.' . $file->extension();
        //         $file->storeAs('uploads/leads/' . $lead->id . '/attachments', $document_name, 'public');
        //         LeadAttachment::create([
        //             'lead_id' => $lead->id,
        //             'name'     => $document_name
        //         ]);
        //     }
        // }
        if($request->has('documents')){
            foreach($request->documents as $data){
              LeadAttachment::create([
                    'lead_id' => $lead->id,
                    'name'    => $data['document'],
                    'title'   => $data['title'],
                ]);
            }

        }


        return redirect()->route('admin.leads.index')->with('success', 'Lead created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $lead     = Lead::find($id);

        $seen = (Auth::user()->id == $lead->assigned_to) ? Auth::user()->id : '';
        $lead->seen_by = $seen;
        $lead->save();

        $users    = Administrator::get(['id', 'firstname', 'lastname']);
        $service_exceutives  = Administrator::with("roles")
                                ->whereHas("roles", function($q) {
                                $q->whereIn("name", ["Service Executive"]);
                                })->get(['id', 'firstname', 'lastname']);

        return view('admin.leads.show', compact('lead', 'users','service_exceutives'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dropdown = dropdowns();
        $policies = Policy::where('enabled', true)->get();
        $users    = Administrator::get(['id', 'firstname', 'lastname']);
        $lead     = Lead::find($id);
        return view('admin.leads.edit', compact('policies', 'lead', 'users','dropdown'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'lead_type'                       => ['required'],
            'salutation'                      => ['required'],
            'firstname'                       => ['required'],
            'lastname'                        => ['required'],
            'phone'                           => ['required'],
            'whats_app'                       => ['required'],
            'email'                           => ['required'],
            'gender'                          => ['required'],
            //'date_of_birth'                   => ['required'],
            'address'                         => ['required'],
            'lead_source'                     => ['required'],
            'assigned_to'                     => ['required'],
            'lead_status'                     => ['required'],
            'company_name'                    => $request->salutation == 'M/s.' ? 'required' : '',
            'company_phone'                   => $request->salutation == 'M/s.' ? 'required' : '',
            // 'policy_id'                       => ['required'],
            // 'policy_type_id'                  => ['required'],
            // 'previous_policy_expiry_date'     => ['required'],
        ];

        $messages = [
            'lead_type.required'                     => 'Please choose Lead type',
            'salutation.required'                    => 'Please choose Title',
            'firstname.required'                     => 'Please enter Firstname',
            'lastname.required'                      => 'Please enter Lastname',
            'phone.required'                         => 'Please enter Phone Number',
            'whats_app.required'                     => 'Please enter Whatsapp Number',
            'email.required'                         => 'Please enter Email ID',
            'gender.required'                        => 'Please choose Gender',
            'date_of_birth.required'                 => 'Please choose Date of Birth',
            'address.required'                       => 'Please enter Address',
            'lead_source.required'                   => 'Please choose Lead Source',
            'assigned_to.required'                   => 'Please choose Assigned User',
            'lead_status.required'                   => 'Please choose Lead Status',
            'policy_id.required'                     => 'Please choose Policy',
            'policy_type_id.required'                => 'Please choose Policy type',
            'previous_policy_expiry_date.required'   => 'Please choose Previous Policy Expiry Date',
            'company_name.required'                  => 'Please enter company name',
            'company_phone.required'                 => 'Please enter company phone',
        ];

        $this->validate($request, $rules, $messages);

        $lead = Lead::find($id)->update([
            'lead_type'                             =>  $request->lead_type,
            'salutation'                            =>  $request->salutation,
            'firstname'                             =>  $request->firstname,
            'lastname'                              =>  $request->lastname,
            'phone'                                 =>  $request->phone,
            'whats_app'                             =>  $request->whats_app,
            'email'                                 =>  $request->email,
            'gender'                                =>  $request->gender,
            'date_of_birth'                         =>  $request->date_of_birth,
            'address'                               =>  $request->address,
            'lead_source'                           =>  $request->lead_source,
            'assigned_to'                           =>  $request->assigned_to,
            'lead_status'                           =>  $request->lead_status,
            'policy_id'                             =>  $request->policy_id,
            'policy_type_id'                        =>  $request->policy_type_id,
            'previous_policy_expiry_date'           =>  $request->previous_policy_expiry_date,
            'special_remark'                        =>  $request->special_remark,
            'company_name'                          =>  $request->company_name,
            'company_phone'                         =>  $request->company_phone,
        ]);

        // if ($request->hasfile('documents')) {
        //     foreach ($request->file('documents') as $file) {
        //         $document_name = time() . rand(1, 50) . '.' . $file->extension();
        //         $file->storeAs('uploads/leads/' . $id . '/attachments', $document_name, 'public');
        //         LeadAttachment::create([
        //             'lead_id' => $id,
        //             'name'     => $document_name
        //         ]);
        //     }
        // }
        if($request->has('documents')){
            LeadAttachment::where('lead_id',$id)->delete();
            foreach($request->documents as $data){
              LeadAttachment::create([
                    'lead_id' => $id,
                    'name'    => $data['document'],
                    'title'   => $data['title'],
                ]);
            }

        }

        return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Lead::find($id)->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        Lead::whereIn('id', $request->leads)->delete();
        return response()->json(['success' => 'Leads deleted successfully!'], 200);
    }

    public function transfer(Request $request)
    {
        $lead                       = Lead::find($request->lead_id);
        $lead->assigned_to          = $request->assigned_to;
        $lead->timestamps           = false;
        $lead->save();

        return response()->json(['success' => 'Lead transferred successfully!']);
    }

    public function convertLead(Request $request,$id)
    {
        $data               =session('data');
        $lead               = Lead::find($id);
        $customer_exists    = Customer::where('phone', $lead->phone)->exists();
        $customer           = $customer_exists ? Customer::where('phone', $lead->phone)->first() : [];
        $policies           = Policy::get();
        $companies          = Company::get();
        $policy_id            = $data['policy_id'];
        $policy_type_id       = $data['policy_type_id'];
        $service_executive_id = $data['service_executive_id'];
        $description          = $data['description'];
        $sales_executive_id   = $data['sales_executive_id'];
        $renewal              = $data['renewal'];
        
        return view('admin.quotations.convert', compact('lead', 'customer_exists', 'customer', 'policies','companies','policy_id','policy_type_id','service_executive_id','description','sales_executive_id','renewal'));
    }

    public function updateStatus(Request $request, $id)
    {
        Lead::find($id)->update(['lead_status' => $request->lead_status]);

        $lead = Lead::find($id);

        if ($request->lead_status == "Contacted" || $request->lead_status == "Nurturing") {
            switch ($request->contacted_via) {
                case 'Via Phone':
                    $history =  LeadContactHistory::create([
                        'lead_id'                       => $lead->id,
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

                        $attachment_call_recording->storeAs('uploads/leads/' . $lead->id . '/' . 'history', $attachment_call_recording_name, 'public');

                        LeadContactHistory::find($history->id)->update(['attachment_call_recording' => $attachment_call_recording_name]);
                    }
                    break;

                case 'Via Email':
                    $history =  LeadContactHistory::create([
                        'lead_id'                       => $lead->id,
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

                        $attachment_email->storeAs('uploads/leads/' . $lead->id . '/' . 'history', $attachment_email_name, 'public');

                        LeadContactHistory::find($history->id)->update(['attachment_email' => $attachment_email_name]);
                    }
                    break;

                case 'Via WhatsApp':
                    $history =  LeadContactHistory::create([
                        'lead_id'                       => $lead->id,
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

                        $attachment_whatsapp->storeAs('uploads/leads/' . $lead->id . '/' . 'history', $attachment_whatsapp_name, 'public');

                        LeadContactHistory::find($history->id)->update(['attachment_whatsapp' => $attachment_whatsapp_name]);
                    }
                    break;

                case 'Via Meet':
                    $history =  LeadContactHistory::create([
                        'lead_id'                       => $lead->id,
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

        return redirect()->back()->with('success', 'Lead Status updated successfully!');
    }

    public function contactHistory($id){
        $lead = Lead::find($id);
        return view('admin.leads.contact-history', compact('lead'));
    }

    public function importView(){
        return view('admin.leads.import');
    }

    public function import(Request $request){
        $this->validate($request, [
            'file' => 'required'
        ]);

        Excel::import(new LeadImport(), request()->file('file'));
        return redirect()->back()->with('success', 'Leads imported successfully!');
    }
    public function bulkAssignUser(Request $request){

        Lead::whereIn('id', $request->leads)->update(['assigned_to' => $request->user_id]);
        return response()->json(['success' => 'User Assign successfully!'], 200);
    }
    public function addComment($id,Request $request){
        $this->validate($request, [
            'comment' => 'required'
        ]);

        LeadComment::create([
            'lead_id' => $id,
            'comment' => $request->comment,
            'comment_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.leads.show',$id)->with('success', 'Comment saved successfully!');
    }
    public function leadType(Request $request){

        $status = ( $request->type != 'in') ? 'inword' : 'outword';
        Lead::where('id',$request->lead_id)->update(['customer_type'=>$status]);
        return response()->json([
            'status_code' => 200,
            'message' => 'Status updated successfully'
        ]);
    }
    public function quoteRequest(Request $request,$id){
       
       
        $data['policy_id']            = $request->policy_id;
        $data['policy_type_id']       = $request->policy_type_id;
        $data['service_executive_id'] = $request->service_executive_id;
        $data['description']          = $request->description;
        $data['sales_executive_id']   = Auth::user()->id;
        $data['renewal']          = $request->has('renewal')?$request->has('renewal'):'';
        session(['data' => $data]);
        return redirect()->route('admin.leads.convert',$id);
    }
    public function saveFollow(Request $request,$id){
         
        if($request->follow_up_id > 0){
          $follow   = LeadFollowup::find($request->follow_up_id);
        }else{
          $follow   = new LeadFollowup();
          $follow->added_by       = Auth::user()->id;
        }
        $follow->lead_id = $id;
        $follow->contacted_via  = $request->contacted_via;
        $follow->follow_up_date = $request->follow_up_date;
        $follow->follow_up_time = $request->follow_up_time;
        $follow->comment        = $request->comment;
        $follow->save();
        return redirect()->back()->with('success', 'Follow Saved successfully!');
    }
    public function deleteFollow($id){
       $follow   = LeadFollowup::find($id)->delete();

       return redirect()->back()->with('success', 'Follow Deleted successfully!');
    }
    public function showFollow($id){
      $lead      = Lead::find($id);
      $follows   = LeadFollowup::where('lead_id',$id)->paginate(20);

      return view('admin.leads.show-follows', compact('follows','lead'));
    }
}
