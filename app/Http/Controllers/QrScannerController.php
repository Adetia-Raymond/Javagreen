<?php
// app/Http/Controllers/QrScannerController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrScannerController extends Controller
{
    public function index()
    {
        return view('qr-scan');
    }
}
