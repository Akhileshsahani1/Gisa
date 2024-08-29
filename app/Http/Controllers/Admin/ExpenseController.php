<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\ExpenseCategory;

class ExpenseController extends Controller
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
        $filter                                = [];
        $filter['customer']                    = $request->customer;
        $filter['name']                        = $request->name;

        $expenses                              = Expense::query();

        $expenses                              = isset($filter['customer']) ? $expenses->where('customer_id', $filter['customer']) : $expenses;

        $expenses                              = isset($filter['name']) ? $expenses->where('name', 'LIKE', '%' . $filter['name'] . '%') : $expenses;

        $expenses                              = $expenses->orderBy('id', 'desc')->paginate(30);    

        $customers = Customer::latest()->get(['id', 'firstname', 'lastname']);          
        
        return view('admin.expenses.list', compact('expenses', 'filter', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::latest()->get(['id', 'firstname', 'lastname']);

        $categories = ExpenseCategory::latest()->where('enabled', 1)->get();

        return view('admin.expenses.create', compact('customers', 'categories'));
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
            'name'                            => ['required'],
            'amount'                          => ['required'],
            'date'                            => ['required'],          
            'expense_category_id'                            => ['required'],          
        ];

        $messages = [
            'name.required'                          => 'Please Enater Name',
            'amount.required'                        => 'Please enter Amount',
            'date.required'                          => 'Please select Date',
            'expense_category_id.required'                      => 'Please select Category',
        ];

        $this->validate($request, $rules, $messages);

            $expense                       = new Expense;
            $expense->name        = $request->name;
            $expense->note           = $request->note;
            $expense->expense_category_id            = $request->expense_category_id;
            $expense->customer_id             = $request->customer_id;
            $expense->date             = $request->date;
            $expense->reference             = $request->reference;
            $expense->amount                = $request->amount;
            $expense->mode   = $request->mode;   
            $expense->save();  

            if($request->hasfile('attachment')){

                $attachment      = $request->file('attachment');
    
                $attachment_name       = $attachment->getClientOriginalName();
    
                $attachment->storeAs('uploads/expenses/'.$expense->id.'/'.'documents', $attachment_name, 'public');               
    
                Expense::find($expense->id)->update(['attachment' => $attachment_name]);
    
            }  

            return redirect()->route('admin.expenses.index')->with('success', 'Expense created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::find($id);
        return view('admin.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        $categories = ExpenseCategory::latest()->where('enabled', 1)->get();
        $customers = Customer::latest()->get(['id', 'firstname', 'lastname']);
        return view('admin.expenses.edit', compact('expense', 'customers', 'categories'));
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
            'name'                            => ['required'],
            'amount'                          => ['required'],
            'date'                            => ['required'],          
            'expense_category_id'                            => ['required'],          
        ];

        $messages = [
            'name.required'                          => 'Please Enater Name',
            'amount.required'                        => 'Please enter Amount',
            'date.required'                          => 'Please select Date',
            'expense_category_id.required'                      => 'Please select Category',
        ];

        $this->validate($request, $rules, $messages);

        $expense                        = Expense::find($id);
        $expense->name                  = $request->name;
        $expense->note                  = $request->note;
        $expense->expense_category_id              = $request->expense_category_id;
        $expense->customer_id           = $request->customer_id;
        $expense->date                  = $request->date;
        $expense->reference             = $request->reference;
        $expense->amount                = $request->amount;
        $expense->mode                  = $request->mode;   
        $expense->save();  

        if($request->hasfile('attachment')){

            $attachment      = $request->file('attachment');

            $attachment_name       = $attachment->getClientOriginalName();

            $attachment->storeAs('uploads/expenses/'.$expense->id.'/'.'documents', $attachment_name, 'public');               

            Expense::find($expense->id)->update(['attachment' => $attachment_name]);
        }  

        return redirect()->route('admin.expenses.index')->with('success', 'Customer updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
        return redirect()->route('admin.expenses.index')->with('success', 'Expense deleted successfully');
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
}
