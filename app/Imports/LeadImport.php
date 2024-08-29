<?php

namespace App\Imports;

use App\Models\Administrator;
use App\Models\Lead;
use App\Models\Policy;
use App\Models\PolicyType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;
class LeadImport implements ToModel, WithStartRow
{   
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $dob                                = intval($row[7]);
        $expiry                             = intval($row[15]);
        $lead                               = Lead::create([
            'salutation'                    => $row[0],
            'firstname'                     => $row[1],
            'lastname'                      => $row[2],
            'dialcode'                      => '+91',
            'phone'                         => $row[3],
            'whats_app_dialcode'            => '+91',
            'whats_app'                     => $row[4],
            'email'                         => $row[5],
            'gender'                        => $row[6],
            'date_of_birth'                 => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dob)->format('Y-m-d'),
            'address'                       => $row[8],
            'lead_type'                     => $row[9],
            'lead_source'                   => $row[10],
            'assigned_to'                   => Administrator::where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $row[11] . '%')->first()->id,
            'lead_status'                   => $row[12],
            'policy_id'                     => Policy::where('name', $row[13])->first()->id,
            'policy_type_id'                => PolicyType::where('type', $row[14])->first()->id,
            'previous_policy_expiry_date'   => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($expiry)->format('Y-m-d'),
            'special_remark'                => $row[16],
        ]);

        return $lead;
       
    }
}
