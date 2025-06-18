@extends('layouts/app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-home mr-2"></i>
    {{$title}}
</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <!-- Tombol Tambah di kiri -->
        <a href="{{ route('ruangan.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Tambah Data
        </a>



    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>Nama Ruangan</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($rooms as $item)
                    <tr class="text-center">
                        <td style="display:none;">{{ $item['id_room'] }}</td>
                        <td>{{$item['room_name']}}</td>
                        <td>{{$item['location']}}</td>
                        <td>{{$item['capacity']}}</td>
                        <td class="text-center">
                            @if($item['status'] == 'unavailable')
                            <span class="badge bg-danger text-white">
                                {{ strtoupper($item['status']) }}
                            </span>
                            @else($item['status'] == 'available')
                            <span class="badge bg-success text-white">
                                {{ strtoupper($item['status']) }}
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('ruangan.edit', $item['id_room']) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('ruangan.destroy', $item['id_room']) }}" method="POST" style="display:inline;">
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