<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variables = [
            [
                'id' => 1,
                'environment_id' => 1,
                'name' => 'APP_NAME',
                'value' => 'Harbor',
                'description' => '定义服务名称',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'environment_id' => 1,
                'name' => 'APP_ENV',
                'value' => 'local',
                'description' => '定义运行环境',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'environment_id' => 1,
                'name' => 'APP_KEY',
                'value' => 'base64:e/jT2ncEBj2xdnmmcHD+hd1nZdHJxFGk/NjwW0IBga0=',
                'description' => '定义 APP Key 用于加解密',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'environment_id' => 1,
                'name' => 'APP_DEBUG',
                'value' => 'true',
                'description' => '定义是否开启调试模式，开启后可以在页面中现实错误详情',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'environment_id' => 1,
                'name' => 'APP_URL',
                'value' => 'http://harbor.it',
                'description' => '定义 APP 的 URL 用于生成本站链接',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'environment_id' => 1,
                'name' => 'LOG_CHANNEL',
                'value' => 'daily',
                'description' => '定义日志输出频道',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'environment_id' => 1,
                'name' => 'LOG_LEVEL',
                'value' => 'debug',
                'description' => '定义日志级别',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'environment_id' => 1,
                'name' => 'DB_CONNECTION',
                'value' => 'mysql',
                'description' => '定义数据库链接方式',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'environment_id' => 1,
                'name' => 'DB_HOST',
                'value' => '127.0.0.1',
                'description' => '定义数据库访问地址',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'environment_id' => 1,
                'name' => 'DB_PORT',
                'value' => '3306',
                'description' => '定义数据库访问端口',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 11,
                'environment_id' => 1,
                'name' => 'DB_DATABASE',
                'value' => 'harbor',
                'description' => '定义数据库名称',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 12,
                'environment_id' => 1,
                'name' => 'DB_USERNAME',
                'value' => 'root',
                'description' => '定义数据库用户名',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 13,
                'environment_id' => 1,
                'name' => 'DB_PASSWORD',
                'value' => 'Developer@GA',
                'description' => '定义数据库密码',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('variables')->insert($variables);
    }
}
