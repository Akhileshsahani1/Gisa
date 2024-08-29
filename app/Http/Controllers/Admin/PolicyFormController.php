<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Agency;
use App\Models\InsuranceCompany;
use App\Models\Quotation;
use App\Models\QuotationPolicy;
use Illuminate\Http\Request;

class PolicyFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function getForm(Request $request)
    {
        $users        = Administrator::get(['id', 'firstname', 'lastname']);
        $companies    = InsuranceCompany::get(['id', 'company']);
        $agencies     = Agency::get(['id', 'agency']);
        $dropdown     = dropdowns();
        $sales_executive_id   = $request->sales_executive_id;
        $service_executive_id = $request->service_executive_id;
        switch ($request->policy_type_id) {
            case 1:
                $form = view('admin.quotations.policies.motor.two-wheeler-package-policy', compact('users', 'companies','agencies','dropdown','sales_executive_id','service_executive_id'))->render();
                break;
            case 2:
                $form = view('admin.quotations.policies.motor.two-wheeler-od-only-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 3:
                $form = view('admin.quotations.policies.motor.two-wheeler-bundled-policy-1-yr-od-5-yr-tp', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 4:
                $form = view('admin.quotations.policies.motor.two-wheeler-ltd-package-policy-5-yr-od-5-yr-tp', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 5:
                $form = view('admin.quotations.policies.motor.private-car-package-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 6:
                $form = view('admin.quotations.policies.motor.private-car-od-only-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 7:
                $form = view('admin.quotations.policies.motor.private-car-bundled-policy-1-yr-od-3-yr-tp', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 8:
                $form = view('admin.quotations.policies.motor.private-car-ltd-package-policy-3-yr-od-3-yr-tp', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 9:
                $form = view('admin.quotations.policies.motor.two-wheeler-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 10:
                $form = view('admin.quotations.policies.motor.private-car-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 11:
                $form = view('admin.quotations.policies.motor.goods-carrying-vehicle-package-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 12:
                $form = view('admin.quotations.policies.motor.goods-carrying-vehicle-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 13:
                $form = view('admin.quotations.policies.motor.misd-package-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 14:
                $form = view('admin.quotations.policies.motor.misd-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 15:
                $form = view('admin.quotations.policies.motor.passenger-carrying-vehicle-package-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 16:
                $form = view('admin.quotations.policies.motor.passenger-carrying-vehicle-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 17:
                $form = view('admin.quotations.policies.motor.taxi-package-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 18:
                $form = view('admin.quotations.policies.motor.taxi-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 19:
                $form = view('admin.quotations.policies.motor.road-transit-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 20:
                $form = view('admin.quotations.policies.motor.motor-fire-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 21:
                $form = view('admin.quotations.policies.motor.motor-fire-and-theft-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 22:
                $form = view('admin.quotations.policies.non-motor.employee-compensation-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 23:
                $form = view('admin.quotations.policies.non-motor.single-transit-marine-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 24:
                $form = view('admin.quotations.policies.non-motor.marine-cargo-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 25:
                $form = view('admin.quotations.policies.non-motor.sales-turnover-marine-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 26:
                $form = view('admin.quotations.policies.non-motor.bharat-griha-raksha-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 27:
                $form = view('admin.quotations.policies.non-motor.bharat-griha-raksha-ltd-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 28:
                $form = view('admin.quotations.policies.non-motor.bharat-sookshma-udyam-suraksha-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 29:
                $form = view('admin.quotations.policies.non-motor.bharat-laghu-udyam-suraksha-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 30:
                $form = view('admin.quotations.policies.non-motor.machinery-breakdown-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 31:
                $form = view('admin.quotations.policies.non-motor.contractor-plant-and-machinery-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 32:
                $form = view('admin.quotations.policies.non-motor.burglary-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 33:
                $form = view('admin.quotations.policies.non-motor.commercial-package-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 34:
                $form = view('admin.quotations.policies.non-motor.jewelers-comprehensive-protection-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 35:
                $form = view('admin.quotations.policies.non-motor.carrier-legal-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 36:
                $form = view('admin.quotations.policies.non-motor.public-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 37:
                $form = view('admin.quotations.policies.non-motor.doctors-indemnity-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 38:
                $form = view('admin.quotations.policies.non-motor.lpg-trader-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 39:
                $form = view('admin.quotations.policies.non-motor.my-home-all-risk-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 40:
                $form = view('admin.quotations.policies.non-motor.contractor-all-risk-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 41:
                $form = view('admin.quotations.policies.non-motor.directors-and-officers-liability-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 42:
                $form = view('admin.quotations.policies.non-motor.surety-bond-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 43:
                $form = view('admin.quotations.policies.health.individual-health-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 44:
                $form = view('admin.quotations.policies.health.family-floater-health-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 45:
                $form = view('admin.quotations.policies.health.group-health-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 46:
                $form = view('admin.quotations.policies.health.individual-personal-accident-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 47:
                $form = view('admin.quotations.policies.health.family-floater-personal-accident-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 48:
                $form = view('admin.quotations.policies.health.critical-illness-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 49:
                $form = view('admin.quotations.policies.health.health-top-up-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            case 50:
                $form = view('admin.quotations.policies.health.group-personal-accident-insurance-policy', compact('users', 'companies','agencies','dropdown'))->render();
                break;
            default:
                # code...
                break;
        }

        return response()->json($form, 200);
    }

    public function getConvertPolicyForm(Request $request)
    {
        $users        = Administrator::get(['id', 'firstname', 'lastname']);
        $companies    = InsuranceCompany::get(['id', 'company']);
        $agencies     = Agency::get(['id', 'agency']);
        $quotation    = Quotation::find($request->quotation_id);
        $dropdown           = dropdowns();
        switch ($request->policy_type_id) {
            case 1:
                $form = view('admin.quotations.quotation-policies.motor.two-wheeler-package-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 2:
                $form = view('admin.quotations.quotation-policies.motor.two-wheeler-od-only-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 3:
                $form = view('admin.quotations.quotation-policies.motor.two-wheeler-bundled-policy-1-yr-od-5-yr-tp', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 4:
                $form = view('admin.quotations.quotation-policies.motor.two-wheeler-ltd-package-policy-5-yr-od-5-yr-tp', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 5:
                $form = view('admin.quotations.quotation-policies.motor.private-car-package-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 6:
                $form = view('admin.quotations.quotation-policies.motor.private-car-od-only-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 7:
                $form = view('admin.quotations.quotation-policies.motor.private-car-bundled-policy-1-yr-od-3-yr-tp', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 8:
                $form = view('admin.quotations.quotation-policies.motor.private-car-ltd-package-policy-3-yr-od-3-yr-tp', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 9:
                $form = view('admin.quotations.quotation-policies.motor.two-wheeler-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 10:
                $form = view('admin.quotations.quotation-policies.motor.private-car-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 11:
                $form = view('admin.quotations.quotation-policies.motor.goods-carrying-vehicle-package-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 12:
                $form = view('admin.quotations.quotation-policies.motor.goods-carrying-vehicle-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 13:
                $form = view('admin.quotations.quotation-policies.motor.misd-package-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 14:
                $form = view('admin.quotations.quotation-policies.motor.misd-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 15:
                $form = view('admin.quotations.quotation-policies.motor.passenger-carrying-vehicle-package-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 16:
                $form = view('admin.quotations.quotation-policies.motor.passenger-carrying-vehicle-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 17:
                $form = view('admin.quotations.quotation-policies.motor.taxi-package-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 18:
                $form = view('admin.quotations.quotation-policies.motor.taxi-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 19:
                $form = view('admin.quotations.quotation-policies.motor.road-transit-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 20:
                $form = view('admin.quotations.quotation-policies.motor.motor-fire-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 21:
                $form = view('admin.quotations.quotation-policies.motor.motor-fire-and-theft-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 22:
                $form = view('admin.quotations.quotation-policies.non-motor.employee-compensation-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 23:
                $form = view('admin.quotations.quotation-policies.non-motor.single-transit-marine-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 24:
                $form = view('admin.quotations.quotation-policies.non-motor.marine-cargo-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 25:
                $form = view('admin.quotations.quotation-policies.non-motor.sales-turnover-marine-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 26:
                $form = view('admin.quotations.quotation-policies.non-motor.bharat-griha-raksha-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 27:
                $form = view('admin.quotations.quotation-policies.non-motor.bharat-griha-raksha-ltd-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 28:
                $form = view('admin.quotations.quotation-policies.non-motor.bharat-sookshma-udyam-suraksha-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 29:
                $form = view('admin.quotations.quotation-policies.non-motor.bharat-laghu-udyam-suraksha-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 30:
                $form = view('admin.quotations.quotation-policies.non-motor.machinery-breakdown-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 31:
                $form = view('admin.quotations.quotation-policies.non-motor.contractor-plant-and-machinery-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 32:
                $form = view('admin.quotations.quotation-policies.non-motor.burglary-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 33:
                $form = view('admin.quotations.quotation-policies.non-motor.commercial-package-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 34:
                $form = view('admin.quotations.quotation-policies.non-motor.jewelers-comprehensive-protection-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 35:
                $form = view('admin.quotations.quotation-policies.non-motor.carrier-legal-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 36:
                $form = view('admin.quotations.quotation-policies.non-motor.public-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 37:
                $form = view('admin.quotations.quotation-policies.non-motor.doctors-indemnity-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 38:
                $form = view('admin.quotations.quotation-policies.non-motor.lpg-trader-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 39:
                $form = view('admin.quotations.quotation-policies.non-motor.my-home-all-risk-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 40:
                $form = view('admin.quotations.quotation-policies.non-motor.contractor-all-risk-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 41:
                $form = view('admin.quotations.quotation-policies.non-motor.directors-and-officers-liability-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 42:
                $form = view('admin.quotations.quotation-policies.non-motor.surety-bond-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 43:
                $form = view('admin.quotations.quotation-policies.health.individual-health-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 44:
                $form = view('admin.quotations.quotation-policies.health.family-floater-health-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 45:
                $form = view('admin.quotations.quotation-policies.health.group-health-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 46:
                $form = view('admin.quotations.quotation-policies.health.individual-personal-accident-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 47:
                $form = view('admin.quotations.quotation-policies.health.family-floater-personal-accident-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 48:
                $form = view('admin.quotations.quotation-policies.health.critical-illness-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 49:
                $form = view('admin.quotations.quotation-policies.health.health-top-up-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            case 50:
                $form = view('admin.quotations.quotation-policies.health.group-personal-accident-insurance-policy', compact('users', 'companies', 'agencies','quotation','dropdown'))->render();
                break;
            default:
                # code...
                break;
        }

        return response()->json($form, 200);
    }

    public function policyEditForm(Request $request)
    {
        $users        = Administrator::get(['id', 'firstname', 'lastname']);
        $companies    = InsuranceCompany::get(['id', 'company']);
        $agencies     = Agency::get(['id', 'agency']);
        $quotation    = Quotation::find($request->quotation_id);
        $policy       = QuotationPolicy::find($request->id);
        $dropdown           = dropdowns();

        switch ($request->policy_type_id) {
            case 1:
                $form = view('admin.quotations.quotation-policies.edit.motor.two-wheeler-package-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 2:
                $form = view('admin.quotations.quotation-policies.edit.motor.two-wheeler-od-only-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 3:
                $form = view('admin.quotations.quotation-policies.edit.motor.two-wheeler-bundled-policy-1-yr-od-5-yr-tp', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 4:
                $form = view('admin.quotations.quotation-policies.edit.motor.two-wheeler-ltd-package-policy-5-yr-od-5-yr-tp', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 5:
                $form = view('admin.quotations.quotation-policies.edit.motor.private-car-package-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 6:
                $form = view('admin.quotations.quotation-policies.edit.motor.private-car-od-only-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 7:
                $form = view('admin.quotations.quotation-policies.edit.motor.private-car-bundled-policy-1-yr-od-3-yr-tp', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 8:
                $form = view('admin.quotations.quotation-policies.edit.motor.private-car-ltd-package-policy-3-yr-od-3-yr-tp', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 9:
                $form = view('admin.quotations.quotation-policies.edit.motor.two-wheeler-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 10:
                $form = view('admin.quotations.quotation-policies.edit.motor.private-car-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 11:
                $form = view('admin.quotations.quotation-policies.edit.motor.goods-carrying-vehicle-package-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 12:
                $form = view('admin.quotations.quotation-policies.edit.motor.goods-carrying-vehicle-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 13:
                $form = view('admin.quotations.quotation-policies.edit.motor.misd-package-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 14:
                $form = view('admin.quotations.quotation-policies.edit.motor.misd-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 15:
                $form = view('admin.quotations.quotation-policies.edit.motor.passenger-carrying-vehicle-package-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 16:
                $form = view('admin.quotations.quotation-policies.edit.motor.passenger-carrying-vehicle-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 17:
                $form = view('admin.quotations.quotation-policies.edit.motor.taxi-package-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 18:
                $form = view('admin.quotations.quotation-policies.edit.motor.taxi-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 19:
                $form = view('admin.quotations.quotation-policies.edit.motor.road-transit-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 20:
                $form = view('admin.quotations.quotation-policies.edit.motor.motor-fire-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 21:
                $form = view('admin.quotations.quotation-policies.edit.motor.motor-fire-and-theft-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 22:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.employee-compensation-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 23:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.single-transit-marine-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 24:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.marine-cargo-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 25:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.sales-turnover-marine-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 26:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.bharat-griha-raksha-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 27:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.bharat-griha-raksha-ltd-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 28:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.bharat-sookshma-udyam-suraksha-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 29:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.bharat-laghu-udyam-suraksha-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 30:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.machinery-breakdown-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 31:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.contractor-plant-and-machinery-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 32:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.burglary-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 33:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.commercial-package-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 34:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.jewelers-comprehensive-protection-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 35:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.carrier-legal-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 36:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.public-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 37:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.doctors-indemnity-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 38:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.lpg-trader-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 39:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.my-home-all-risk-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 40:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.contractor-all-risk-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 41:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.directors-and-officers-liability-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 42:
                $form = view('admin.quotations.quotation-policies.edit.non-motor.surety-bond-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 43:
                $form = view('admin.quotations.quotation-policies.edit.health.individual-health-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 44:
                $form = view('admin.quotations.quotation-policies.edit.health.family-floater-health-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 45:
                $form = view('admin.quotations.quotation-policies.edit.health.group-health-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 46:
                $form = view('admin.quotations.quotation-policies.edit.health.individual-personal-accident-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 47:
                $form = view('admin.quotations.quotation-policies.edit.health.family-floater-personal-accident-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 48:
                $form = view('admin.quotations.quotation-policies.edit.health.critical-illness-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 49:
                $form = view('admin.quotations.quotation-policies.edit.health.health-top-up-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            case 50:
                $form = view('admin.quotations.quotation-policies.edit.health.group-personal-accident-insurance-policy', compact('users', 'companies', 'agencies','quotation','policy','dropdown'))->render();
                break;
            default:
                # code...
                break;
        }

        return response()->json($form, 200);
    }



    public function getEditableForm(Request $request)
    {
        $users        = Administrator::get(['id', 'firstname', 'lastname']);
        $companies    = InsuranceCompany::get(['id', 'company']);
        $agencies     = Agency::get(['id', 'agency']);
        $quotation    = Quotation::find($request->quotation_id);
        $dropdown     = dropdowns();

        switch ($request->policy_type_id) {
            case 1:
                $form = view('admin.quotations.policies.motor.two-wheeler-package-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 2:
                $form = view('admin.quotations.policies.motor.two-wheeler-od-only-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 3:
                $form = view('admin.quotations.policies.motor.two-wheeler-bundled-policy-1-yr-od-5-yr-tp', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 4:
                $form = view('admin.quotations.policies.motor.two-wheeler-ltd-package-policy-5-yr-od-5-yr-tp', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 5:
                $form = view('admin.quotations.policies.motor.private-car-package-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 6:
                $form = view('admin.quotations.policies.motor.private-car-od-only-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 7:
                $form = view('admin.quotations.policies.motor.private-car-bundled-policy-1-yr-od-3-yr-tp', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 8:
                $form = view('admin.quotations.policies.motor.private-car-ltd-package-policy-3-yr-od-3-yr-tp', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 9:
                $form = view('admin.quotations.policies.motor.two-wheeler-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 10:
                $form = view('admin.quotations.policies.motor.private-car-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 11:
                $form = view('admin.quotations.policies.motor.goods-carrying-vehicle-package-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 12:
                $form = view('admin.quotations.policies.motor.goods-carrying-vehicle-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 13:
                $form = view('admin.quotations.policies.motor.misd-package-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 14:
                $form = view('admin.quotations.policies.motor.misd-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 15:
                $form = view('admin.quotations.policies.motor.passenger-carrying-vehicle-package-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 16:
                $form = view('admin.quotations.policies.motor.passenger-carrying-vehicle-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 17:
                $form = view('admin.quotations.policies.motor.taxi-package-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 18:
                $form = view('admin.quotations.policies.motor.taxi-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 19:
                $form = view('admin.quotations.policies.motor.road-transit-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 20:
                $form = view('admin.quotations.policies.motor.motor-fire-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 21:
                $form = view('admin.quotations.policies.motor.motor-fire-and-theft-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 22:
                $form = view('admin.quotations.policies.non-motor.employee-compensation-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 23:
                $form = view('admin.quotations.policies.non-motor.single-transit-marine-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 24:
                $form = view('admin.quotations.policies.non-motor.marine-cargo-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 25:
                $form = view('admin.quotations.policies.non-motor.sales-turnover-marine-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 26:
                $form = view('admin.quotations.policies.non-motor.bharat-griha-raksha-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 27:
                $form = view('admin.quotations.policies.non-motor.bharat-griha-raksha-ltd-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 28:
                $form = view('admin.quotations.policies.non-motor.bharat-sookshma-udyam-suraksha-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 29:
                $form = view('admin.quotations.policies.non-motor.bharat-laghu-udyam-suraksha-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 30:
                $form = view('admin.quotations.policies.non-motor.machinery-breakdown-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 31:
                $form = view('admin.quotations.policies.non-motor.contractor-plant-and-machinery-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 32:
                $form = view('admin.quotations.policies.non-motor.burglary-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 33:
                $form = view('admin.quotations.policies.non-motor.commercial-package-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 34:
                $form = view('admin.quotations.policies.non-motor.jewelers-comprehensive-protection-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 35:
                $form = view('admin.quotations.policies.non-motor.carrier-legal-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 36:
                $form = view('admin.quotations.policies.non-motor.public-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 37:
                $form = view('admin.quotations.policies.non-motor.doctors-indemnity-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 38:
                $form = view('admin.quotations.policies.non-motor.lpg-trader-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 39:
                $form = view('admin.quotations.policies.non-motor.my-home-all-risk-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 40:
                $form = view('admin.quotations.policies.non-motor.contractor-all-risk-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 41:
                $form = view('admin.quotations.policies.non-motor.directors-and-officers-liability-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 42:
                $form = view('admin.quotations.policies.non-motor.surety-bond-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 43:
                $form = view('admin.quotations.policies.health.individual-health-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 44:
                $form = view('admin.quotations.policies.health.family-floater-health-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 45:
                $form = view('admin.quotations.policies.health.group-health-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 46:
                $form = view('admin.quotations.policies.health.individual-personal-accident-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 47:
                $form = view('admin.quotations.policies.health.family-floater-personal-accident-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 48:
                $form = view('admin.quotations.policies.health.critical-illness-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 49:
                $form = view('admin.quotations.policies.health.health-top-up-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            case 50:
                $form = view('admin.quotations.policies.health.group-personal-accident-insurance-policy', compact('users', 'companies', 'agencies', 'quotation','dropdown'))->render();
                break;
            default:
                # code...
                break;
        }

        return response()->json($form, 200);
    }
}
