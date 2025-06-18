@extends('layouts/app')
@section('content')

<!-- page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-user-alt mr-2"></i>
    {{$title}}
</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <!-- Tombol Tambah di kiri -->
        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Tambah Data
        </a>

    </div>
    <div class="card body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $item)
                    <tr class="text-center">

                        <td>{{$item['name']}}</td>
                        <td>{{$item['email']}}</td>
                        <td>{{$item['status']}}</td>
                        <td>{{$item['role']}}</td>
                        <td class="text-center">
                            <a href="{{ route('user.edit', $item['id_user']) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('user.destroy', $item['id_user']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
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