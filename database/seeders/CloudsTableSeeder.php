<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CloudsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clouds = [
            [
                'id' => 0,
                'name' => '阿里云',
                'description' => '阿里云服务商',
                'key' => null,
                'secret' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('clouds')->insert($clouds);
    }
}
