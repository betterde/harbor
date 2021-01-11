<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvironmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $environments = [
            [
                'id' => 1,
                'project_id' => 1,
                'name' => 'Staging',
                'description' => '测试环境',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'name' => 'Production',
                'description' => '生产环境',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('environments')->insert($environments);
    }
}
