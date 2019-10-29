<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sucursales')->insert([
            'name' => Str::random(10),
            'obes_id' => factory('App\Obe')->create()->id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
