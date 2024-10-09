<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_bloods')->delete();

        $bloodTypes = [
            ['Name' => 'A+'],
            ['Name' => 'A-'],
            ['Name' => 'B+'],
            ['Name' => 'B-'],
            ['Name' => 'AB+'],
            ['Name' => 'AB-'],
            ['Name' => 'O+'],
            ['Name' => 'O-'],
        ];

        DB::table('type_bloods')->insert($bloodTypes);
    }
}
