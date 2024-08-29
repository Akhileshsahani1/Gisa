<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statement;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    
    public function index()
    {
        //
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

        $statements = Statement::where('customer_id', $id)->oldest('id')->get();   

        $total_amount = Statement::where('customer_id', $id)->sum('amount');  

        $paid_amount = Statement::where('customer_id', $id)->sum('paid_amount');  

        $balance_amount = $total_amount - $paid_amount;              

        return view('admin.customers.statements', compact('statements', 'balance_amount', 'paid_amount', 'total_amount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        //week
        $items = Item::select('*')

                        ->whereBetween('created_at', 

                            [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]

                        )

                        ->get();

                        //year

                         $items = Item::select('*')

                        ->whereBetween('created_at', 

                            [Carbon::now()->subYear(), Carbon::now()]

                        )

                        ->get();


                        //last 6 month

                        $items = Item::select('*')

                        ->whereBetween('created_at', 

                            [Carbon::now()->subMonth(6), Carbon::now()]

                        )

                        ->get();


                        //last month

                        $items = Item::select('*')

                                ->whereBetween('created_at', 

                                    [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]

                                )

                                ->get()

                                ->toArray();


                                //todays data

                                $items = Item::select("*")

                ->whereDate('created_at', Carbon::today())

                ->get();

                //current week

                 $items = Item::select("*")
                ->whereBetween('created_at', 
                        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                    )
                ->get();


                //7 days record

                $date = Carbon::now()->subDays(7);

  

        $users = User::where('created_at', '>=', $date)->get();

  
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
