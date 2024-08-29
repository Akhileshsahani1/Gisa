<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\PolicyType;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index()
    {
        $total_leads_count          = Lead::count();
        $today_leads_count          = Lead::whereDate('created_at', Carbon::now()->format('Y-m-d'))->count();
        $weekly_leads_count         = Lead::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthly_leads_count        = Lead::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $new_leads_count            = Lead::where('lead_status', 'New')->count();
        $contacted_leads_count      = Lead::where('lead_status', 'Contacted')->count();
        $nurturing_leads_count      = Lead::where('lead_status', 'Nurturing')->count();
        $qualified_leads_count      = Lead::where('lead_status', 'Qualified')->count();
        $unqualified_leads_count    = Lead::where('lead_status', 'Unqualified')->count();
        $total_customers            = Customer::count();
        $total_quotations           = Quotation::count();
        $total_policies             = PolicyType::count();
        return view('admin.dashboard.dashboard', compact('total_leads_count', 'today_leads_count', 'weekly_leads_count', 'monthly_leads_count', 'new_leads_count', 'contacted_leads_count', 'nurturing_leads_count', 'qualified_leads_count', 'unqualified_leads_count', 'total_customers', 'total_quotations', 'total_policies'));
    }
      public function uploadFile(Request $request){

         $data = array();

         $validator = Validator::make($request->all(), [
              'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
         ]);

         if ($validator->fails()) {

              $data['success'] = 0;
              $data['error'] = $validator->errors()->first('file');// Error response

         }else{
              if($request->file('file')) {

                   $file = $request->file('file');
                   $document_name = time() . rand(1, 50) . '_' . $file->getClientOriginalName();
                   $file->storeAs('uploads/documents', $document_name, 'public');

                   // Response
                   $data['success'] = 1;
                   $data['message'] = 'Uploaded Successfully!';
                   $data['name'] = $document_name;
              }else{
                   // Response
                   $data['success'] = 2;
                   $data['message'] = 'File not uploaded.'; 
              }
         }

         return response()->json($data);
    }
}
