@extends('layouts/app')
@section('content')

<!-- page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks mr-2"></i>
    {{$title}}
</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>Nama User</th>
                        <th>Nama Ruangan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $item)
                    <tr class="text-center">
                        <td>{{$item['name']}}</td>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection