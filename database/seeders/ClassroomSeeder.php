<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('classrooms')->insert([
            'name' => 'Laravel Training',
            'code' => Str::random(10),
            'section' => 'GSG',
            'subject' => 'TT9 - PHP Laravel',
            'room' => 'myRoom',
            'cover_image_path' => '',
            'theme' => 'dark',
            'user_id' => User::all()->shuffle()->first()->id,
            'status' => 'active',
        ]);
        DB::table('classrooms')->insert([
            'name' => 'Laravel Training1',
            'code' => Str::random(10),
            'section' => 'GSG',
            'subject' => 'TT9 - PHP Laravel',
            'room' => 'myRoom',
            'cover_image_path' => '',
            'theme' => 'dark',
            'user_id' => User::all()->shuffle()->first()->id,
            'status' => 'active',
        ]);
    }
}
