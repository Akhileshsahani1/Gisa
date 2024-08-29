<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Quotation;
use App\Models\QuotationPolicy;
use App\Models\DispatchPolicies;
use App\Models\RenewalPolicies;
use Illuminate\Support\Facades\Storage;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        $customers                              = Customer::query();
        $customers                              = isset($filter['customer_type']) ? $customers->where('customer_type', $filter['customer_type']) : $customers;
        $customers                              = isset($filter['name']) ? $customers->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $filter['name'] . '%') : $customers;
        $customers                              = isset($filter['phone']) ? $customers->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $customers;
        $customers                              = isset($filter['whats_app']) ? $customers->where('whats_app', 'LIKE', '%' . $filter['whats_app'] . '%') : $customers;
        $customers                              = isset($filter['email']) ? $customers->where('email', 'LIKE', '%' . $filter['email'] . '%') : $customers;
        $customers                              = isset($filter['gender']) ? $customers->where('gender', $filter['gender']) : $customers;
        $customers                              = isset($filter['address']) ? $customers->where('address', 'LIKE', '%' . $filter['address'] . '%') : $customers;
        $customers                              = isset($filter['gst_no']) ? $customers->where('gst_no', 'LIKE', '%' . $filter['gst_no'] . '%') : $customers;
        $customers                              = isset($filter['pan_no']) ? $customers->where('pan_no', 'LIKE', '%' . $filter['pan_no'] . '%') : $customers;
        $customers                              = isset($filter['source']) ? $customers->where('source', $filter['source']) : $customers;
        $customers                              = $customers->orderBy('id', 'desc')->paginate(30);
        
        return view('admin.customers.list', compact('customers', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.form');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'customer_type'                   => ['required'],
            'salutation'                      => ['required'],
            'firstname'                       => ['required'],
            'lastname'                        => ['required'],
            'phone'                           => ['required'],
            'whats_app'                       => ['required'],
            'pan_no'                          => ['required','unique:customers'],
            'email'                           => ['required'],
            'gender'                          => ['required'],           
            'address'                         => ['required'],
            'source'                          => ['required'],            
        ];

        $messages = [
            'customer_type.required'                 => 'Please choose Customer type',
            'salutation.required'                    => 'Please choose Title',
            'firstname.required'                     => 'Please enter Firstname',
            'pan_no.required'                        => 'Please enter Pan No.',
            'lastname.required'                      => 'Please enter Lastname',
            'phone.required'                         => 'Please enter Phone Number',
            'whats_app.required'                     => 'Please enter Whatsapp Number',
            'email.required'                         => 'Please enter Email ID',
            'gender.required'                        => 'Please choose Gender',            
            'address.required'                       => 'Please enter Address',
            'source.required'                        => 'Please choose Customer Source'
        ];

        $this->validate($request, $rules, $messages);

        $customer_exists      = Customer::where('pan_no', $request->pan_no)->exists();
        $customer             = $customer_exists ? Customer::where('pan_no', $request->pan_no)->first() : [];

        if($customer_exists){
            Lead::find($request->lead_id)->update(['lead_status' => 'Qualified']);
            return redirect()->back()->with('success', 'Customer already exists');

        }else{

            $customer                       = new Customer;
            $customer->customer_type        = $request->customer_type;
            $customer->salutation           = $request->salutation;
            $customer->firstname            = $request->firstname;
            $customer->lastname             = $request->lastname;
            $customer->dialcode             = $request->dialcode;
            $customer->phone                = $request->phone;
            $customer->whats_app_dialcode   = $request->whats_app_dialcode;
            $customer->whats_app            = $request->whats_app;
            $customer->email                = $request->email;
            $customer->gender               = $request->gender;
            $customer->date_of_birth        = $request->date_of_birth;
            $customer->date_of_anniversary  = $request->date_of_anniversary;
            $customer->address              = $request->address;
            $customer->gst_no               = $request->gst_no;
            $customer->pan_no               = $request->pan_no;
            $customer->source               = $request->source;   
            $customer->state                = $request->state;
            $customer->city                 = $request->city;
            $customer->zipcode              = $request->zipcode;
            $customer->save();  


            Lead::find($request->lead_id)->update(['lead_status' => 'Qualified']);
            if($request->hasfile('avatar')){

                $avatar              = $request->file('avatar');
                $avatar_name         = $avatar->getClientOriginalName();
    
                $avatar->storeAs('uploads/customers/'.$customer->id.'/'.'avatar', $avatar_name, 'public');               
    
                Customer::find($customer->id)->update(['avatar' => $avatar_name]);
    
            }

            if($request->hasfile('pancard_file')){

                $pancard_file      = $request->file('pancard_file');
    
                $pancard_name       = $pancard_file->getClientOriginalName();
    
                $pancard_file->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $pancard_name, 'public');               
    
                Customer::find($customer->id)->update(['pancard_file' => $pancard_name]);
    
            }

            if($request->hasfile('gst_file')){

                $gst_file      = $request->file('gst_file');
    
                $gst_name       = $gst_file->getClientOriginalName();
    
                $gst_file->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $gst_name, 'public');               
    
                Customer::find($customer->id)->update(['gst_file' => $gst_name]);
    
            }

            if($request->hasfile('aadhar')){

                $aadhar      = $request->file('aadhar');
    
                $aadhar_name       = $aadhar->getClientOriginalName();
    
                $aadhar->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $aadhar_name, 'public');               
    
                Customer::find($customer->id)->update(['aadhar' => $aadhar_name]);
    
            }

            if($request->hasfile('other')){

                $other      = $request->file('other');
    
                $other_name       = $other->getClientOriginalName();
    
                $other->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $other_name, 'public');               
    
                Customer::find($customer->id)->update(['other' => $other_name]);
    
            }

          

            return redirect()->back()->with('success', 'Customer created successfully');
        }
       

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $customer   = Customer::find($id);   
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'customer_type'                   => ['required'],
            'salutation'                      => ['required'],
            'firstname'                       => ['required'],
            'lastname'                        => ['required'],
            'phone'                           => ['required'],
            'whats_app'                       => ['required'],
            'email'                           => ['required'],
            'gender'                          => ['required'],           
            'address'                         => ['required'],
            'source'                          => ['required'],  
            'pan_no'                          => isset($request->pan_no) ? [Rule::unique('customers')->ignore($id)] : [],          
        ];

        $messages = [
            'customer_type.required'                 => 'Please choose Customer type',
            'salutation.required'                    => 'Please choose Title',
            'firstname.required'                     => 'Please enter Firstname',
            'lastname.required'                      => 'Please enter Lastname',
            'phone.required'                         => 'Please enter Phone Number',
            'whats_app.required'                     => 'Please enter Whatsapp Number',
            'email.required'                         => 'Please enter Email ID',
            'gender.required'                        => 'Please choose Gender',            
            'address.required'                       => 'Please enter Address',
            'source.required'                        => 'Please choose Customer Source',
            'pan_no.unique'                          => 'Customer already exists for Pan No: '.$request->pan_no
        ];

        $this->validate($request, $rules, $messages);       

        $customer                       = Customer::find($id);
        $customer->customer_type        = $request->customer_type;
        $customer->salutation           = $request->salutation;
        $customer->firstname            = $request->firstname;
        $customer->lastname             = $request->lastname;
        $customer->dialcode             = $request->dialcode;
        $customer->phone                = $request->phone;
        $customer->whats_app_dialcode   = $request->whats_app_dialcode;
        $customer->whats_app            = $request->whats_app;
        $customer->email                = $request->email;
        $customer->gender               = $request->gender;
        $customer->date_of_birth        = $request->date_of_birth;
        $customer->date_of_anniversary  = $request->date_of_anniversary;
        $customer->address              = $request->address;
        $customer->gst_no               = $request->gst_no;
        $customer->pan_no               = $request->pan_no;
        $customer->source               = $request->source;   
        $customer->state                = $request->state;
        $customer->city                 = $request->city;
        $customer->zipcode              = $request->zipcode;        
        $customer->save();  

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
    
            $avatar_name = time() . '_' . $avatar->getClientOriginalName();
            $path = 'uploads/customers/' . $customer->id . '/avatar';
            $avatar->storeAs($path, $avatar_name, 'public');

            if ($customer->avatar) {
                $old_avatar_path = 'public/' . $path . '/' . $customer->avatar;
                Storage::delete($old_avatar_path);
            }
            Customer::where('id',$customer->id)->update(['avatar' => $avatar_name]);
           

        }

        if($request->hasfile('pancard_file')){

            $pancard_file      = $request->file('pancard_file');

            $pancard_name       = $pancard_file->getClientOriginalName();

            $pancard_file->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $pancard_name, 'public');               

            Customer::find($customer->id)->update(['pancard_file' => $pancard_name]);

        }

        if($request->hasfile('gst_file')){

            $gst_file      = $request->file('gst_file');

            $gst_name       = $gst_file->getClientOriginalName();

            $gst_file->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $gst_name, 'public');               

            Customer::find($customer->id)->update(['gst_file' => $gst_name]);

        }

        if($request->hasfile('aadhar')){

            $aadhar      = $request->file('aadhar');

            $aadhar_name       = $aadhar->getClientOriginalName();

            $aadhar->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $aadhar_name, 'public');               

            Customer::find($customer->id)->update(['aadhar' => $aadhar_name]);

        }

        if($request->hasfile('other')){

            $other      = $request->file('other');

            $other_name       = $other->getClientOriginalName();

            $other->storeAs('uploads/customers/'.$customer->id.'/'.'documents', $other_name, 'public');               

            Customer::find($customer->id)->update(['other' => $other_name]);

        }

        return redirect()->back()->with('success', 'Customer updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }

    public function searchCustomer(Request $request)
    {
        $query = $request->get('query');
        $results = Customer::where('id', 'LIKE', '%' . $query . '%')->orWhere(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $query . '%')->orWhere('phone', 'LIKE', '%' . $query . '%')->orWhere('pan_no', 'LIKE', '%' . $query . '%')->get();
        foreach($results as $result){
            $result->name = $result->firstname.' '.$result->lastname;
        }
        return response()->json($results);
    }

    public function bulkDelete(Request $request)
    {
        Customer::whereIn('id', $request->customers)->delete();
        return response()->json(['success' => 'Customers deleted successfully!'], 200);
    }

    public function leadTable(Request $request)
    {
        $leads      = Lead::where('phone',$request->phone)->paginate(10);
        $html       = view('admin.customers.leadTable', compact('leads'))->render();

        return response()->json($html, 200);
    }

    public function quotationTable(Request $request)
    {
        $quotations = Quotation::where('customer_id',$request->id)->paginate(10);
        $html       = view('admin.customers.quotationTable', compact('quotations'))->render(); 

        return response()->json($html, 200);
        
    }

    public function policiesTable(Request $request)
    {
        $policies = QuotationPolicy::where('customer_id',$request->id)->paginate(10);
        $html       = view('admin.customers.quotationPolicyTable', compact('policies'))->render(); 
        return response()->json($html, 200);
        
    }

    public function dispatchpoliciesTable(Request $request)
    {
        $dispatches = DispatchPolicies::where('customer_id',$request->id)->paginate(10);
        $html       = view('admin.customers.dispatchPolicyTable', compact('dispatches'))->render(); 
        return response()->json($html, 200);
        
    }

    public function renewalTable(Request $request)
    {
        $renewals = RenewalPolicies::where('customer_id',$request->id)->paginate(10);
        $html       = view('admin.customers.renewalTable', compact('renewals'))->render(); 
        return response()->json($html, 200);
        
    }
}
