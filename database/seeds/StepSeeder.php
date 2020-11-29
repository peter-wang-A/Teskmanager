<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Step;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('steps')->truncate();
        factory(Step::class)->time(20)->create();
    }
}
