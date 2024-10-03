<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SettingsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2024-2025'],
            ['key' => 'school_title', 'value' => 'BS'],
            ['key' => 'school_name', 'value' => 'Bassel International Schools'],
            ['key' => 'end_first_term', 'value' => '01-2-2025'],
            ['key' => 'end_second_term', 'value' => '25-05-2025'],
            ['key' => 'phone', 'value' => '01285538066'],
            ['key' => 'address', 'value' => 'القاهرة'],
            ['key' => 'school_email', 'value' => 'info@bassel.com'],
            ['key' => 'logo', 'value' => '1.jpg'],
        ];

        DB::table('settings')->insert($data);
    }
}
