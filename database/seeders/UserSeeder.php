<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['id'=>'5','name'=>'user5','email'=>'user5@gmail.com','gender'=>'female','level'=>1,'email_verified_at'=>"2020-12-20 00:00:00",'password' => Hash::make(123456)]);

    }
}
