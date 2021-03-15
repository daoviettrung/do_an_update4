<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['name'=>'user4','email'=>'user4@gmail.com','password' => Hash::make(123456),'gender'=>'male',
            'level'=>1,'description'=>'jfsjljs']);
    }
}
