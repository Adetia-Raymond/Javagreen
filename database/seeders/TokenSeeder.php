<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\token;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        token::create([
            'user_id'=>1,
            'nama_alat'=>'',
            'token'=>'abc'
        ]);
        token::create([
            'user_id'=>1,
            'nama_alat'=>'',
            'token'=>'def'
        ]);
    }
}
