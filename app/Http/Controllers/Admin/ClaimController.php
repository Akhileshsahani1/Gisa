<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\ClaimData;
use App\Models\QuotationPolicy;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    public function index()
    {
        $claims = Claim::paginate(30);

        return view('admin.claims.list', compact('claims'));
    }

    public function viewClaim($id)
    {
        $claim = Claim::find($id);
        $policy = QuotationPolicy::find($claim->policy_id);

        if (!is_null($claim)) {
            $claim_data = ClaimData::where('claim_id', $claim->id)->get();

            foreach ($claim_data as $data) {
                if (

                    str_contains($data->meta_value, '.jpg')  ||
                    str_contains($data->meta_value, '.jpeg') ||
                    str_contains($data->meta_value, '.png')  ||
                    str_contains($data->meta_value, '.pdf')  ||
                    str_contains($data->meta_value, '.m4a')

                    ) {
                    $claim[$data->meta_key] = asset('storage/uploads/claims') . '/' . $claim->id . '/' . $data->meta_value;
                } else {
                    $claim[$data->meta_key] = $data->meta_value;
                }
            }
        }

        return view('admin.claims.show', compact('claim','policy'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'claim_type' => 'required',
            'vehicle_no' => 'required',
            'status'     => 'required'
        ]);
        Claim::find($request->id)->update([
            'claim_type' => $request->claim_type,
            'vehicle_no' => $request->no,
            'status'     => $request->status
        ]);
        ClaimData::where('claim_id', $request->id)->delete();

        $inputs = $request->inputs();

        foreach ($inputs as $key => $value) {
            ClaimData::create([
                'claim_id'   => $request->id,
                'meta_value' => $key,
                'meta_value' => $value
            ]);
        }
    }

    public function deleteClaim($id)
    {
        Claim::find($id)->delete();
        return redirect()->back()->with('success', 'Claim deleted successfully!');
    }
}
