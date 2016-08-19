<?php

/**
 * Generate userpoint record for each user.
 */

use App\User;
use App\UserPoint;
use Database\Seeds\DatabaseSeeder;

use Illuminate\Database\Seeder;

class UserPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::pluck('id');

        $insert_data = [];

        foreach ($user_ids as $user_id) {
            $insert_data[] = ['user_id' => $user_id];
        }

        // Bulk insert point data
        UserPoint::insert($insert_data);
    }
}
