<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert into users (col, col) values ();
        //Query Builder
        DB::table('users')->insert(['name'=>'Bader','email'=>'bader.halimi.2003@gmail.com','password'=> Hash::make('password')]); //sha, md5, rsa
        DB::table('users')->insert(['name'=>'Ahmed','email'=>'ahmed@gmail.com','password'=> Hash::make('password')]); //sha, md5, rsa
        DB::table('users')->insert(['name'=>'Khaled','email'=>'khaled@gmail.com','password'=> Hash::make('password')]); //sha, md5, rsa
    }
}
