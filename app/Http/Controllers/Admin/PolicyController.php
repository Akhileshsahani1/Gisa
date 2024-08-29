<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\PolicyType;
use App\Models\InsuranceCompany;
use App\Models\PolicyTypeCommission;
use Illuminate\Http\Request;

class PolicyController extends Controller
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
        $policies           = Policy::query();
        $policies           = isset($filter['name']) ? $policies->where('name', 'LIKE', '%' . $filter['name'] . '%') : $policies;
        $policies           = isset($filter['enabled']) ? $policies->where('status', $filter['enabled']) : $policies;
        $policies           = $policies->paginate(20);

        return view('admin.policies.list', compact('policies', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.policies.create');
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

        Policy::create([
            'name'      => $request->name,
            'enabled'   => $request->enabled
        ]);

        return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $policy = Policy::find($id);
        return view('admin.policies.types.list', compact('policy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $policy = Policy::find($id);
        return view('admin.policies.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        Policy::find($id)->update([
            'name'      => $request->name,
            'enabled'   => $request->enabled,
        ]);

        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Policy::find($id)->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully!');
    }

    public function changeStatus($id)
    {
        $customer = Policy::find($id);
        if ($customer->enabled == true) {
            Policy::find($id)->update(['enabled' => false]);
            return redirect()->route('admin.policies.index')->with('warning', 'Policy has been disabled successfully!');
        } else {
            Policy::find($id)->update(['enabled' => true]);
            return redirect()->route('admin.policies.index')->with('success', 'Policy has been enabled successfully!');
        }
    }

    public function bulkDelete(Request $request)
    {
        Policy::whereIn('id', $request->policies)->delete();
        return response()->json(['success' => 'Policies deleted successfully!'], 200);
    }

    public function createType($id)
    {
        $policy = Policy::find($id);

        $insurance_companies = InsuranceCompany::latest()->get(['id', 'company']);

        return view('admin.policies.types.create', compact('policy', 'insurance_companies'));
    }

    public function storeType(Request $request, $id)
    {              
        $rules = [
            'type'                    => ['required'],
            'enabled'                 => ['required'],
        ];

        $messages = [
            'type.required'           => 'Please enter product type',
            'enabled.required'        => 'Please choose type status',
        ];

        $this->validate($request, $rules, $messages);

        $policy_type = PolicyType::create([
            'policy_id'  => $id,
            'type'       => $request->type,
            'enabled'    => $request->enabled,
        ]);

        if($request->commissions){

            foreach ($request->commissions as $key => $commissions) {

                PolicyTypeCommission::insert(['policy_type_id' => $policy_type->id, 'policy_id' => $id, 'company_name' => $commissions['company_name'], 'commissions_value' => $commissions['commissions_value']]);
            }
        }

        return redirect()->route('admin.policies.show', $id)->with('success', 'Policy Type created successfully!');
    }

    public function editType($id)
    {
        $type = PolicyType::with('commissionData')->find($id); 

        $insurance_companies = InsuranceCompany::latest()->get(['id', 'company']);             

        return view('admin.policies.types.edit', compact('type', 'insurance_companies'));
    }

    public function updateType(Request $request, $id)
    {                             
        $rules = [
            'type'                    => ['required'],
            'enabled'                 => ['required'],
        ];

        $messages = [
            'type.required'           => 'Please enter product type',
            'enabled.required'        => 'Please choose type status',
        ];

        $this->validate($request, $rules, $messages);

        PolicyType::find($id)->update([
            'type'      => $request->type,
            'enabled'   => $request->enabled,
            'commissions' => json_encode($request->commissions)
        ]);
                  
        if($request->commissions){
            
            PolicyTypeCommission::where(['policy_type_id' => $id])->delete();

            foreach ($request->commissions as $key => $commissions) {
                                  
                PolicyTypeCommission::insert(['policy_type_id' => $id, 'company_name' => $commissions['company_name'], 'commissions_value' => $commissions['commissions_value']]);
            }
        }

        $type = PolicyType::find($id);

        return redirect()->route('admin.policies.show', $type->policy_id)->with('success', 'Policy Type updated successfully!');
    }

    public function deleteType($id)
    {
        PolicyType::find($id)->delete();
        return redirect()->back()->with('success', 'Policy Type deleted successfully!');
    }

    public function getType(Request $request)
    {
        $types = PolicyType::where('policy_id',$request->policy_id)->where('enabled',true)->get(['id','type']);
        return response()->json(['types' => $types], 200);
    }
}
