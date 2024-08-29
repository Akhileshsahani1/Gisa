<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\Quotation;
use Carbon\Carbon;

class Helper
{

    public static function getCompanyAddess($id)
    {
        $company = Company::find($id);
        $address = '';
        if (isset($company->address_line_1)) {
            $address .= $company->address_line_1;
        }
        if (isset($company->address_line_2)) {
            $address .= ', ' . $company->address_line_2;
        }
        if (isset($company->state)) {
            $address .= ', ' . $company->state;
        }
        $address .= ', India';
        if (isset($company->zipcode)) {
            $address .= ', ' . $company->zipcode;
        }

        return $address;
    }

    public static function getPolicyNoByQuotationId($id)
    {
        return Quotation::find($id)->value('policy_id');
    }

}

