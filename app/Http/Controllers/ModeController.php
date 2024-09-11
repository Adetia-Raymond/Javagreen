<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\alat;
use App\Models\mode;
use App\Models\manual;
use App\Models\auto;



class ModeController extends Controller
{   
    ////////////////////////////////////////////////MANUAL////////////////////////////////////////////////
    //MENGGANTI MODE MENJADI MANUAL
    public function modemanual(){
        $crypt=request()->crypttoken;
        // $token=Crypt::decrypt($crypt);
        // $crypt=request()->value;
        $token= request()->crypttoken;
        $alat=alat::where('token arduino',$token)->first();
        $mode=mode::where('token_alat',$token)->first();
        $mode->update(['mode'=>'manual']);
        return redirect()->route('main', ['value'=>$crypt]);
    }
    //MENGGANTI TOMBOL MANUAL
    public function updatemanual(Request $request)
    {
        $crypt=request()->crypttoken;
        // $token=Crypt::decrypt($crypt);
        // $crypt=request()->value;
        $token= request()->crypttoken;
        $alat=alat::where('token arduino',$token)->first();
        $datamanual=manual::where('token_alat',$token)->first();
        // $datamanual=manual::where('alat_id',$alat->id)->first();
        $datamanual->update([
            'tombol'=> request()->tombol,
        ]);
        return redirect()->route('main', ['value'=>$crypt]);
    }

    ////////////////////////////////////////////////AUTO////////////////////////////////////////////////
    //MENGGANTI MODE MENJADI AUTO
    public function modeauto(){
        $crypt=request()->crypttoken;
        // $token=Crypt::decrypt($crypt);
        // $crypt=request()->value;
        $token= request()->crypttoken;
        $alat=alat::where('token arduino',$token)->first();
        $mode=mode::where('token_alat',$token)->first();
        $mode->update(['mode'=>'auto']);
        return redirect()->route('main', ['value'=>$crypt]);
    }
    //MENGGANTI PARAMETER MANUAL
    public function updateauto(Request $request)
    {
        $crypt=request()->crypttoken;
        // $token=Crypt::decrypt($crypt);
        // $crypt=request()->value;
        $token= request()->crypttoken;
        $alat=alat::where('token arduino',$token)->first();
        $datauto=auto::where('token_alat',$token)->first();
        $datauto->update([
            'kelembaban_tanah' => request()->kelembaban_tanah
        ]);
        return redirect()->route('main', ['value'=>$crypt]);
    }

    ////////////////////////////////////////////////JADWAL////////////////////////////////////////////////
    //MENGGANTI MODE MENJADI JADWAL
    public function modejadwal(){
        $crypt=request()->crypttoken;
        // $token=Crypt::decrypt($crypt);
        // $crypt=request()->value;
        $token= request()->crypttoken;
        $alat=alat::where('token arduino',$token)->first();
        $mode=mode::where('token_alat',$token)->first();
        $mode->update(['mode'=>'jadwal']);
        return redirect()->route('main', ['value'=>$crypt]);
    }

    //MENGGANTI JADWAL
    //TAMBAH JADWAL
    public function tambahjadwal(Request $request)
    {
        $crypt=request()->crypttoken;
        // $token=Crypt::decrypt($crypt);
        // $crypt=request()->value;
        $token= request()->crypttoken;
        $alat=alat::where('token arduino',$token)->first();
        jadwal::create([
            'token_alat' => $token,
            'hari' => request()->hari,
            'jam' => request()->jam,
            'menit' => request()->menit,
            'delay' => request()->delay*1000,
        ]);
        return redirect()->route('main', ['value'=>$crypt]);
    }

    //HAPUS JADWAL
    public function hapusjadwal()
    {   
        $crypt=request()->crypttoken;
        // $token=Crypt::decrypt($crypt);
        // $crypt=request()->value;
        $token= request()->crypttoken;
        $id = request()->idjadwal;
        $jadwal=jadwal::where('id',$id)->first();
        $jadwal->delete();
        return redirect()->route('main', ['value'=>$crypt]);
    }

////////////////////////////////////////////////AKSES ARDUINO////////////////////////////////////////////////
///////////////BTW id_alat sudah direvisi jadi token_alt
//BACA MODE
    public function bacamode()
    {
        $id = request()->alatid;
        $modealat=mode::where('token_alat', $id)->first();
        return view('bacamode', ['modealat' => $modealat]);
    }
//BACA MODE MAMUAL
    public function bacastatusmanual()
    {
        $id = request()->alatid;
        $data=manual::where('token_alat', $id)->first();
        return view('bacastatusmanual', ['data' => $data]);
    }
//BACA MODE AUTO
    public function bacasettingauto()
    {
        $id = request()->alatid;
        $data=auto::where('token_alat', $id)->first();
        return view('bacasettingauto', ['data' => $data]);
    }
//BACA SETTING JADWAL
    public function bacasettingwaktu()
    {
        $id = request()->alatid;
        $data=jadwal::where('token_alat', $id)->get();
        return view('bacasettingwaktu', ['data' => $data]);
    }
}
