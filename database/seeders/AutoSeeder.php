<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\auto;


class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        auto::create([
            'alat_id' => '1', // Everchanging user's id
            'kelembaban_tanah' => '10',
        ]);
    }
}
