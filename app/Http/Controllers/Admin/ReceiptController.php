<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Statement;
use App\Models\Customer;

class ReceiptController extends Controller
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
        $filter['mode']                        = $request->mode;
        $filter['transaction_id']              = $request->transaction_id;

        $recipts                              = Payment::query();

        $recipts                              = isset($filter['customer']) ? $recipts->where('customer_id', $filter['customer']) : $recipts;

        $recipts                              = isset($filter['mode']) ? $recipts->where('mode', 'LIKE', '%' . $filter['mode'] . '%') : $recipts;

        $recipts                              = isset($filter['transaction_id']) ? $recipts->where('transactionId', 'LIKE', '%' . $filter['transaction_id'] . '%') : $recipts;

        $recipts                              = $recipts->with('customer')->orderBy('id', 'desc')->paginate(15);    

        $customers = Customer::latest()->get(['id', 'firstname', 'lastname']);          
        
        return view('admin.sales.recipts.list', compact('recipts', 'filter', 'customers'));
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
        $recipt = Payment::find($id);
        return view('admin.sales.recipts.show', compact('recipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipt = Payment::find($id);
        return view('admin.sales.recipts.edit', compact('recipt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);
        $payment->date = $request->date;
        $payment->mode = $request->mode;
        $payment->amount = $request->amount;
        $payment->status = $request->status;
        $payment->transactionId = $request->transactionId;
        $payment->save();

        if($request->status == 'Approve'){

            $route = route('admin.receipts.show', $id);

            $details = "Receipt payment <a href='" .$route."'> #".$id." </a>";

            Statement::create(['payment_id' => $payment->id, 'customer_id' => $payment->customer_id, 'transaction_id' => $payment->transaction_id, 'date' => $request->date, 'amount' => $request->amount, 'details' => $details]);


            $statement = Statement::select('statements.*', \DB::raw('SUM(amount - paid_amount) as total_amt'))->where('customer_id', $payment->customer_id)->first();

            Customer::where('id', $payment->customer_id)->update(['account_balance' => $statement->total_amt]);                  
        }

        return redirect()->back()->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
