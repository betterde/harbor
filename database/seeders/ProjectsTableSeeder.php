<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
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
                'id' => Str::uuid()->toString(),
                'name' => 'Harbor',
                'group_id' => '7a6799ef-794d-441e-9a6e-e82d61d27bbf',
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
