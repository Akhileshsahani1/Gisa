<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\QuotationPolicy;
use App\Models\Transactions;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPolicies()
    {
        $policies = QuotationPolicy::where('customer_id', Auth::user()->id)->paginate(20);

        return view('customer.policies.list', compact('policies'));
    }

    public function viewPolicy($id)
    {
        $policy = QuotationPolicy::find($id);
        $quotation = $policy->quotation;
        return view('customer.policies.show', compact('policy', 'quotation'));
    }

    public function claims()
    {

        $claims = Claim::where('customer_id', Auth::user()->id)->paginate(20);

        return view('customer.claims.landing', compact('claims'));
    }

    public function claimSearch(Request $request)
    {

        $this->validate(
            $request,
            [
                'product_type' => 'required',
                'vehicle_no'   => is_null($request->vehicle_no) && is_null($request->chassis_no) ? 'required' : '',
                'chassis_no'   => !is_null($request->chassis_no) ? 'max:5|min:5' : ''
            ],
            [
                'product_type.required' => 'Please select motor or non motor type',
                'vehicle_no.required' => 'Please enter vehicle number or last 5 digits chassis no',
            ]
        );

        $policy = QuotationPolicy::with('customer')->select('quotation_policies.*')
            ->join('quotation_policy_data', 'quotation_policy_data.policy_id', '=', 'quotation_policies.id')
            ->where('quotation_policies.customer_id', Auth::user()->id)
            ->where('quotation_policy_data.meta_key', $request->vehicle_no ? 'registration_number' : 'chassis_no')
            ->where('quotation_policy_data.meta_value', $request->vehicle_no ? $request->vehicle_no : 'Like', '%' . $request->chassis_no . '%')
            ->first();

        if (!is_null($policy)) {
            $policy->data = (object)$policy->storeData->pluck('meta_value', 'meta_key')->toArray();
        }

        return redirect()->route('customer.claim.raise')->with('policy', $policy);
    }

    public function raiseClaim()
    {

        return view('customer.claims.search', ['policy' => null]);
        // $policy = QuotationPolicy::find(2);
        // $users = [];
        // $companies = [];
        // $agencies = [];
        // $quotation = $policy->quotation;
        // $dropdown = dropdowns('ncb');
        // return view('customer.claims.add', compact('policy','users','quotation','companies','agencies','dropdown'));
    }
    public function getTransaction()
    {
        $transactions = Transactions::where('customer_id', Auth::user()->id)->paginate(20);
        return view('customer.transactions.list', compact('transactions'));
    }

    public function claimDetails(Request $request)
    {
        $policy = QuotationPolicy::find($request->policy_id);
        if(is_null($policy)){
            return redirect()->route('customer.policies');
        }
        return view('customer.claims.details', compact('policy'));
    }

    public function claimUploadDocs(Request $request){
        $policy = QuotationPolicy::find($request->policy_id);
        if(is_null($policy)){
            return redirect()->route('customer.policies');
        }
        return view('customer.claims.upload-docs', compact('policy'));
    }
}
