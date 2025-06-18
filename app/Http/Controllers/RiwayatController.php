<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RiwayatController extends Controller
{
    public function index(){
        $id_user = Session::get('id_user'); // Ambil id_user dari session

    if (!$id_user) {
        return redirect()->route('login')->with('error', 'Silakan login dahulu');
    }

    $response = Http::get("http://localhost:8080/riwayatuser/{$id_user}");

    if (!$response->successful()) {
        return redirect()->route('riwayat')->with('error', 'Gagal mengambil data riwayat.');
    }

    $json = $response->json();
    $riwayat = $json['data'] ?? [];

    return view('user/riwayat/index', [
        'title' => 'Riwayat Peminjaman',
        'menuRiwayatPeminjaman' => 'active',
        'riwayat' => $riwayat
    ]);
    }
}
