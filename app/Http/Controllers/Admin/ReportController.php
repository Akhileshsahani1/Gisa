<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuotationPolicy;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\Policy;
use App\Models\QuotationMotorData;
use App\Models\Lead;
use App\Models\Statement;
use App\Models\QuotationPolicyData;
use Carbon\Carbon;
use DB;
use App\Models\InsuranceCompany;

class ReportController extends Controller
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
        $customers = Customer::latest()->get(['id', 'firstname', 'lastname']); 

        $filter = [];

        if ($request->type == 'company') {

            $companies = InsuranceCompany::latest()->get(['id', 'company']);

            $policies = QuotationPolicy::select('quotation_policies.*', 'insurance_companies.company', 'insurance_companies.id as company_id' , DB::raw('count(*) as total'))
                    ->join("quotation_policy_data",function($join){
                        $join->on("quotation_policy_data.quotation_id","=","quotation_policies.quotation_id")
                            ->on("quotation_policy_data.policy_id","=","quotation_policies.id");
                    })->where('quotation_policy_data.meta_key', 'insurance_company')
                    ->leftJoin('insurance_companies', 'insurance_companies.id', '=', 'quotation_policy_data.meta_value')
                    ->orderBy('quotation_policy_data.meta_value', 'desc')
                    ->groupBy('quotation_policy_data.meta_value');

                    if ($request->customer) {
                        $policies = $policies->where('quotation_policies.customer_id', $request->customer);
                    }

                    if ($request->company) {
                        $policies = $policies->where('insurance_companies.id', $request->company);
                    }

                    if (isset($request->date_from)) {
                        $policies = $policies->whereDate('quotation_policies.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
                    }
                    if (isset($request->date_to)) {
                        $policies = $policies->whereDate('quotation_policies.created_at','<=', Carbon::parse($requst->date_to)->format('Y-m-d'));
                    }

                    if (isset($request->date)) {
                        $policies = $policies->whereDate('quotation_policies.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
                    }

                    $policies = $policies->paginate(15);   


                    foreach ($policies as $key => $policy) {
                              
                         $quotation_ids = QuotationPolicyData::where(['meta_key' => 'insurance_company', 'meta_value' => $policy->company_id])->pluck('quotation_id');
                               

                         $policies[$key]->amount = QuotationPolicyData::where(['meta_key' => 'gross_premium'])->whereIn('quotation_id', $quotation_ids)->sum('meta_value');
                    }                                                                                                                                                            

            return view('admin.reports.premium.company.list', compact('policies', 'filter', 'companies', 'customers'));
        }

        if ($request->type == 'product') {

            $products = Policy::latest()->get(['id', 'name']);

            $policies = QuotationPolicy::select('quotation_policies.*', 'policies.name as product_name', 'policies.id as product_id', DB::raw('count(*) as total'))
                ->join('quotations', 'quotation_policies.quotation_id', '=', 'quotations.id')
                ->join('policies', 'policies.id', '=', 'quotations.policy_id')
                ->orderBy('policies.name', 'DESC')
                ->groupBy('policies.name');

            if ($request->customer) {
                $policies = $policies->where('quotations.customer_id', $request->customer);
            }

            if ($request->product) {
                $policies = $policies->where('policies.id', $request->product);
            }

            if (isset($request->date_from)) {
                $policies = $policies->whereDate('quotation_policies.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
            }
            if (isset($request->date_to)) {
                $policies = $policies->whereDate('quotation_policies.created_at','<=', Carbon::parse($requst->date_to)->format('Y-m-d'));
            }

            if (isset($request->date)) {
                $policies = $policies->whereDate('quotation_policies.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
            }

            $policies = $policies->paginate(15);                  


             foreach ($policies as $key => $policy) {

                $quotation_ids = Quotation::select('quotation_policies.*')->join('quotation_policies', 'quotation_policies.quotation_id', 'quotations.id')->where('quotations.policy_id', $policy->product_id)->pluck('quotation_id');

                $ids = Lead::select('quotation_policies.*')->join('quotations', 'quotations.lead_id', 'leads.id')->join('quotation_policies', 'quotation_policies.quotation_id', 'quotations.id')->where('quotations.policy_id', $policy->product_id)->pluck('id');  

                 $policies[$key]->amount = QuotationPolicyData::where(['meta_key' => 'gross_premium'])->whereIn('quotation_id', $quotation_ids)->whereIn('policy_id', $ids)->sum('meta_value');
            }            
                                                                      
            return view('admin.reports.premium.product.list', compact('policies', 'filter', 'products', 'customers'));
        }

        if ($request->type == 'date_range') {

            $companies = InsuranceCompany::latest()->get(['id', 'company']);


            $policies = QuotationPolicy::with('quotation', 'dispatch')->select('quotation_policies.*', 'quotation_policy_data.meta_key', 'quotation_policy_data.meta_value')
                ->join("quotation_policy_data",function($join){
                    $join->on("quotation_policy_data.quotation_id", "quotation_policies.quotation_id")
                        ->on("quotation_policy_data.policy_id", "quotation_policies.id");
                })
                ->where('quotation_policy_data.meta_key', 'insurance_company')
                    ->orderBy('quotation_policies.created_at', 'DESC');            

            if ($request->customer) {
                $policies = $policies->where('quotation_policies.customer_id', $request->customer);
            }

            if (isset($request->date_from)) {
                $policies = $policies->whereDate('quotation_policies.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
            }
            if (isset($request->date_to)) {
                $policies = $policies->whereDate('quotation_policies.created_at','<=', Carbon::parse($requst->date_to)->format('Y-m-d'));
            }

            if ($request->company) {
                $policies = $policies->where('quotation_policy_data.meta_value', $request->company);                
            }

            if (isset($request->date)) {
                $policies = $policies->whereDate('quotation_policies.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
            }
            
            $policies = $policies->paginate(10);

            foreach ($policies as $key => $policy) {                                                   

                $policies[$key]->amount = QuotationPolicyData::where(['meta_key' => 'gross_premium', 'quotation_id' => $policy->quotation_id, 'policy_id' => $policy->id])->sum('meta_value');
            }

            return view('admin.reports.premium.date_range.list', compact('policies', 'filter', 'customers', 'companies'));

        }

        if ($request->type == 'source') {

            $sources = Lead::distinct('lead_source')->get(['lead_source']);

            $policies = QuotationPolicy::select('quotation_policies.*', 'leads.lead_source', DB::raw('count(*) as total'))
                    ->join('quotations', 'quotation_policies.quotation_id', '=', 'quotations.id')
                    ->join('leads', 'leads.id', '=', 'quotations.lead_id')
                    ->orderBy('leads.lead_source', 'DESC')
                    ->groupBy('leads.lead_source');

            if ($request->customer) {
                $policies = $policies->where('quotations.customer_id', $request->customer);
            }

            if ($request->source) {
                $policies = $policies->where('leads.lead_source', $request->source);
            }

            if (isset($request->date_from)) {
                $policies = $policies->whereDate('quotation_policies.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
            }
            if (isset($request->date_to)) {
                $policies = $policies->whereDate('quotation_policies.created_at','<=', Carbon::parse($requst->date_to)->format('Y-m-d'));
            }

            if (isset($request->date)) {
                $policies = $policies->whereDate('quotation_policies.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
            }
            
            $policies = $policies->paginate(10);


            foreach ($policies as $key => $policy) {

                $quotation_ids = Lead::select('quotation_policies.*')->join('quotations', 'quotations.lead_id', 'leads.id')->join('quotation_policies', 'quotation_policies.quotation_id', 'quotations.id')->where('leads.lead_source', $policy->lead_source)->pluck('quotation_id');

                $ids = Lead::select('quotation_policies.*')->join('quotations', 'quotations.lead_id', 'leads.id')->join('quotation_policies', 'quotation_policies.quotation_id', 'quotations.id')->where('leads.lead_source', $policy->lead_source)->pluck('id');                    
                                        

                 $policies[$key]->amount = QuotationPolicyData::where(['meta_key' => 'gross_premium'])->whereIn('quotation_id', $quotation_ids)->whereIn('policy_id', $ids)->sum('meta_value');
            }             

            return view('admin.reports.premium.source.list', compact('policies', 'filter', 'sources', 'customers'));
        }

        if ($request->type == 'customer') {  

            $policies = QuotationPolicy::select('quotation_policies.*', DB::raw('count(*) as total'))
                ->join("customers", function($join){
                    $join->on("customers.id", "=", "quotation_policies.customer_id");
                })
                ->orderBy("customers.firstname","desc")
                ->groupBy("customers.firstname");

                if ($request->customer) {
                    $policies = $policies->where('quotation_policies.customer_id', $request->customer);
                }

                if (isset($request->date_from)) {
                    $policies = $policies->whereDate('quotation_policies.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
                }
                if (isset($request->date_to)) {
                    $policies = $policies->whereDate('quotation_policies.created_at','<=', Carbon::parse($requst->date_to)->format('Y-m-d'));
                }

                if (isset($request->date)) {
                    $policies = $policies->whereDate('quotation_policies.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
                }

                $policies = $policies->paginate(15);                        


                foreach ($policies as $key => $policy) {

                    $quotation_ids = QuotationPolicy::where('customer_id', $policy->customer_id)->pluck('quotation_id');
                    $ids = QuotationPolicy::where('customer_id', $policy->customer_id)->pluck('id');                                            

                    $policies[$key]->amount = QuotationPolicyData::where(['meta_key' => 'gross_premium'])->whereIn('quotation_id', $quotation_ids)->whereIn('policy_id', $ids)->sum('meta_value');
                }             
                          

            return view('admin.reports.premium.customer.list', compact('policies', 'filter', 'customers'));
        }

        if ($request->type == 'debtor') {

            $statements = Statement::select('statements.*', DB::raw('SUM(amount - paid_amount) as total_amt'), 'customers.firstname', 'customers.lastname', DB::raw('count(*) as total'))
            ->join("customers", function($join){
                    $join->on("customers.id", "=", "statements.customer_id")->where('account_balance', '>', 0);
                })
                ->groupBy("customers.firstname");

                if ($request->customer) {
                    $statements = $statements->where('statements.customer_id', $request->customer);
                }

                if (isset($request->date_from)) {
                    $statements = $statements->whereDate('statements.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
                }
                if (isset($request->date_to)) {
                    $statements = $statements->whereDate('statements.created_at','<=', Carbon::parse($requst->date_to)->format('Y-m-d'));
                }

                if (isset($request->date)) {
                    $statements = $statements->whereDate('statements.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
                }

                $statements = $statements->paginate(15);                        
                                                                                                                

            return view('admin.reports.premium.debtor.list', compact('statements', 'filter', 'customers'));
        }


        if ($request->type == 'creditor') {  

            $statements = Statement::select('statements.*', DB::raw('SUM(amount - paid_amount) as total_amt'), 'customers.firstname', 'customers.lastname', DB::raw('count(*) as total'),)
                ->join("customers", function($join){
                    $join->on("customers.id", "=", "statements.customer_id")->where('account_balance', '<', 0);
                })
                ->groupBy("customers.firstname");

                if ($request->customer) {
                    $statements = $statements->where('statements.customer_id', $request->customer);
                }

                if (isset($request->date_from)) {
                    $statements = $statements->whereDate('statements.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
                }
                if (isset($request->date_to)) {
                    $statements = $statements->whereDate('statements.created_at','<=', Carbon::parse($requst->date_to)->format('Y-m-d'));
                }

                if (isset($request->date)) {
                    $statements = $statements->whereDate('statements.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
                }

                $statements = $statements->paginate(15);  
                                                                                                                

            return view('admin.reports.premium.creditor.list', compact('statements', 'filter', 'customers'));
        }

        return view('admin.reports.list');

        $products = Policy::latest()->get(['id', 'name']);   

        $policies = QuotationPolicy::with('quotation', 'dispatch')->select('quotation_policies.*', 'quotation_policy_data.meta_key', 'quotation_policy_data.meta_value')
                ->join('quotations', 'quotation_policies.quotation_id', '=', 'quotations.id')
                ->join("quotation_policy_data",function($join){
                    $join->on("quotation_policy_data.quotation_id", "quotation_policies.quotation_id")
                        ->on("quotation_policy_data.policy_id", "quotation_policies.id");
                })
                ->join('policies', 'policies.id', '=', 'quotations.policy_id')
                ->where('quotation_policy_data.meta_key', 'insurance_company');

            if ($request->customer) {
                $policies = $policies->where('quotation_policies.customer_id', $request->customer);
            }

            if (isset($request->date_from)) {
                $policies = $policies->whereDate('quotation_policies.created_at','>=', Carbon::parse($request->date_from)->format('Y-m-d'));
            }

            if (isset($request->date_to)) {
                $policies = $policies->whereDate('quotation_policies.created_at','<=', Carbon::parse($request->date_to)->format('Y-m-d'));
            }

            if (isset($request->date)) {
                $policies = $policies->whereDate('quotation_policies.created_at','=', Carbon::parse($request->date)->format('Y-m-d'));
            }

            if ($request->product) {
                $policies = $policies->where('policies.id', $request->product);
            }

            if ($request->company) {
                $policies = $policies->where('quotation_policy_data.meta_value', $request->company);                
            }

            $companies = InsuranceCompany::latest()->get(['id', 'company']);

            $policies = $policies->paginate(15);                                          

            foreach ($policies as $key => $policy) {                                                     

                $policies[$key]->amount = QuotationPolicyData::where(['meta_key' => 'gross_premium', 'quotation_id' => $policy->quotation_id, 'policy_id' => $policy->id])->sum('meta_value');
            }                 

        return view('admin.reports.list', compact('policies', 'filter', 'customers', 'products', 'companies'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
