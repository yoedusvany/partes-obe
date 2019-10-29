<?php

use Carbon\Carbon;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obes')->insert([
            'name' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
