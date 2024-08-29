<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Quotation;
use App\Models\QuotationMotorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PublicAccess extends Controller
{
    public function quotation($id){
        $id = base64_decode($id);
        $quotation          = Quotation::find($id);
        $company            = Company::first();
        $company->path      = isset($company->logo) ? asset('storage/uploads/company/' . $company->logo) : URL::to('assets/images/gisa-logo.png');
        switch ($quotation->policy_type_id) {
            case 1:
                return view('admin.quotations.show.policies.motor.two-wheeler-package-policy', compact('quotation', 'company'));
                break;
            case 2:
                return view('admin.quotations.show.policies.motor.two-wheeler-od-only-policy', compact('quotation', 'company'));
                break;
            case 3:
                return view('admin.quotations.show.policies.motor.two-wheeler-bundled-policy-1-yr-od-5-yr-tp', compact('quotation', 'company'));
                break;
            case 4:
                return view('admin.quotations.show.policies.motor.two-wheeler-ltd-package-policy-5-yr-od-5-yr-tp', compact('quotation', 'company'));
                break;
            case 5:
                return view('admin.quotations.show.policies.motor.private-car-package-policy', compact('quotation', 'company'));
                break;
            case 6:
                return view('admin.quotations.show.policies.motor.private-car-od-only-policy', compact('quotation', 'company'));
                break;
            case 7:
                return view('admin.quotations.show.policies.motor.private-car-bundled-policy-1-yr-od-3-yr-tp', compact('quotation', 'company'));
                break;
            case 8:
                return view('admin.quotations.show.policies.motor.private-car-ltd-package-policy-3-yr-od-3-yr-tp', compact('quotation', 'company'));
                break;
            case 9:
                return view('admin.quotations.show.policies.motor.two-wheeler-liability-policy', compact('quotation', 'company'));
                break;
            case 10:
                return view('admin.quotations.show.policies.motor.private-car-liability-policy', compact('quotation', 'company'));
                break;
            case 11:
                return view('admin.quotations.show.policies.motor.goods-carrying-vehicle-package-policy', compact('quotation', 'company'));
                break;
            case 12:
                return view('admin.quotations.show.policies.motor.goods-carrying-vehicle-liability-policy', compact('quotation', 'company'));
                break;
            case 13:
                return view('admin.quotations.show.policies.motor.misd-package-policy', compact('quotation', 'company'));
                break;
            case 14:
                return view('admin.quotations.show.policies.motor.misd-liability-policy', compact('quotation', 'company'));
                break;
            case 15:
                return view('admin.quotations.show.policies.motor.passenger-carrying-vehicle-package-policy', compact('quotation', 'company'));
                break;
            case 16:
                return view('admin.quotations.show.policies.motor.passenger-carrying-vehicle-liability-policy', compact('quotation', 'company'));
                break;
            case 17:
                return view('admin.quotations.show.policies.motor.taxi-package-policy', compact('quotation', 'company'));
                break;
            case 18:
                return view('admin.quotations.show.policies.motor.taxi-liability-policy', compact('quotation', 'company'));
                break;
            case 19:
                return view('admin.quotations.show.policies.motor.road-transit-policy', compact('quotation', 'company'));
                break;
            case 20:
                return view('admin.quotations.show.policies.motor.motor-fire-policy', compact('quotation', 'company'));
                break;
            case 21:
                return view('admin.quotations.show.policies.motor.motor-fire-and-theft-policy', compact('quotation', 'company'));
                break;
            case 22:
                return view('admin.quotations.show.policies.non-motor.employee-compensation-policy', compact('quotation', 'company'));
                break;
            case 23:
                return view('admin.quotations.show.policies.non-motor.single-transit-marine-policy', compact('quotation', 'company'));
                break;
            case 24:
                return view('admin.quotations.show.policies.non-motor.marine-cargo-policy', compact('quotation', 'company'));
                break;
            case 25:
                return view('admin.quotations.show.policies.non-motor.sales-turnover-marine-policy', compact('quotation', 'company'));
                break;
            case 26:
                return view('admin.quotations.show.policies.non-motor.bharat-griha-raksha-policy', compact('quotation', 'company'));
                break;
            case 27:
                return view('admin.quotations.show.policies.non-motor.bharat-griha-raksha-ltd-policy', compact('quotation', 'company'));
                break;
            case 28:
                return view('admin.quotations.show.policies.non-motor.bharat-sookshma-udyam-suraksha-policy', compact('quotation', 'company'));
                break;
            case 29:
                return view('admin.quotations.show.policies.non-motor.bharat-laghu-udyam-suraksha-policy', compact('quotation', 'company'));
                break;
            case 30:
                return view('admin.quotations.show.policies.non-motor.machinery-breakdown-policy', compact('quotation', 'company'));
                break;
            case 31:
                return view('admin.quotations.show.policies.non-motor.contractor-plant-and-machinery-policy', compact('quotation', 'company'));
                break;
            case 32:
                return view('admin.quotations.show.policies.non-motor.burglary-insurance-policy', compact('quotation', 'company'));
                break;
            case 33:
                return view('admin.quotations.show.policies.non-motor.commercial-package-policy', compact('quotation', 'company'));
                break;
            case 34:
                return view('admin.quotations.show.policies.non-motor.jewelers-comprehensive-protection-policy', compact('quotation', 'company'));
                break;
            case 35:
                return view('admin.quotations.show.policies.non-motor.carrier-legal-liability-policy', compact('quotation', 'company'));
                break;
            case 36:
                return view('admin.quotations.show.policies.non-motor.public-liability-policy', compact('quotation', 'company'));
                break;
            case 37:
                return view('admin.quotations.show.policies.non-motor.doctors-indemnity-policy', compact('quotation', 'company'));
                break;
            case 38:
                return view('admin.quotations.show.policies.non-motor.lpg-trader-policy', compact('quotation', 'company'));
                break;
            case 39:
                return view('admin.quotations.show.policies.non-motor.my-home-all-risk-policy', compact('quotation', 'company'));
                break;
            case 40:
                return view('admin.quotations.show.policies.non-motor.contractor-all-risk-policy', compact('quotation', 'company'));
                break;
            case 41:
                return view('admin.quotations.show.policies.non-motor.directors-and-officers-liability-policy', compact('quotation', 'company'));
                break;
            case 42:
                return view('admin.quotations.show.policies.non-motor.surety-bond-policy', compact('quotation', 'company'));
                break;
            case 43:
                return view('admin.quotations.show.policies.health.individual-health-insurance-policy', compact('quotation', 'company'));
                break;
            case 44:
                return view('admin.quotations.show.policies.health.family-floater-health-insurance-policy', compact('quotation', 'company'));
                break;
            case 45:
                return view('admin.quotations.show.policies.health.group-health-insurance-policy', compact('quotation', 'company'));
                break;
            case 46:
                return view('admin.quotations.show.policies.health.individual-personal-accident-insurance-policy', compact('quotation', 'company'));
                break;
            case 47:
                return view('admin.quotations.show.policies.health.family-floater-personal-accident-insurance-policy', compact('quotation', 'company'));
                break;
            case 48:
                return view('admin.quotations.show.policies.health.critical-illness-insurance-policy', compact('quotation', 'company'));
                break;
            case 49:
                return view('admin.quotations.show.policies.health.health-top-up-insurance-policy', compact('quotation', 'company'));
                break;
            case 50:
                return view('admin.quotations.show.policies.health.group-personal-accident-insurance-policy', compact('quotation', 'company'));
                break;
            default:
                # code...
                break;
        }

    }

     public function quotationStatus(Request $request){

       // dd($request->all());

        $policy_type_id = QuotationMotorData::where('quotation_id',$request->id)->first()?->policy_type_id;

        QuotationMotorData::updateOrcreate([
            'quotation_id' => $request->id,
            'meta_key' => 'selected_insurance_company',
        ],[
             'meta_key' => 'selected_insurance_company',
             'meta_value' => $request->selected_insurance_company,
             'policy_type_id' => $policy_type_id
        ]);

        QuotationMotorData::updateOrcreate([
            'quotation_id' => $request->id,
            'meta_key' => 'selected_insurance_amount',
        ],[
             'meta_key' => 'selected_insurance_amount',
             'meta_value' => $request->selected_insurance_amount,
             'policy_type_id' => $policy_type_id
        ]);

        QuotationMotorData::updateOrcreate([
            'quotation_id' => $request->id,
            'meta_key' => 'selected_insurance',
        ],[
             'meta_key' => 'selected_insurance',
             'meta_value' => $request->selected_insurance,
             'policy_type_id' => $policy_type_id
        ]);


        QuotationMotorData::updateOrcreate([
            'quotation_id' => $request->id,
            'meta_key' => 'net_premium',
        ],[
             'meta_key' => 'net_premium',
             'meta_value' => $request->net_premium,
             'policy_type_id' => $policy_type_id
        ]);

        QuotationMotorData::updateOrcreate([
            'quotation_id' => $request->id,
            'meta_key' => 'gst_18',
        ],[
             'meta_key' => 'gst_18',
             'meta_value' => $request->gst_18,
             'policy_type_id' => $policy_type_id
        ]);

        QuotationMotorData::updateOrcreate([
            'quotation_id' => $request->id,
            'meta_key' => 'selected_option_id',
        ],[
             'meta_key' => 'selected_option_id',
             'meta_value' => $request->selected_option_id,
             'policy_type_id' => $policy_type_id
        ]);

       Quotation::where('id',$request->id)->update(['status' => $request->status]);
       return redirect()->back()->with('success',"Quotation ".Str::lower($request->status)." successfully!");
    }

    public function quotationPrintView($id){
        $id = base64_decode($id);
        $quotation          = Quotation::find($id);
        $company            = Company::first();
        $company->path      = isset($company->logo) ? asset('storage/uploads/company/' . $company->logo) : URL::to('assets/images/gisa-logo.png');

        return view('admin.quotations.show.policies.motor.view.quotation-print',compact('quotation','company'));
    }

    public function schedulars(){
        \Artisan::call('app:renewable-command');

        return date("h:i:sa");
    }

    public function commandRunner(Request $request){
        \Artisan::call($request->cmd);
        dd($request->all());
    }
}
