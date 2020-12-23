<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'id' => 1,
                'name' => 'Harbor',
                'description' => '内部 DevOps 管理平台',
                'cover' => null,
                'repository' => 'https://github.com/betterde/harbor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('projects')->insert($projects);
    }
}
