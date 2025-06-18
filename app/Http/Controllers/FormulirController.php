<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class FormulirController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/rooms');
        $responseUser = Http::get('http://localhost:8080/users');
        $rooms = $response->json();
        $users = $responseUser->json();



        return view('user.formulir.index', [
            'title' => 'Formulir Peminjaman',
            'menuFormulirPeminjaman' => 'active',
            'rooms' => $rooms['data_rooms'],
            'users' => $users['data_users']
        ]);
    }



        public function store(Request $request)
{
    // Validasi form input
    $request->validate([
        'user_id'     => 'required|numeric',
        'ruangan'     => 'required|numeric',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after_or_equal:start_date',
        'start_time'  => 'required',
        'end_time'    => 'required|after:start_time',
        'description' => 'required|string',
    ]);

    // Siapkan data untuk dikirim ke backend CI
    $postData = [
        'id_user'      => $request->user_id,
        'id_room'      => $request->ruangan,
        'booking_date' => now()->toDateString(),
        'start_date'   => $request->start_date,
        'end_date'     => $request->end_date,
        'start_time'   => $request->start_time,
        'end_time'     => $request->end_time,
        'description'  => $request->description,
        'status'       => 'pending'
    ];

    // Kirim data ke backend CI
    $response = Http::post('http://localhost:8080/bookings', $postData);

   if ($response->successful()) {
        // Cek role dari session
        $role = Session::get('role');

        if ($role === 'user') {
            return redirect()->route('riwayat')->with('success', 'Peminjaman berhasil diajukan!');
        } elseif ($role === 'admin') {
            return redirect()->route('pinjam.index')->with('success', 'Peminjaman berhasil diajukan!');
        } else {
            // Role tidak diketahui
            return redirect()->back()->with('success', 'Peminjaman berhasil diajukan!');
        }
    } else {
        return redirect()->back()->with('error', 'Gagal mengirim data ke server.');
    }
}

}
