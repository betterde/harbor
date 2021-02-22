<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'George',
            'email' => 'george@betterde.com',
            'avatar' => null,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('George@1994'),
        ]);
    }
}
