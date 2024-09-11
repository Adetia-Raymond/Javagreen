<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class Controller
{
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'token' => ['string', 'max:255'],
            
    //     ]);

    //     User::create([
    //         'token' => $request->token, 
    //     ]);

    //     return redirect()->route('template.profile')->with(['success' => 'Data Berhasil Disimpan!']);
    // }
}
