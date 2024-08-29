<?php

namespace App\Console\Commands;

use App\Models\Administrator;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\QuotationPolicy;
use App\Models\RenewalContactHistory;
use App\Models\RenewalPolicies;
use App\Notifications\RenewalReminder;


class RenewableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:renewable-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $next = Carbon::today()->addMonth()->format('Y-m-d');
        $data = QuotationPolicy::whereDate('expiry_date', '>=', $today)->whereDate('expiry_date', '<=', $next)->get();
        foreach ($data as $d) {
            $check = RenewalPolicies::where('policy_id', $d->id)->exists();
            if (!$check) {
                $user_id = $d->quotation?->salesExecutive?->id;
                RenewalPolicies::create([
                    'policy_id'    => $d->id,
                    'quotation_id' => $d->quotation_id,
                    'customer_id'  => $d->quotation?->customer->id,
                    'reminder_status' => 'Reminder Sent :' . Carbon::today()->format('d M Y, h:ia'),
                    'user_id'      => $user_id,
                ]);
                $this->MailSent($user_id, $d);
            }
        }

        $next_15 = Carbon::today()->addDays(15)->format('Y-m-d');
        $reminder_15 = QuotationPolicy::whereDate('created_at', '>=', $today)->whereDate('expiry_date', '<=', $next_15)->get();
        if (isset($reminder_15)) {
            foreach ($reminder_15 as $d) {

                $follow_up = RenewalContactHistory::where('renewal_id', $d->id)->pluck('follow_up_date');
                if (!is_null($follow_up) && Carbon::parse($follow_up)->format('Y-m-d') >= $today) {

                    $user_id = $d->quotation?->salesExecutive?->id;
                    RenewalPolicies::find($d->id)->update([
                        'reminder_status' => 'Reminder Sent :' . Carbon::today()->format('d M Y, h:ia'),
                    ]);
                    $this->MailSent($user_id, $d);
                } else {

                    $user_id = $d->quotation?->salesExecutive?->id;
                    RenewalPolicies::find($d->id)->update([
                        'reminder_status' => 'Reminder Sent :' . Carbon::today()->format('d M Y, h:ia'),
                    ]);
                    $this->MailSent($user_id, $d);
                }
            }
        }
    }

    public function MailSent($user_id, $d)
    {
        $user = Administrator::find($user_id);
        $customername = $d->quotation?->customer?->firstname . ' ' . $d->quotation?->customer->lastname;
        $policyname = $d->quotation?->policyType->type;
        $policy_no = policy_data($d->id, 'policy_no');
        $user->notify(new RenewalReminder($customername, $policyname, $policy_no));
    }
}
