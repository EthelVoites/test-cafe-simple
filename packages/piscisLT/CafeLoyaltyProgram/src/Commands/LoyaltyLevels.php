<?php

namespace piscisLT\CafeLoyaltyProgram\Commands;

use App\Sale;
use Illuminate\Console\Command;
use piscisLT\CafeLoyaltyProgram\Models\User;

class LoyaltyLevels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loyalty:levels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-count level of each user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Counting levels!');
        $users = User::all();
        $this->output->progressStart($users->count());


        /** @var User $user */
        foreach ($users as $user) {
            $user->loyaltyOrNew()->recountLevel(true);
            $this->output->progressAdvance();
        }
        
        $this->output->progressFinish();
    }
}
