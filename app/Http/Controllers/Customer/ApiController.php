<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\ClaimData;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\QuotationPolicy;
use App\Models\QuotationPolicyData;
use App\Models\Transactions;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public function getCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'date_of_birth' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }
        $dob = Carbon::parse($request->date_of_birth)->format('Y-m-d');

        $customer = Customer::where('phone', 'LIKE', '%' . $request->number . '%')
            ->whereDate('date_of_birth', '=', $dob)
            ->first();

        if (is_null($customer)) {
            return response()->json([
                'message' => 'No record found for this number',
                'status_code' => 404
            ]);
        }
        $customer->token   = $customer->createToken('Customer', ['customer'])->plainTextToken;

        return response()->json([
            'customer'    => $customer,
            'status_code' => 200
        ]);
    }

    public function getProfile(Request $request)
    {

        $user = Customer::find(Auth::user()?->id);

        if (is_null($user)) {
            return response()->json([
                'message' => 'No record found',
                'status_code' => 404
            ]);
        }
        $user->token   = $user->createToken('Customer', ['customer'])->plainTextToken;

        return response()->json([
            'user'    => $user,
            'status_code' => 200
        ]);
    }

    public function sendOTP(Request $request)
    {

        $otp = 1234;
        $num = $request->number;

        return response()->json([
            'status_code' => 200,
            'message' => 'OTP send successfuly'
        ]);
    }

    public function submitOTP(Request $request)
    {

        if ($request->otp == 1234) {
            return response()->json([
                'status_code' => 200,
                'message'     => 'signed in successfully'
            ]);
        } else {
            return response()->json([
                'status_code' => 404,
                'message'     => 'Invalid OTP'
            ]);
        }
    }

    public function getPolicies()
    {
        $policies = QuotationPolicy::where('customer_id', Auth::user()->id)->paginate(5);
        $policies = $policies->through(function ($p) {
            $cus =  $p->customer;
            return [
                'id'        => $p->id,
                'policy_no' => policy_data($p->id, 'policy_no'),
                'status'    => !is_null($p->expiry_date) ?  (Carbon::today()->format('Y-m-d') < Carbon::parse($p->expiry_date)->format('Y-m-d')  ? 'Active' : 'Expired') : 'Expiry date N/A',
                'insurance_company' => $p->insuranceCompany(),
                'policy_name' => $p->policyTypeName(),
                'premium'   => 'N/A',
                'modal_premium' => policy_data($p->id, 'gross_premium'),
                'insured_name'  => $cus?->salutation . ' ' . $cus?->firstname . ' ' . $cus?->lastname,
                'due_date'      => $p->expiry_date,
                'claim'         => $p->claim,
            ];
        });

        return response()->json([
            'policies' => $policies
        ]);
    }

    public function claimProcess(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date_of_accident' => 'required',
            'place_of_accident' => 'required',
            'time_of_accident' => 'required',
            'description' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'settlement_type' => 'required'
        ], [
            'date_of_accident.required' => 'Please select date of accident',
            'place_of_accident.required' => 'Please enter place of accident',
            'time_of_accident.required' => 'Please enter time of accident',
            'description.required' => 'Please enter some description',
            'name.required' => 'Please enter your name',
            'phone.required' => 'Please enter phone number',
            'settlement_type.required' => 'Please select settlement type'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $check = Claim::where('policy_id', $request->policy_id)->first();
        if (!is_null($check)) {
            $claim = $check;
            Claim::where('policy_id', $request->policy_id)->update([
                'customer_id' => Auth::user()->id,
                'policy_id'   => $request->policy_id,
                'status'      => 'InComplete',
                'claim_type'  => policy_data($request->policy_id, 'policy_id') == 1 ? 'motor' : 'non-motor'
            ]);
        } else {
            $claim = Claim::create([
                'customer_id' => Auth::user()->id,
                'policy_id'   => $request->policy_id,
                'status'      => 'InComplete',
                'claim_type'  => policy_data($request->policy_id, 'policy_id') == 1 ? 'motor' : 'non-motor'
            ]);
        }

        $inputs = $request->input();
        foreach ($inputs as $key => $value) {
            ClaimData::updateOrcreate(
                [
                    'claim_id'  => $claim->id,
                    'policy_id' => $request->policy_id,
                    'meta_key'  => $key
                ],
                [
                    'claim_id'   => $claim->id,
                    'policy_id'  => $request->policy_id,
                    'meta_key'   => $key,
                    'meta_value' => $value
                ]
            );
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Claim Process filled successfully!'
        ]);
    }

    public function ClaimFilled($id)
    {
        Claim::where('policy_id', $id)->update(['status' => 'In Progress']);
        return response()->json([
            'status_code' => 200,
            'message' => 'Claim is under progress now.'
        ]);
    }

    public function claimDocImages(Request $request, $policy_id, $name, $type)
    {

        if (in_array($type, ["image", "pdf"])) {

            $claim = Claim::where('policy_id', $policy_id)->first();
            $path_image   = 'uploads/claims/' . $claim->id . '/'  . $name . ".jpg";
            if (is_file($path_image)) {
                Storage::delete($path_image);
            }
            $path_pdf   = 'uploads/claims/' . $claim->id . '/'  . $name . ".pdf";
            if (is_file($path_pdf)) {
                Storage::delete($path_pdf);
            }

            if ($request->hasfile($name)) {

                $image       = $request->file($name);
                $ext         = $image->getClientOriginalExtension();
                $fname       = $name . (($type == "image") ? ".".$image->getClientOriginalExtension() : ".pdf");

                $image->storeAs('uploads/claims/' . $claim->id . '/', $fname, 'public');

                ClaimData::updateOrcreate(
                    [
                        'claim_id'  => $claim->id,
                        'policy_id' => $policy_id,
                        'meta_key'  => $name
                    ],
                    [
                        'claim_id'  => $claim->id,
                        'policy_id' => $policy_id,
                        'meta_key'  => $name,
                        'meta_value' => $fname
                    ]
                );

                return response()->json([
                    'status_code' => 200,
                    'message'     => 'Uploaded successfuly'
                ]);
            }
        }
    }

    public function claimAudio(Request $request, $policy_id)
    {

            $claim = Claim::where('policy_id', $policy_id)->first();

            // $path   = 'uploads/claims/' . $claim->id . '/'  . $name . ".pdf";
            // if (is_file($path_pdf)) {
            //     Storage::delete($path_pdf);
            // }

            if ($request->hasfile('voice_description')) {

                $audio       = $request->file('voice_description');
                $ext         = $audio->getClientOriginalExtension();
                $fname       = 'voice_description' . "." .$ext;

                $audio->storeAs('uploads/claims/' . $claim->id . '/', $fname, 'public');

                ClaimData::updateOrcreate(
                    [
                        'claim_id'  => $claim->id,
                        'policy_id' => $policy_id,
                        'meta_key'  => 'voice_description'
                    ],
                    [
                        'claim_id'  => $claim->id,
                        'policy_id' => $policy_id,
                        'meta_key'  => 'voice_description',
                        'meta_value' => $fname
                    ]
                );

                return response()->json([
                    'status_code' => 200,
                    'message'     => 'Audio Uploaded successfuly'
                ]);
        }
    }

    public function getClaim($id)
    {
        $claim = Claim::where('policy_id', $id)->first();

        if (!is_null($claim)) {
            $claim_data = ClaimData::where('claim_id', $claim->id)->get();

            foreach ($claim_data as $data) {
                if (

                    str_contains($data->meta_value, '.jpg')  ||
                    str_contains($data->meta_value, '.jpeg') ||
                    str_contains($data->meta_value, '.png')  ||
                    str_contains($data->meta_value, '.pdf')

                ) {
                    $claim[$data->meta_key] = asset('storage/uploads/claims') . '/' . $claim->id . '/' . $data->meta_value;
                } else {
                    $claim[$data->meta_key] = $data->meta_value;
                }
            }
        }
        return response()->json([
            'status_code' => 200,
            'claim' => $claim
        ]);
    }

    public function policyDetails($id)
    {
        $policy = QuotationPolicy::where(['id' => $id, 'customer_id' => Auth::user()->id])->first();
        if (!is_null($policy)) {
            $policy_data = QuotationPolicyData::where('policy_id', $policy->id)->get();

            foreach ($policy_data as $data) {

                $policy[$data->meta_key] = $data->meta_value;
            }
            $policy->advisor  = $policy->salesExecutive();
            $policy->planName = $policy->policyTypeName();
            $policy->insurance_company = $policy->insuranceCompany();
            $policy->status   = !is_null($policy->expiry_date) ?  (Carbon::today()->format('Y-m-d') < Carbon::parse($policy->expiry_date)->format('Y-m-d')  ? 'Active' : 'Expired') : 'Expiry date N/A';
            $policy->term = Carbon::parse($policy->policy_start_date)->diffForHumans(Carbon::parse($policy->expiry_date),CarbonInterface::DIFF_ABSOLUTE);;
            $policy->customer;
        }
        return response()->json([
            'policy' => $policy
        ],200);
    }

    public function customerClaims(){

        $claims = Claim::where('customer_id',Auth::user()->id)->paginate(5);
        $claims  = $claims->through(function($c){
            $policy = QuotationPolicy::find($c->policy_id);
           return [
            'id'           => $c->id,
            'policy_id'    => $c->policy_id,
            'status'       => $c->status,
            'insurance'    => $policy?->policyTypeName(),
            'policy_no'    => policy_data($c->policy_id,'policy_no'),
            'own_damage'   => $policy?->insuranceCompany(),
            'issue_date'   => Carbon::parse($policy->created_at)->format('d/m/Y'),
            'term'         => Carbon::parse(policy_data($c->policy_id,'policy_start_date'))->diffForHumans(Carbon::parse($policy->expiry_date),CarbonInterface::DIFF_ABSOLUTE),
            'insured_name' => $policy?->salesExecutive()?->firstname.' '.$policy?->salesExecutive()?->lastname
           ];
        });

        return response()->json(['claims' => $claims],200);
    }
}
