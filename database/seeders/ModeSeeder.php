<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\mode;
use App\Models\manual;
use App\Models\auto;
use App\Models\jadwal;

class ModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mode::create([
            'alat_id'=>2,
            'mode'=>'manual'
        ]);

        manual::create([
            'alat_id'=>2,
            'tombol'=>'off'
        ]);

        auto::create([
            'alat_id' => 2, // Everchanging user's id
            'kelembaban_tanah' => '10',
        ]);

    }

}
