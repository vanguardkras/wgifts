<?php

use App\GiftList;
use Illuminate\Database\Seeder;

class GiftListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GiftList::class, 10)->create();
    }
}
