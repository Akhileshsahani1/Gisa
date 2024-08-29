<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Lead;
use App\Models\LeadContactHistory;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        for ($i = 1; $i < 53; $i++) {
            $status                             = $faker->randomElement(['New', 'Contacted', 'Nurturing', 'Qualified', 'Unqualified']);
            $lead                               = Lead::create([
                'lead_type'                     => $faker->randomElement(['Retail', 'SME', 'Corporate']),
                'salutation'                    => $faker->randomElement(['M/s.', 'Mr.', 'Ms.', 'Mrs.']),
                'firstname'                     => $faker->firstname(),
                'lastname'                      => $faker->lastname(),
                'dialcode'                      => '+91',
                'phone'                         => $faker->numerify('+919###5#####'),
                'whats_app_dialcode'            => '+91',
                'whats_app'                     => $faker->numerify('+919#99######'),
                'email'                         => $i == 0 ? 'admin@admin.com' : $faker->unique()->safeEmail(),
                'gender'                        => $faker->randomElement(['Male', 'Female', 'Other']),
                'date_of_birth'                 => Carbon::now()->subYears(28)->format('Y-m-d'),
                'address'                       => 'F-104, C-6, Sector-7, Noida, Uttar Pradesh 201301',
                'lead_source'                   => $faker->randomElement(['Website', 'Bulk', 'Other']),
                'assigned_to'                   => Administrator::inRandomOrder()->first()->id,
                'lead_status'                   => $status,
                'policy_id'                     => 1,
                'policy_type_id'                => 1,
                'previous_policy_expiry_date'   => Carbon::now()->format('Y-m-d'),
                'special_remark'                => 'No Remarks',
                'contacted_via'                 => 'Via Phone',
                'seen_by'                       => $faker->randomElement([Administrator::inRandomOrder()->first()->id,'',''])
            ]);

            $saved_lead                         = Lead::find($lead->id);

            if ($saved_lead->lead_status == "Contacted" || $saved_lead->lead_status == "Nurturing" || $saved_lead->lead_status == "Qualified") {

                // for ($j = 0; $j < 9; $j++) {
                //     $contacted_via = $faker->randomElement(['Via Phone', 'Via Email', 'Via WhatsApp', 'Via Meet']);
                //     switch ($contacted_via) {
                //         case 'Via Phone':
                //             LeadContactHistory::create([
                //                 'lead_id'                       => $lead->id,
                //                 'contacted_via'                 => $contacted_via,
                //                 'caller_name'                   => Administrator::find($saved_lead->assigned_to)->firstname . ' ' . Administrator::find($saved_lead->assigned_to)->lastname,
                //                 'receiver_name'                 => $saved_lead->salutation . ' ' . $saved_lead->firstname . ' ' . $saved_lead->lastname,
                //                 'calling_date'                  => Carbon::now()->subDays(10)->format('Y-m-d'),
                //                 'calling_time'                  => Carbon::now()->format('h:i:s'),
                //                 'subject'                       => $faker->sentence($nbWords = 6, $variableNbWords = true),
                //                 'comment'                       => $faker->text($maxNbChars = 200),
                //                 'attachment_call_recording'     => null,
                //                 'follow_up_date'                => Carbon::now()->format('Y-m-d'),
                //                 'follow_up_time'                => Carbon::now()->format('h:i:s'),
                //                 'added_by'                      => $saved_lead->assigned_to
                //             ]);
                //             break;

                //         case 'Via Email':
                //             LeadContactHistory::create([
                //                 'lead_id'                       => $lead->id,
                //                 'contacted_via'                 => $contacted_via,
                //                 'email_sent_date'               => Carbon::now()->subDays(10)->format('Y-m-d'),
                //                 'email_sender_id'               => Administrator::find($saved_lead->assigned_to)->email,
                //                 'email_receiver_id'             => $saved_lead->email,
                //                 'email_subject'                 => $faker->sentence($nbWords = 6, $variableNbWords = true),
                //                 'email_body'                    => $faker->text($maxNbChars = 200),
                //                 'attachment_email'              => null,
                //                 'follow_up_date'                => Carbon::now()->format('Y-m-d'),
                //                 'follow_up_time'                => Carbon::now()->format('h:i:s'),
                //                 'added_by'                      => $saved_lead->assigned_to
                //             ]);
                //             break;

                //         case 'Via WhatsApp':
                //             LeadContactHistory::create([
                //                 'lead_id'                       => $lead->id,
                //                 'contacted_via'                 => $contacted_via,
                //                 'message_date'                  => Carbon::now()->subDays(10)->format('Y-m-d'),
                //                 'whats_app_from'                => '+91'.Administrator::find($saved_lead->assigned_to)->phone,
                //                 'whats_app_from_dialcode'       => '+91',
                //                 'whats_app_to'                  => $saved_lead->whats_app,
                //                 'whats_app_to_dialcode'         => $saved_lead->whats_app_dialcode,
                //                 'whatsapp_message'              => $faker->text($maxNbChars = 200),
                //                 'attachment_whatsapp'           => null,
                //                 'follow_up_date'                => Carbon::now()->format('Y-m-d'),
                //                 'follow_up_time'                => Carbon::now()->format('h:i:s'),
                //                 'added_by'                      => $saved_lead->assigned_to
                //             ]);
                //             break;

                //         case 'Via Meet':
                //             LeadContactHistory::create([
                //                 'lead_id'                       => $lead->id,
                //                 'contacted_via'                 => $contacted_via,
                //                 'who_meet'                      => Administrator::find($saved_lead->assigned_to)->firstname . ' ' . Administrator::find($saved_lead->assigned_to)->lastname,
                //                 'whom_meet'                     => $saved_lead->salutation . ' ' . $saved_lead->firstname . ' ' . $saved_lead->lastname,
                //                 'meeting_date'                  => Carbon::now()->subDays(3)->format('Y-m-d'),
                //                 'meeting_time'                  => Carbon::now()->format('h:i:s'),
                //                 'meeting_location'              => 'Company Office',
                //                 'meeting_discussion'            => $faker->text($maxNbChars = 200),
                //                 'follow_up_date'                => Carbon::now()->format('Y-m-d'),
                //                 'follow_up_time'                => Carbon::now()->format('h:i:s'),
                //                 'added_by'                      => $saved_lead->assigned_to
                //             ]);
                //             break;

                //         default:
                //             # code...
                //             break;
                //     }
                // }
            }
        }
    }
}
