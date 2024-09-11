<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\jadwal;



class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        jadwal::create([
            'alat_id'=>'1',
            'hari'=>'1',
            'jam'=>'1',
            'menit'=>'1',
            'delay'=>'1000'
        ]);

        jadwal::create([
            'alat_id'=>1,
            'hari'=>'2',
            'jam'=>'2',
            'menit'=>'2',
            'delay'=>'1000'
        ]);
    }
}
