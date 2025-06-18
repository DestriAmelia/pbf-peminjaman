@extends('layouts/app')
@section('content')

<!-- page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks mr-2"></i>
    {{$title}}
</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <!-- Tombol Tambah di kiri -->
        <a href="{{ route('formulir') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Tambah Data
        </a>

    </div>
    <div class="card body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>Id Booking</th>
                        <th>Nama User</th>
                        <th>Nama Ruangan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bookings as $item)
                    <tr class="text-center">

                        <td>{{$item['id_booking']}}</td>
                        <td>{{$item['user_name']}}</td>
                        <td>{{$item['room_name']}}</td>
                        <td>{{$item['start_date']}}</td>
                        <td>{{$item['end_date']}}</td>
                        <td>{{$item['start_time']}}</td>
                        <td>{{$item['end_time']}}</td>
                        <td>{{$item['description']}}</td>
                        <td class="text-center">
                            @if($item['status'] == 'Pending')
                            <span class="badge bg-warning text-white">
                                {{ strtoupper($item['status']) }}
                            </span>
                            @elseif($item['status'] == 'Accepted')
                            <span class="badge bg-success text-white">
                                {{ strtoupper($item['status']) }}
                            </span>
                             @else($item['status'] == 'Declined')
                            <span class="badge bg-danger text-white">
                                {{ strtoupper($item['status']) }}
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pinjam.edit', $item['id_booking']) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('pinjam.destroy', $item['id_booking']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus ruangan ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection