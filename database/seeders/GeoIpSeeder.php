<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('geo_ips')->insert([
            'ip' => '192.168.1.1',
            'latitude' => '50.70',
            'longitude' => '24.89',
            'country' => 'United States',
            'city' => 'Los Angeles',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('geo_ips')->insert([
            'ip' => '192.168.1.2',
            'latitude' => '43,77',
            'longitude' => '-50,70',
            'country' => 'United States',
            'city' => 'New York',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
