<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Step;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('steps')->truncate();
        factory(Step::class)->times(20)->create();
    }
}
