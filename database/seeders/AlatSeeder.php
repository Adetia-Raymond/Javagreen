<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\alat;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        alat::create([
            'token arduino'=>'def',
            'suhu'=>'0',
            'kelembaban'=>'0',
            'soil'=>'0',
            'relay'=>'off',
        ]);
    }
}
