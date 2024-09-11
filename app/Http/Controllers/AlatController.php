<?php

namespace App\Http\Controllers;


use App\Models\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\alat;
use App\Models\mode;
use App\Models\manual;
use App\Models\auto;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;


class AlatController 
{
    public function cryptfilter(){
        $value=Crypt::encrypt(request()->token);
        return redirect()->route('main', ['value'=>$value]);
    }


    public function viewmain()
    {  
        // $index4 = grafiksensor::where('user_id', $id)
        // ->where('index_sort',  4)->first();
        // $index3 = grafiksensor::where('user_id', $id)
        // ->where('index_sort', 3)->first();
        // $index2 = grafiksensor::where('user_id', $id)
        // ->where('index_sort', 2)->first();
        // $index1 = grafiksensor::where('user_id', $id)
        // ->where('index_sort', 1)->first();
		
        // Data utama
        // $realvalue=Crypt::decrypt(request()->value);
        $realvalue = request()->value;
        $data = alat::where('token arduino',$realvalue)->first();
        $idalat =$data->id;
        // Cek waktu sekarang
        $currentDateTime = Carbon::now();

        $datamanual=manual::where('token_alat',$realvalue)->first();
        $dataauto=auto::where('token_alat',$realvalue)->first();
        $datajadwal=jadwal::where('token_alat',$realvalue)->get();
        $weekDays=array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");

        $modealat=mode::where('token_alat', $realvalue)->first();

        return view('template.dashboard')
        ->with('data',$data)
        ->with('idalat',$idalat)
        ->with('currentDateTime', $currentDateTime)
        ->with('modealat',$modealat)
        ->with('datamanual',$datamanual)
        ->with('dataauto',$dataauto)
        ->with('datajadwal',$datajadwal)
        ->with('weekDays',$weekDays)

        ;
        // ->with('index4', $index4)
        // ->with('index3', $index3)
        // ->with('index2', $index2)
        // ->with('index1', $index1)
		// ->with('datakondisi',$kondisi);
    }

    public function cekstatus()
    {
        $id = request()->idalat;
        $data = alat::where('id', $id)->first();
        $currentDateTime = Carbon::now();
        return view('cekstatus', ['data' => $data],['currentDateTime'=>$currentDateTime]);
    }
    public function bacasuhu()
    {
        $id = request()->idalat;
        $sensor = alat::where('id', $id)->get();
        return view('bacasuhu', ['nilaisensor' => $sensor]);
    }

    public function bacakelembaban()
    {
        $id = request()->idalat;
        $sensor = alat::where('id', $id)->get();
        return view('bacakelembaban', ['nilaisensor' => $sensor]);
    }

    public function bacasoil()
    {
        $id = request()->idalat;
        $sensor = alat::where('id', $id)->get();
        return view('bacasoil', ['nilaisensor' => $sensor]);
    }

////////////////////////Test update data
    public function testupdate(){
        $id = request()->alatid;
        alat::where('id', $id)->update([
            'suhu' => request()->nilaisuhu,
            'kelembaban' => request()->nilaikelembaban,
            'soil' => request()->nilaisoil
        ]);
    }


}
