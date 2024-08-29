<?php

namespace App\Http\Controllers\Admin\Dropdown;

use App\Http\Controllers\Controller;
use App\Models\DropdownValue;
use Illuminate\Http\Request;

class LeadStatusController extends Controller
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
        $filter            = [];
        $filter['name']    = $request->name;  
        $filter['status']  = $request->status;
       

        $data   = DropdownValue::where('type',$request->type);
        $data   = isset($filter['name'])?$data->where('value', 'LIKE', '%' . $filter['name'] . '%'):$data;
        $data   = isset($filter['status'])?$data->where('status',$filter['status']):$data;
        $data   = $data->paginate(20);
        return view('admin.dropdown.lead-status.list', compact('data','filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        DropdownValue::whereIn('id', $request->leads)->delete();
        return response()->json(['success' => 'Data deleted successfully!'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'status'            => 'required',
        ]);                

        DropdownValue::create([
           'type'       => $request->type,
           'value'      => $request->name,
           'sort_order' => $request->sort_order,
           'status'     => $request->status,
        ]);

        return redirect()->route('admin.lead-status.index',['type'=>$request->type])->with('success', 'Data added successfully.');
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
        $this->validate($request, [
            'name'              => 'required',
            'status'            => 'required',
        ]);  

        DropdownValue::find($id)->update([
           'value'      => $request->name,
           'sort_order' => $request->sort_order,
           'status'     => $request->status,
        ]);

        $type = DropdownValue::where('id', $id)->value('type');

        return redirect()->route('admin.lead-status.index',['type'=>$type])->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DropdownValue::find($id);
        DropdownValue::find($id)->delete();
        return redirect()->route('admin.lead-status.index',['type'=>$data->type])->with('success', 'Data deleted successfully.');
    }
    public function getDropdown(){

        return view('admin.dropdown.list');
    }
}
