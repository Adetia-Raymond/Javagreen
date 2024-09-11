<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrScannerController;


// Route::get('/aaaaa/tokenmain', [AlatController::class, 'cryptfilter'])->name('expouad');

// Route::get('/', function () {
//     return redirect()->route('expouad');
// });

///////////////////////////////////////////////////////////
//MAIN ENTRANCE
Route::get('/{token}/tokenmain', [AlatController::class, 'cryptfilter']);
//CRYPTED ENTRANCE
Route::get('/{value}/main',[AlatController::class, 'viewmain'])->name('main');

///////////////////////////////////////////////////////////
//AJAX JQUERY LIVE UPDATE
Route::get('bacasuhu/{idalat}',  [AlatController::class, 'bacasuhu']);
Route::get('bacakelembaban/{idalat}',  [AlatController::class, 'bacakelembaban']);
Route::get('bacasoil/{idalat}',  [AlatController::class, 'bacasoil']);
Route::get('cekstatus/{idalat}',  [AlatController::class, 'cekstatus']);

//////////////////////////////////////////////////////////
Route::get('/simpandata/{alatid}/{nilaisuhu}/{nilaikelembaban}/{nilaisoil}',  [AlatController::class, 'testupdate']);

//////////////////////////////////////////////////////////
Route::get('{crypttoken}/mode-manual', [ModeController::class, 'modemanual']);
Route::put('setTombol',[ModeController::class, 'updatemanual'])->name('updatemanual');

//////////////////////////////////////////////////////////
Route::get('{crypttoken}/mode-auto', [ModeController::class, 'modeauto']);
Route::put('setAuto',[ModeController::class, 'updateauto'])->name('updateauto');

//////////////////////////////////////////////////////////
Route::get('{crypttoken}/mode-jadwal', [ModeController::class, 'modejadwal']);
Route::post('tambahJadwal',  [ModeController::class, 'tambahjadwal'])->name('tambahjadwal');
Route::get('hapusJadwal/{crypttoken}/{idjadwal}/',  [ModeController::class, 'hapusjadwal'])->name('hapusjadwal');

//////////////////////////////////////////////////////////
//AKSES ARDUINO
Route::get('bacamode/{alatid}',  [ModeController::class, 'bacamode']);
Route::get('bacastatusmanual/{alatid}',  [ModeController::class, 'bacastatusmanual']);
Route::get('bacasettingauto/{alatid}',  [ModeController::class, 'bacasettingauto']);
Route::get('bacasettingwaktu/{alatid}',  [ModeController::class, 'bacasettingwaktu']);



// Route::get('test', [ModeController::class, 'modemanual']);


// Route::get('/user-menu',[RelasialatController::class,'index'])->name('cek');
// Route::post('/user-menu',[RelasialatController::class,'store'])->name('token.add');
// Route::post('/user-menu',[RelasialatController::class,'destroy'])->name('destory');
// Profil

// 
// arduino

// admin
// Route::get('/admin',[TokenController::class,'index'])->name('cek');


Route::get('/static-sign-up', function () {
    // return view('template.static-sign-in');});
    return view('template.static-sign-up');})->name('regist');

Route::get('/login-page', function () {
    return view('template.static-sign-in');})->name('utama');
    // return view('template.static-sign-up');});

Route::get('/', function () {
     return redirect()->route('utama');
});


//Menu manajemen token
Route::get('/menutoken', [TokenController::class, 'menutoken'])->name('menutoken');

//Scan kode QR
Route::get('/scan', [QrScannerController::class, 'index']
)->name('scan');

//Link untuk kode QR 
Route::get('addtoken/{token}', [TokenController::class, 'tambahalat']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::POST('/user-profile', [ProfileController::class, 'token'])->name('template.profile');

});

Route::get('/admin',[admin::class,'index'])->middleware(['auth','admin']);

require __DIR__.'/auth.php';
