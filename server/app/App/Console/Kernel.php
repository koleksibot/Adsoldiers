<?php

namespace App\App\Console;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->everyFiveMinutes();

        // task scheduling to update ad's status upon budget, duration
        $schedule->call(
            function () {
                DB::statement("UPDATE ads
                    SET status = CASE
                        WHEN status!=1 AND budget=0 OR end_date<=CURRENT_DATE THEN 'finished'
                        ELSE status
                        END
                ");
            }
        )->daily();

        // task scheduling to add the monthly soldier balance to the main balance
        $schedule->call(
            function () {
                $users = User::whereHas('roles', function (Builder $query) {
                    $query->whereSlug('soldier');
                })->get();

                foreach ($users as $user) {
                    $userBalance = $user->balance()->first();

                    $userBalance->update([
                        'amount' => $userBalance->amount += $user->monthly_balance
                    ]);

                    $user->update([
                        'monthly_balance' => 0
                    ]);

                    dump('Balance Updated!');
                }
            }
        )->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
