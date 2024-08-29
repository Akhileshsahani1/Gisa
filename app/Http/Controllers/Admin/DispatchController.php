<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\DispatchData;
use App\Models\DispatchPolicies;
use App\Models\InsuranceCompany;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\QuotationPolicy;
use App\Models\DropdownValue;
use Illuminate\Http\Request;
use App\Models\QuotationPolicyData;

class DispatchController extends Controller
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
        
        $filter                = [];
        $filter['policy_no']   = $request->policy_no;
        $filter['customer_id'] = $request->customer_id;
        $filter['created_at']  = $request->created_at;
        $filter['status']      = $request->status;

        $dispatches = DispatchPolicies::query();
        if(isset($filter['policy_no']))
        {
            $policy_id = QuotationPolicyData::where('meta_key','policy_no')->where('meta_value',  'LIKE', "%{$filter['policy_no']}%")->pluck('policy_id');

            $dispatches = isset($filter['policy_no']) ?   $dispatches->whereIn('policy_id', $policy_id ) :  $dispatches;
        }
        $dispatches = isset($filter['customer_id']) ? $dispatches->where('customer_id', $filter['customer_id']) : $dispatches;
        $dispatches = isset($filter['created_at']) ? $dispatches->where('created_at', $filter['created_at']) : $dispatches;

        if( $filter['status'] == 'Filled' || $filter['status'] == 'Pending')
        {

            $dispatches = isset($filter['status']) ?  DispatchPolicies::where('status', $filter['status']):$dispatches;
        }
        if($filter['status'] == 'Generated') {
            $policy_id = QuotationPolicy::where('status',$filter['status'])->pluck('id');
            $dispatches = isset($filter['status']) ? $dispatches->whereIn('policy_id', $policy_id) : $dispatches;
        }

        if (isset($dispatches))
            foreach ($dispatches as $dispatch) {
                $data = dispatch_data($dispatch->id);
                $dispatch->data = $data ? json_encode(dispatch_data($dispatch->id)) : "";
            }

        $dispatches =$dispatches->orderBy('created_at', 'DESC')->paginate(10);
        $members = Administrator::where('id', '!=', 1)->get();
        
        $companies = DropdownValue::where('type','courier-company')->where('status', true)->get();
        return view('admin.dispatch.list', compact('dispatches', 'members', 'companies','filter'));
    }

    public function fillDispatchForm($id)
    {

        $dispatch = DispatchPolicies::find($id);
        $policy   = QuotationPolicy::find($dispatch->policy_id);
        $quotation = Quotation::find($dispatch->policy?->quotation_id);
        $members = Administrator::where('id', '!=', 1)->get();
        $companies = DropdownValue::where('type','courier-company')->where('status', true)->get();
        //  dd(dispatch_data($id));
        return view('admin.dispatch.fill-dispatch', compact('dispatch', 'policy', 'quotation', 'members', 'companies'));
    }

    public function addDispatchData(Request $request)
    {
        $inputs = $request->input();

        if (count($inputs) <= 3) {
            return redirect()->back()->with('error', 'Too less data added! Please try again.');
        } else {

            $dispatch = DispatchPolicies::find($request->id);
            $dispatch->dispatch_date = $request->dispatch_date;
            $dispatch->dispatch_by   = $request->dispatch_by;
            $dispatch->status        = 'Filled';
            $dispatch->save();

            $refrence = false;

            DispatchData::where('dispatch_id', $request->id)->delete();

            foreach ($inputs as $key => $value) {
                if ($key == 'refrence' && $value == 'yes') {
                    $refrence = true;
                }
                DispatchData::create([
                    'dispatch_id' => $request->id,
                    'policy_id'   => $dispatch->policy?->id,
                    'meta_key'    => $key,
                    'meta_value'  => $value,
                ]);
            }

            if ($refrence) {
                Lead::updateOrCreate(
                    [
                        'firstname' => $request->lead_name,
                        'phone'     => $request->lead_phone
                    ],
                    [
                        'firstname' => $request->lead_name,
                        'phone'     => $request->lead_phone
                    ]
                );
            }

            return redirect()->route('admin.dispatch.list')->with('success', 'Dispatch filled successfully!');
        }
    }

    public function dispatchDelete(Request $request)
    {
        DispatchPolicies::find($request->id)->delete();
        return redirect()->back()->with('success', 'Dispatch delete successfully');
    }

    public function dispatchUpdate(Request $request)
    {
        $inputs = $request->input();

        if (count($inputs) <= 3) {

            return redirect()->back()->with('error', 'Too less data added! Please try again.');
        } else {

            $dispatch = DispatchPolicies::find($request->id);
            $dispatch->dispatch_date = $request->dispatch_date;
            $dispatch->dispatch_by   = $request->dispatch_by;
            $dispatch->save();
            DispatchData::where('dispatch_id', $request->id)->delete();
            foreach ($inputs as $key => $value) {
                DispatchData::create([
                    'dispatch_id' => $request->id,
                    'policy_id'   => $dispatch->policy?->id,
                    'meta_key'    => $key,
                    'meta_value'  => $value,
                ]);
            }
            return redirect()->route('admin.dispatch.list')->with('success', 'Dispatch updated successfully!');
        }
    }
}
