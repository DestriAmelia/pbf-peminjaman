<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PinjamController extends Controller
{
    public function index()
    {

        $response = Http::get('http://localhost:8080/bookings');
        $bookings = $response->json();

        $data = array(
            'title'                => 'Kelola Peminjaman',
            'menuKelolaPeminjaman' => 'active',
        );
        return view('admin/pinjam/index', $data, [
            'bookings' => $bookings['data_users']
        ]);
    }

    public function edit($id)
    {
        $response = Http::get("http://localhost:8080/bookings/{$id}");
        $bookings = $response->json();

        $booking = $bookings['bookings_byid'];
        if (!$response->successful() || !$booking) {
            return redirect()->route('pinjam')->with('error', 'Data Peminjaman tidak ditemukan.');
        }

        return view('admin/pinjam/edit', ['booking' => $booking, 'title' => 'Edit Peminjaman']);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status'    => 'required|string',
        ]);

        $response = Http::put("http://localhost:8080/bookings/{$id}", $validated);

        if ($response->successful()) {
            return redirect()->route('pinjam.index')->with('success', 'Data Peminjaman berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui Data Peminjaman.');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/bookings/{$id}");

        if ($response->successful()) {
            return redirect()->route('pinjam.index')->with('success', 'Data Peminjaman berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus Data Peminjaman.');
        }
    }
}
