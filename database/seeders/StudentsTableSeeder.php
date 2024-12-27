<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'name' => 'John Doe',
                'dob' => '2000-05-15',
                'gpa' => 3.5,
                'gender' => 'Male',
                'email' => 'john.doe@example.com',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'dob' => '2001-09-20',
                'gpa' => 3.8,
                'gender' => 'Female',
                'email' => 'jane.smith@example.com',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alex Johnson',
                'dob' => '1999-12-10',
                'gpa' => 2.9,
                'gender' => 'Non-binary',
                'email' => 'alex.johnson@example.com',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
