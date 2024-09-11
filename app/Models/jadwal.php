<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'token_alat',
        'hari',
        'jam',
        'menit',
        'delay'
    ];
}
