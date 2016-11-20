<?php

namespace piscisLT\CafeLoyaltyProgram\Commands;

use App\Sale;
use Illuminate\Console\Command;
use piscisLT\CafeLoyaltyProgram\Models\LoyaltyLog;
use piscisLT\CafeLoyaltyProgram\Models\User;
use piscisLT\CafeLoyaltyProgram\Models\UserLoyalty;

class LoyaltySales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loyalty:sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process sales to points';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sales          = Sale::all();
        $usersToRecount = [];

        foreach ($sales as $sale) {
            $isAdded = LoyaltyLog::where('loggable_type', Sale::class)
                ->where('loggable_id', $sale->id)
                ->count();

            if (!$isAdded) {
                $logItem                = new LoyaltyLog;
                $logItem->user_id       = $sale->user_id;
                $logItem->action        = LoyaltyLog::SALE_ACTION;
                $logItem->points        = LoyaltyLog::POINTS_PER_SALE;
                $logItem->loggable_type = Sale::class;
                $logItem->loggable_id   = $sale->id;
                $logItem->created_at    = $sale->sale_time;
                $logItem->save();

                $usersToRecount[$sale->user_id] = 1;
            }
        }

        if ($usersToRecount) {
            $this->info('Updated users:');
            $headers = ['#', 'Name', 'Points', 'All points', 'Current level', 'Next level'];
            $data    = [];

            foreach ($usersToRecount as $userId => $null) {
                /** @var User $user */
                $user = User::find($userId);
                $user->loyaltyOrNew()->recountLevel(true);
                $data[] = [
                    $user->id,
                    $user->name,
                    $user->loyalty->points,
                    $user->loyalty->countAllPoints(),
                    $user->loyalty->level,
                    $user->loyalty->countLevel(),
                ];
            }
            $this->table($headers, $data);
        } else {
            $this->warn('All sales are already processed!');
        }
    }
}