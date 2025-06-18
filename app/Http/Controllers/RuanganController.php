<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RuanganController extends Controller
{
    public function index()
    {

        $response = Http::get('http://localhost:8080/rooms');
        $rooms = $response->json();

        $data = array(
            'title'         => 'Kelola Ruangan',
            'menuKelolaRuangan' => 'active',
        );

        return view('admin/ruangan/index', $data, [
            'rooms' => $rooms['data_rooms']
        ]);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Ruangan'];
        return view('admin/ruangan/create', $data);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'capacity'  => 'required|integer|min:1',
            'status'    => 'required|string',
        ]);

        // Kirim data ke API backend
        $response = Http::post('http://localhost:8080/rooms', [
            'room_name' => $validated['room_name'],
            'location'  => $validated['location'],
            'capacity'  => $validated['capacity'],
            'status'    => $validated['status'],
        ]);

        if ($response->successful()) {
            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambah!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan ruangan.');
        }
    }

    public function edit($id)
    {
        $response = Http::get("http://localhost:8080/rooms/{$id}");
        $rooms = $response->json();

        $room = $rooms['rooms_byid'];
        if (!$response->successful() || !$room) {
            return redirect()->route('ruangan')->with('error', 'Ruangan tidak ditemukan.');
        }

        return view('admin/ruangan/edit', ['room' => $room, 'title' => 'Edit Ruangan']);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'capacity'  => 'required|integer|min:1',
            'status'    => 'required|string',
        ]);

        $response = Http::put("http://localhost:8080/rooms/{$id}", $validated);

        if ($response->successful()) {
            return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data ruangan.');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/rooms/{$id}");

        if ($response->successful()) {
            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus ruangan.');
        }
    }
}
