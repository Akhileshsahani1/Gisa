<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
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
        $filter['id']                           = $request->id;
        $filter['company']                      = $request->company;
        $filter['enabled']                      = $request->enabled;

        $companies                             = InsuranceCompany::query();
        $companies                             = isset($filter['id']) ? $companies->where('id', $filter['id']) : $companies;
        $companies                             = isset($filter['name']) ? $companies->where('company', 'LIKE', '%' . $filter['company'] . '%') : $companies;
        $companies                             = isset($filter['name']) ? $companies->where('company', 'LIKE', '%' . $filter['company'] . '%') : $companies;
        $companies                             = $companies->orderBy('id', 'desc')->paginate(20);

        return view('admin.insurance-companies.list', compact('companies', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.insurance-companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company'        => 'required',
            'description'    => 'required'
        ]);

        $company            = InsuranceCompany::create([
            'company'       => $request->company,
            'description'   => $request->description,
            'enabled'       => $request->enabled
        ]);

        if($request->hasfile('logo')){

            $logo      = $request->file('logo');

            $name       = $logo->getClientOriginalName();

            $logo->storeAs('uploads/insurance-companies/'.$company->id.'/', $name, 'public');               

            InsuranceCompany::find($company->id)->update(['logo' => $name]);

        }

        return redirect()->route('admin.insurance-companies.index')->with('success', 'Insurance Company saved successfully!');


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
        $company        = InsuranceCompany::find($id);
        $company->logo  = isset($company->logo) ? asset('storage/uploads/insurance-companies/'.$company->id.'/'.$company->logo) : 'https://placehold.co/240x120'; 
        return view('admin.insurance-companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'company'        => 'required',
            'description'    => 'required'
        ]);

        $company            = InsuranceCompany::find($id)->update([
            'company'       => $request->company,
            'description'   => $request->description,
            'enabled'       => $request->enabled
        ]);

        if($request->hasfile('logo')){

            $logo      = $request->file('logo');

            $name       = $logo->getClientOriginalName();

            $logo->storeAs('uploads/insurance-companies/'.$company->id.'/', $name, 'public');               

            InsuranceCompany::find($company->id)->update(['logo' => $name]);

        }

        return redirect()->route('admin.insurance-companies.index')->with('success', 'Insurance Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        InsuranceCompany::find($id)->delete();
        return redirect()->route('admin.insurance-companies.index')->with('success', 'Insurance Company deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        InsuranceCompany::whereIn('id', $request->companies)->delete();
        return response()->json(['success' => 'Insurance Companies deleted successfully!'], 200);
    }
}
