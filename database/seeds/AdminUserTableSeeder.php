<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Administrador',
            'email' => env('ADMIN_EMAIL'),
            'email_verified_at' => now(),
            'password' => bcrypt(env('ADMIN_PASS')),
            'remember_token' => Str::random(10),
            'admin' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
