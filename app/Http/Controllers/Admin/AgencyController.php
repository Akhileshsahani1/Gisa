<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class AgencyController extends Controller
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
        
        $filter             = [];
        $filter['name']     = $request->name;
        $filter['enabled']  = $request->enabled;
        $agencies           = Agency::query();
        $agencies           = isset($filter['name']) ? $agencies->where('name', 'LIKE', '%' . $filter['name'] . '%') : $agencies;
        $agencies           = isset($filter['enabled']) ? $agencies->where('status', $filter['enabled']) : $agencies;
        $agencies           = $agencies->paginate(20);

        return view('admin.agency.list', compact('agencies', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                    => ['required'],
            'enabled'                 => ['required'],
        ];

        $messages = [
            'name.required'           => 'Please enter policy name',
            'enabled.required'        => 'Please choose policy status',
        ];

        $this->validate($request, $rules, $messages);

        Agency::create([
            'name'        => $request->name,
            'description' => $request->description,
            'enabled'     => $request->enabled
        ]);

        return redirect()->route('admin.agency.index')->with('success', 'Agency created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agency = Agency::find($id);
        return view('admin.agency.edit', compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'agency'                  => ['required'],
            'enabled'                 => ['required'],
        ];

        $messages = [
            'agency.required'         => 'Please enter Agency name',
            'enabled.required'        => 'Please choose policy status',
        ];

        $this->validate($request, $rules, $messages);

        Agency::find($id)->update([
            'agency'      => $request->agency,
            'description'      => $request->description,
            'enabled'   => $request->enabled,
        ]);

        return redirect()->route('admin.agency.index')->with('success', 'Agency updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Agency::find($id)->delete();
        return redirect()->route('admin.agency.index')->with('success', 'Agency deleted successfully!');
    }
    public function bulkDelete(){

    }
}
