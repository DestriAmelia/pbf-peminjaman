<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {

        $response = Http::get('http://localhost:8080/users');
        $users = $response->json();

        $data = array(
            'title'         => 'Kelola User',
            'menuAdminUser' => 'active',
        );
        return view('admin/user/index', $data, [
            'users' => $users['data_users']
        ]);
    }

    public function autocomplete(Request $request)
    {
        $q = $request->get('q');

        // Panggil API backend CI untuk cari user yang cocok
        $response = Http::get('http://localhost:8080/username/search', [
            'search' => $q
        ]);

        if ($response->successful()) {
            $users = $response->json();
            $results = [];
            foreach ($users['data_users'] as $user) {
                $results[] = [
                    'id' => $user['id_user'],
                    'text' => $user['name'],
                ];
            }
            return response()->json($results);
        }
        return response()->json([]);
    }

     public function create()
{
    $data = ['title' => 'Tambah User'];
    return view('admin/user/create', $data);
}

public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email',
        'password' => 'required|string|min:4',
        'confpassword' => 'required|string|min:4',
    
    ]);

    // Kirim request ke API CodeIgniter yang dilindungi token JWT
    $token = Session::get('token'); // pastikan token sudah disimpan saat login

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('http://localhost:8080/register', [
        'name'     => $validated['name'],
        'email'    => $validated['email'],
        'password' => $validated['password'], // Password belum di-encrypt di Laravel
        'confpassword' => $validated['confpassword'],

    ]);

    if ($response->successful()) {
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    } else {
        // Ambil pesan error dari response (jika ada)
        $errorMessage = $response->json('message') ?? 'Gagal menambahkan user.';
        return redirect()->back()->withInput()->with('error', $errorMessage);
    }
}
    // edit
    public function edit($id)
    {
        $response = Http::get("http://localhost:8080/users/{$id}");
        $users = $response->json();

        $user = $users['users_byid'];
        if (!$response->successful() || !$user) {
            return redirect()->route('user')->with('error', 'User tidak ditemukan.');
        }

        return view('admin/user/edit', ['user' => $user, 'title' => 'Edit User']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email'  => 'required|string|max:255',
            'status'    => 'required|string',
            'role'    => 'required|string',
        ]);

        $response = Http::put("http://localhost:8080/users/{$id}", $validated);

        if ($response->successful()) {
            return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data user.');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/users/{$id}");

        if ($response->successful()) {
            return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus user.');
        }
    }
   
}
