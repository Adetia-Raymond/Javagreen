<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\token;
use App\Models\alat;
use App\Models\mode;
use App\Models\jadwal;
use App\Models\manual;
use App\Models\auto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class TokenController extends Controller
{
    public function menutoken(Request $request)
    {
        // $new = $request->input('newtoken');
        // $relasi = relasialat::where('user_id', Auth::user()->id)->first();
        // $newtoken = alat::where('token', $new)->first();
        // $relasi->update([
        //     'alat_id' => $newtoken->alat_id,
        // ]);        
        // return redirect()->route('testtoken');

        $datatoken = token::where('user_id', Auth::user()->id)->get();
        return view('template.tables')
            ->with('datatoken', $datatoken);
    }


    public function tambahalat()
    {   
        $tokenalat = request()->token;

        $token = new token;
        $token->user_id = Auth::user()->id;
        $token->nama_alat = 'Nama Pot';
        $token->token =$tokenalat;

        try {
            $token->save();
            alat::create([
                'token arduino' => $tokenalat,
                'suhu' => 0,
                'kelembaban' => 0,
                'soil' => 0,
                'relay' => 'off'
            ]);
            mode::create([
                'token_alat' => $tokenalat,
                'mode' => 'manual'
            ]);
            manual::create([
                'token_alat' => $tokenalat,
                'tombol' => 'off'
            ]);
            auto::create([
                'token_alat' => $tokenalat,
                'kelembaban_tanah' => 0
            ]);

            return redirect()->route('menutoken');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) { // Assuming MySQL error code for duplicate entry
                return redirect()->route('menutoken');
            }
            // Handle other exceptions
            throw $e;
        }

    }
}
