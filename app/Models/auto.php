<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auto extends Model
{
    use HasFactory;

    protected $fillable =[
        'token_alat',
        'kelembaban_tanah'
    ];
}
