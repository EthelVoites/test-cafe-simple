<?php

use App\Item;
use App\Sale;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $mari = User::create([
                                 'name'     => 'Mari',
                                 'email'    => 'mari@example.com',
                                 'password' => bcrypt('marimari'),
                             ]);
        $jyri = User::create([
                                 'name'     => 'Jüri',
                                 'email'    => 'jyri@example.com',
                                 'password' => bcrypt('jyrijyri'),
                             ]);
        $dracula = User::create([
                                    'name'     => 'Dracula',
                                    'email'    => 'dracula@example.com',
                                    'password' => bcrypt('dracula99'),
                                ]);

        $items = new Collection(
            [
                Item::create(['name' => 'kohv', 'base_price' => '5']),
                Item::create(['name' => 'tee', 'base_price' => '2.5']),
                Item::create(['name' => 'kakao', 'base_price' => '3']),
            ]);

        $saleDay = Carbon::now()->subMonths(6);
        $now = Carbon::now();
        while ($saleDay->lt($now)) {
            $saleDay->addDay(mt_rand(1, 7));

            $chance = mt_rand(0, 1);
            if ($chance) {
                Sale::create(['user_id' => $mari->id, 'item_id' => $items->random()->id, 'sale_time' => $saleDay]);
            }

            $chance = mt_rand(1, 5);
            if ($chance == 1) {
                Sale::create(['user_id' => $jyri->id, 'item_id' => $items->random()->id, 'sale_time' => $saleDay]);
            }

            $chance = mt_rand(1, 100);
            if ($chance <= 3) {
                Sale::create(['user_id' => $dracula->id, 'item_id' => $items->random()->id, 'sale_time' => $saleDay]);
            }
        }
    }
}
