<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Company;
use App\Models\Customer;
use App\Models\DispatchPolicies;
use App\Models\InsuranceCompany;
use App\Models\Policy;
use App\Models\Quotation;
use App\Models\QuotationCompany;
use App\Models\QuotationCompanyMeta;
use App\Models\QuotationGroups;
use App\Models\QuotationGroupsMeta;
use App\Models\QuotationMotorData;
use App\Models\QuotationPolicy;
use App\Models\QuotationPolicyData;
use App\Models\Transactions;
use App\Models\Statement;
use App\Models\Payment;
use App\Models\RenewalPolicies;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter                                 = [];
        $filter['customer_type']                = $request->customer_type;
        $filter['name']                         = $request->name;
        $filter['phone']                        = $request->phone;
        $filter['whats_app']                    = $request->whats_app;
        $filter['email']                        = $request->email;
        $filter['gender']                       = $request->gender;
        $filter['address']                      = $request->address;
        $filter['pan_no']                       = $request->pan_no;
        $filter['gst_no']                       = $request->gst_no;
        $filter['source']                       = $request->source;
        $filter['created_at']                   = $request->created_at;
        $filter['status']                       = $request->status;

        $quotations                             = Quotation::query();
        $quotations                             = ($filter['status'])?$quotations:$quotations->where('status','!=','quoted-request');
        if(in_array('Service Executive',Auth::user()->getRoleNames()->toArray())){
         $quotations = $quotations->where('service_executive_id',Auth::user()->id);
        }
        $quotations                             = $quotations->orderBy('id', 'desc')->paginate(30);

        return view('admin.quotations.list', compact('quotations', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [
            'customer_id'           => ['required'],
            'policy_id'             => ['required'],
            'policy_type_id'        => ['required'],
            'business_type'         => ['required'],
            'sales_executive_id'    => ['required'],
            'service_executive_id'  => ['required'],
        ]);

        $quotation = Quotation::create([
            'lead_id'                               => $request->lead_id,
            'customer_id'                           => $request->customer_id,
            'policy_id'                             => $request->policy_id,
            'policy_type_id'                        => $request->policy_type_id,
            'sales_executive_id'                    => $request->sales_executive_id,
            'service_executive_id'                  => $request->service_executive_id,
            'status'                                => 'quoted-request'
        ]);

        if (!is_null($request->is_renewal)) {
            RenewalPolicies::find($request->lead_id)->delete();
        }
        $this->updateFields($request, $quotation->id);

        return redirect()->route('admin.quotations.quoted-request',['status'=>'quoted-request'])->with('success', 'Quotation created sucessfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $quotation          = Quotation::find($id);
        $company            = Company::first();
        $dropdown           = dropdowns();
        $company->path      = isset($company->logo) ? asset('storage/uploads/company/' . $company->logo) : URL::to('assets/images/gisa-logo.png');
        switch ($quotation->policy_type_id) {
            case 1:
                return view('admin.quotations.show.policies.motor.two-wheeler-package-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 2:
                return view('admin.quotations.show.policies.motor.two-wheeler-od-only-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 3:
                return view('admin.quotations.show.policies.motor.two-wheeler-bundled-policy-1-yr-od-5-yr-tp', compact('quotation', 'company', 'dropdown'));
                break;
            case 4:
                return view('admin.quotations.show.policies.motor.two-wheeler-ltd-package-policy-5-yr-od-5-yr-tp', compact('quotation', 'company', 'dropdown'));
                break;
            case 5:
                return view('admin.quotations.show.policies.motor.private-car-package-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 6:
                return view('admin.quotations.show.policies.motor.private-car-od-only-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 7:
                return view('admin.quotations.show.policies.motor.private-car-bundled-policy-1-yr-od-3-yr-tp', compact('quotation', 'company', 'dropdown'));
                break;
            case 8:
                return view('admin.quotations.show.policies.motor.private-car-ltd-package-policy-3-yr-od-3-yr-tp', compact('quotation', 'company', 'dropdown'));
                break;
            case 9:
                return view('admin.quotations.show.policies.motor.two-wheeler-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 10:
                return view('admin.quotations.show.policies.motor.private-car-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 11:
                return view('admin.quotations.show.policies.motor.goods-carrying-vehicle-package-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 12:
                return view('admin.quotations.show.policies.motor.goods-carrying-vehicle-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 13:
                return view('admin.quotations.show.policies.motor.misd-package-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 14:
                return view('admin.quotations.show.policies.motor.misd-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 15:
                return view('admin.quotations.show.policies.motor.passenger-carrying-vehicle-package-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 16:
                return view('admin.quotations.show.policies.motor.passenger-carrying-vehicle-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 17:
                return view('admin.quotations.show.policies.motor.taxi-package-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 18:
                return view('admin.quotations.show.policies.motor.taxi-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 19:
                return view('admin.quotations.show.policies.motor.road-transit-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 20:
                return view('admin.quotations.show.policies.motor.motor-fire-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 21:
                return view('admin.quotations.show.policies.motor.motor-fire-and-theft-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 22:
                return view('admin.quotations.show.policies.non-motor.employee-compensation-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 23:
                return view('admin.quotations.show.policies.non-motor.single-transit-marine-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 24:
                return view('admin.quotations.show.policies.non-motor.marine-cargo-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 25:
                return view('admin.quotations.show.policies.non-motor.sales-turnover-marine-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 26:
                return view('admin.quotations.show.policies.non-motor.bharat-griha-raksha-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 27:
                return view('admin.quotations.show.policies.non-motor.bharat-griha-raksha-ltd-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 28:
                return view('admin.quotations.show.policies.non-motor.bharat-sookshma-udyam-suraksha-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 29:
                return view('admin.quotations.show.policies.non-motor.bharat-laghu-udyam-suraksha-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 30:
                return view('admin.quotations.show.policies.non-motor.machinery-breakdown-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 31:
                return view('admin.quotations.show.policies.non-motor.contractor-plant-and-machinery-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 32:
                return view('admin.quotations.show.policies.non-motor.burglary-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 33:
                return view('admin.quotations.show.policies.non-motor.commercial-package-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 34:
                return view('admin.quotations.show.policies.non-motor.jewelers-comprehensive-protection-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 35:
                return view('admin.quotations.show.policies.non-motor.carrier-legal-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 36:
                return view('admin.quotations.show.policies.non-motor.public-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 37:
                return view('admin.quotations.show.policies.non-motor.doctors-indemnity-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 38:
                return view('admin.quotations.show.policies.non-motor.lpg-trader-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 39:
                return view('admin.quotations.show.policies.non-motor.my-home-all-risk-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 40:
                return view('admin.quotations.show.policies.non-motor.contractor-all-risk-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 41:
                return view('admin.quotations.show.policies.non-motor.directors-and-officers-liability-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 42:
                return view('admin.quotations.show.policies.non-motor.surety-bond-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 43:
                return view('admin.quotations.show.policies.health.individual-health-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 44:
                return view('admin.quotations.show.policies.health.family-floater-health-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 45:
                return view('admin.quotations.show.policies.health.group-health-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 46:
                return view('admin.quotations.show.policies.health.individual-personal-accident-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 47:
                return view('admin.quotations.show.policies.health.family-floater-personal-accident-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 48:
                return view('admin.quotations.show.policies.health.critical-illness-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 49:
                return view('admin.quotations.show.policies.health.health-top-up-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            case 50:
                return view('admin.quotations.show.policies.health.group-personal-accident-insurance-policy', compact('quotation', 'company', 'dropdown'));
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quotation          = Quotation::with('quotationOptions')->find($id);
        $customer_exists    = true;
        $customer           = $customer_exists ? Customer::find($quotation->customer_id) : [];
        $policies           = Policy::get();

        return view('admin.quotations.edit', compact('quotation', 'customer_exists', 'customer', 'policies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'customer_id'           => ['required'],
            'policy_id'             => ['required'],
            'policy_type_id'        => ['required'],
            'business_type'         => ['required'],
            'sales_executive_id'    => ['required'],
            'service_executive_id'  => ['required'],
        ]);

        $quotation = Quotation::find($id)->update([
            'customer_id'                           => $request->customer_id,
            'policy_id'                             => $request->policy_id,
            'policy_type_id'                        => $request->policy_type_id,
            'sales_executive_id'                    => $request->sales_executive_id,
            'service_executive_id'                  => $request->service_executive_id,
            'status'                                => 'Pending'
        ]);


        // if (isset($request->policy)) {

        $this->updateFields($request, $id);
        //  }

        return redirect()->route('admin.quotations.index')->with('success', 'Quotation updated sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Quotation::find($id)->delete();
        return redirect()->route('admin.quotations.index')->with('success', 'Quotation deleted sucessfully!');
    }

    public function bulkDelete(Request $request)
    {
        Quotation::whereIn('id', $request->quotations)->delete();
        return response()->json(['success' => 'Quotations deleted successfully!'], 200);
    }
    public function updateFields($request, $id)
    {
        $data = $request->except('policy');
        if (isset($data)) {

            QuotationMotorData::where([
                'quotation_id' => $id,
                'policy_type_id' => $request->policy_type_id,
            ])->delete();

            foreach ($data as $field => $field_value) {
                QuotationMotorData::create([
                    'quotation_id' => $id,
                    'policy_type_id' => $request->policy_type_id,
                    'meta_key' => $field,
                    'meta_value' => $field_value
                ]);
            }
        }

        if (isset($request->policy)) {

            QuotationCompany::where([
                'quotation_id' => $id,
                'policy_type_id' => $request->policy_type_id,
            ])->delete();

            QuotationCompanyMeta::where([
                'quotation_id' => $id
            ])->delete();

            foreach ($request->policy as $policy) {

                if (isset($policy['insurance_company'])) {

                    $created_group = QuotationCompany::where([
                        'quotation_id' => $id,
                        'policy_type_id' => $request->policy_type_id,
                        'company_id'     => $policy['insurance_company'],
                    ])->first();

                    if (is_null($created_group)) {
                        $created_group = QuotationCompany::create([
                            'quotation_id' => $id,
                            'policy_type_id' => $request->policy_type_id,
                            'company_id'     => $policy['insurance_company'],
                        ]);
                    }

                    foreach ($policy as $key => $value) {
                        QuotationCompanyMeta::create([
                            'quotation_id' => $id,
                            'quotation_company_id' => $created_group->id,
                            'meta_key'     => $key,
                            'meta_value'   => $value
                        ]);
                    }
                }
            }
        }
    }

    public function optionDelete(Request $request)
    {
        QuotationCompany::where('id', $request->quotation_company_id)->delete();
        return redirect()->back()->with('success', 'Option deleted successfully');
    }

    //transactions

    public function listTransactions($id)
    {
        $quotation = Quotation::with('quotationOptions', 'transactions')->find($id);
        $transactions = Transactions::where('quotation_id', $quotation->id)->get();

        return view('admin.quotations.transactions.list', compact('quotation', 'transactions'));
    }

    public function addTransaction(Request $request)
    {

        $this->validate($request, [
            'date' => 'required',
            'transaction_id' => 'required',
            'amount' => 'required',
            'mode'  => 'required'
        ]);

        $quotation = Quotation::find($request->quotation_id);
        $txns_sum      = Transactions::where('quotation_id', $request->quotation_id)->get()->sum('amount');
        $total_amount = motor_form($quotation?->id, 'selected_insurance_amount') ?? number_format(motor_form($quotation?->id, 'selected_insurance_amount'), 2);
        $status = (($txns_sum + $request->amount) >= $total_amount) ? 'Paid' : (($total_amount > $request->amount) ? 'Partial Paid' : '');
        $quotation->payment_status = $status;
        $quotation->save();

        $transaction = Transactions::create([
            'quotation_id' => $request->quotation_id,
            'customer_id'  => $quotation?->customer?->id,
            'date'         => $request->date,
            'mode'         => $request->mode,
            'transaction_id' => $request->transaction_id,
            'amount' => $request->amount
        ]);


        Payment::create([
            'transaction_id' => $transaction->id,
            'quotation_id' => $request->quotation_id,
            'customer_id'  => $quotation?->customer?->id,
            'date'         => $request->date,
            'mode'         => $request->mode,
            'transactionId' => $request->transaction_id,
            'amount' => $request->amount
        ]);

        return redirect()->back()->with('success', 'Transaction added successfully!');
    }

    public function editTransaction(Request $request)
    {
        $quotation = Quotation::find($request->quotation_id);
        $txns_sum      = Transactions::where('quotation_id', $request->quotation_id)->get()->sum('amount');
        $total_amount = motor_form($quotation?->id, 'selected_insurance_amount') ?? number_format(motor_form($quotation?->id, 'selected_insurance_amount'), 2);
        $status = (($txns_sum + $request->amount) >= $total_amount) ? 'Paid' : (($total_amount > $request->amount) ? 'Partial Paid' : '');
        $quotation->payment_status = $status;
        $quotation->save();

        $transaction = Transactions::find($request->id);
        $transaction->date = $request->date;
        $transaction->mode = $request->mode;
        $transaction->amount = $request->amount;
        $transaction->transaction_id = $request->transaction_id;
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction updated successfully!');
    }

    public function deleteTransaction($id)
    {

        Transactions::find($id)->delete();

        return redirect()->back()->with('success', 'Transaction deleted successfully');
    }

    public function convertPolicy(string $id)
    {
        $quotation          = Quotation::with('quotationOptions')->find($id);
        $customer_exists    = true;
        $customer           = $customer_exists ? Customer::find($quotation->customer_id) : [];
        $policies           = Policy::get();

        return view('admin.quotations.convert-policy', compact('quotation', 'customer_exists', 'customer', 'policies'));
    }

    //Quotation to policy

    public function quotationAddConvert(Request $request)
    {

        $this->validate($request, [
            'customer_id'           => ['required'],
            'policy_id'             => ['required'],
            'policy_type_id'        => ['required'],
            'quotation_id'          => ['required'],
            'year_of_manufacture'   => ['required'],
            'engine_no'             => ['required'],
            'chassis_no'            => ['required'],
            // 'previous_insurance_company'   => !is_null($request->previous_policy_no) ? ['required'] : '',
            // 'previous_ncb'                 => !is_null($request->previous_policy_no) ? ['required'] : '',
            'claim'                        => !is_null($request->previous_policy_no) ? ['required'] : '',
            'agency'                => ['required'],
            'ncb'                   => ['required'],
            'new'                   => ['required'],
            'policy_expiry_date'    => ['required'],
        ]);



        $quotation = Quotation::find($request->quotation_id);
        $quotation->status = 'Policy Generated';
        $quotation->save();

        $policy = QuotationPolicy::create([
            'quotation_id' => $request->quotation_id,
            'customer_id'  => $quotation->customer?->id,
            'expiry_date'  => $request->policy_expiry_date,
            'status' => 'Generated',
        ]);

        if ($request->hasfile('proposal_form')) {

            $file               = $request->file('proposal_form');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $policy->id, $value, 'public');

            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => 'proposal_form',
                'meta_value'   => $value
            ]);
        }
        if ($request->hasfile('rc')) {

            $file             = $request->file('rc');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $policy->id, $value, 'public');

            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => 'rc',
                'meta_value'   => $value
            ]);
        }
        if ($request->hasfile('previous_policy')) {

            $file             = $request->file('previous_policy');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $policy->id, $value, 'public');

            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => 'previous_policy',
                'meta_value'   => $value
            ]);
        }
        if ($request->hasfile('pre_inspection_report')) {

            $file             = $request->file('pre_inspection_report');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $policy->id, $value, 'public');

            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => 'pre_inspection_report',
                'meta_value'   => $value
            ]);
        }
        if ($request->hasfile('invoice_copy')) {

            $file             = $request->file('invoice_copy');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $policy->id, $value, 'public');

            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => 'invoice_copy',
                'meta_value'   => $value
            ]);
        }
        if ($request->hasfile('policy_copy')) {

            $file             = $request->file('policy_copy');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $policy->id, $value, 'public');

            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => 'policy_copy',
                'meta_value'   => $value
            ]);
        }
        if ($request->hasfile('other')) {

            $file               = $request->file('other');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $policy->id, $value, 'public');

            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => 'other',
                'meta_value'   => $value
            ]);
        }

        foreach ($request->input() as $key => $value) {
            QuotationPolicyData::create([
                'quotation_id' => $request->quotation_id,
                'policy_id'    => $policy->id,
                'meta_key'     => $key,
                'meta_value'   => $value
            ]);
        }

        DispatchPolicies::create([
            'policy_id' => $policy->id,
            'customer_id'  => $quotation->customer?->id,
            'user_id'   => Auth::user()->id,
            'status'    => 'Pending'
        ]);

        $route = route('admin.quotation-policy.show', $policy->id);

        $details = "Payment deducted policy <a href='" . $route . "'> #" . $policy->id . " </a>";


        Statement::create(['customer_id' => $request->customer_id, 'date' => date('Y-m-d'), 'paid_amount' => $request->gross_premium, 'payment_type' => 2, 'details' => $details]);

        $statement = Statement::select('statements.*', \DB::raw('SUM(amount - paid_amount) as total_amt'))->where('customer_id', $request->customer_id)->first();

        Customer::where('id', $request->customer_id)->update(['account_balance' => $statement->total_amt]);

        return redirect()->route('admin.list.quotation-policies')->with('success', 'Policy generated successfully!');
    }
    public function listPolicies(Request $request)
    {
        $filter                = [];
        $filter['policy_no']   = $request->policy_no;
        $filter['customer_id'] = $request->customer_id;
        $filter['created_at']  = $request->created_at;
        $filter['status']      = $request->status;

        $policies = QuotationPolicy::with('quotation', 'dispatch');

        if(isset($filter['policy_no']))
        {
            $policy_id = QuotationPolicyData::where('meta_key','policy_no')->where('meta_value',  'LIKE', "%{$filter['policy_no']}%")->pluck('policy_id');

            $policies = isset($filter['policy_no']) ?  $policies->whereIn('id', $policy_id ) : $policies;
        }

        $policies = isset($filter['customer_id']) ? $policies->where('customer_id', $filter['customer_id']) : $policies;
        $policies = isset($filter['created_at']) ? $policies->where('created_at', $filter['created_at']) : $policies;

        if( $filter['status'] == 'Filled' || $filter['status'] == 'Pending')
        {

            $policy_id =  DispatchPolicies::where('status', $filter['status'])->pluck('policy_id');
            $policies = isset($filter['status']) ? $policies->whereIn('id', $policy_id) : $policies;

        }
        if($filter['status'] == 'Generated') {

            $policies =  $policies->where('status', $filter['status']);
        }

        $policies = $policies->orderBy('id', 'desc')->paginate(10);

        return view('admin.quotations.quotation-policies.list', compact('policies','filter'));
    }
    public function quotationPolicyEdit($id)
    {

        $policy             = QuotationPolicy::with('quotation')->find($id);
        $customer_exists    = true;
        $customer           = $customer_exists ? Customer::find($policy?->quotation?->customer_id) : [];
        $policies           = Policy::get();

        return view('admin.quotations.quotation-policies.edit.edit', compact('policy', 'customer_exists', 'customer', 'policies'));
    }

    public function updateQuotationPolicy(Request $request)
    {

        $this->validate($request, [
            'customer_id'           => ['required'],
            'policy_id'             => ['required'],
            'policy_type_id'        => ['required'],
            'quotation_id'          => ['required'],
            'year_of_manufacture'   => ['required'],
            'engine_no'             => ['required'],
            'chassis_no'            => ['required'],
            // 'previous_insurance_company'   => !is_null($request->previous_policy_no) ? ['required'] : '',
            // 'previous_ncb'                 => !is_null($request->previous_policy_no) ? ['required'] : '',
            'claim'                        => !is_null($request->previous_policy_no) ? ['required'] : '',
            'agency'                => ['required'],
            'ncb'                   => ['required'],
            'new'                   => ['required'],
            'policy_expiry_date'    => ['required'],
        ]);

        QuotationPolicy::find($request->id)->update([
            'expiry_date' => $request->policy_expiry_date
        ]);

        if ($request->hasfile('proposal_form')) {

            $file               = $request->file('proposal_form');
            $ext                = $file->getClientOriginalExtension();
            $value              = time() . '.' . $ext;
            $file->storeAs('uploads/quotation_policy/' . $request->id, $value, 'public');

            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'proposal_form'
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'proposal_form',
                    'meta_value'   => $value
                ]
            );
        }

        if ($request->hasfile('rc')) {

            $file             = $request->file('rc');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $request->id, $value, 'public');
            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'rc'
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'rc',
                    'meta_value'   => $value
                ]
            );
        }
        if ($request->hasfile('previous_policy')) {

            $file             = $request->file('previous_policy');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $request->id, $value, 'public');

            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'previous_policy'
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'previous_policy',
                    'meta_value'   => $value
                ]
            );
        }
        if ($request->hasfile('pre_inspection_report')) {

            $file             = $request->file('pre_inspection_report');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $request->id, $value, 'public');

            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'pre_inspection_report',
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'pre_inspection_report',
                    'meta_value'   => $value
                ]
            );
        }
        if ($request->hasfile('invoice_copy')) {

            $file             = $request->file('invoice_copy');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $request->id, $value, 'public');

            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'invoice_copy'
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'invoice_copy',
                    'meta_value'   => $value
                ]
            );
        }
        if ($request->hasfile('policy_copy')) {

            $file             = $request->file('policy_copy');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $request->id, $value, 'public');

            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'policy_copy',
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'policy_copy',
                    'meta_value'   => $value
                ]
            );
        }
        if ($request->hasfile('other')) {

            $file               = $request->file('other');
            $value              = $file->getClientOriginalName();
            $file->storeAs('uploads/quotation_policy/' . $request->id, $value, 'public');

            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'other',
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => 'other',
                    'meta_value'   => $value
                ]
            );
        }


        foreach ($request->input() as $key => $value) {

            QuotationPolicyData::updateOrcreate(
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => $key
                ],
                [
                    'quotation_id' => $request->quotation_id,
                    'policy_id'    => $request->id,
                    'meta_key'     => $key,
                    'meta_value'   => $value
                ]
            );
        }

        return redirect()->route('admin.list.quotation-policies')->with('success', 'Policy updated successfully!');
    }

    public function deleteQuotationPolicy(Request $request)
    {
        QuotationPolicy::find($request->id)->delete();

        return redirect()->back()->with('success', 'Policy deleted successfully!');
    }
    public function quotationPolicyShow($id)
    {
        $policy = QuotationPolicy::find($id);
        $quotation = Quotation::find($policy->quotation->id);
        return view('admin.quotations.quotation-policies.show', compact('policy', 'quotation'));
    }


    public function getQuotationPolicyByCustomer(Request $request)
    {

        $policies = Quotation::where('customer_id', $request->customer_id)->get(['policy_id', 'id']);

        foreach ($policies as $key => $policy) {
            $policies[$key]->name = policy_data($policy->id, 'policy_no');
        }

        return response()->json([
            'policies' => $policies,
            'status' => 200,
        ]);
    }
}
