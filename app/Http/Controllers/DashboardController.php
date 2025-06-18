<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $token = Session::get('token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Silakan login dahulu');
        }

        // Ambil data user
        $response = Http::withToken($token)->get('http://localhost:8080/');
        $message = 'Gagal mengambil data dari server';

        if ($response->successful() && ($response['status'] ?? false)) {
            Session::put('name', $response['name'] ?? 'Tidak diketahui');
            Session::put('email', $response['email'] ?? 'Tidak diketahui');
            Session::put('role', $response['role'] ?? 'Tidak diketahui');
            Session::put('id_user', $response['id_user'] ?? 'Tidak diketahui');
            $message = $response['message'];
        }

        // Ambil total rooms
        $roomsResponse = Http::withToken($token)->get('http://localhost:8080/rooms');
        $totalRooms = $roomsResponse->successful() ? ($roomsResponse['total_rooms'] ?? 0) : 0;

        // Ambil total users
        $usersResponse = Http::withToken($token)->get('http://localhost:8080/users');
        $totalUsers = $usersResponse->successful() ? ($usersResponse['total_users'] ?? 0) : 0;

        return view('dashboard', [
            'title' => 'Dashboard',
            'menuDashboard' => 'active',
            'nama_user' => Session::get('name'),
            'role' => Session::get('role'),
            'id_user' => Session::get('id_user'),
            'message' => $message,
            'total_rooms' => $totalRooms,
            'total_users' => $totalUsers
        ]);
    }
}
