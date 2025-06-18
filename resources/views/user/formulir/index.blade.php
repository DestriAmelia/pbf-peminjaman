@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-primary text-white">
        <h6 class="m-0 font-weight-bold">Formulir Peminjaman Ruangan Kelas</h6>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('formulir.isi') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Peminjam</label>
                <!-- Menampilkan nama user yang login -->
                <input type="text" class="form-control" value="{{ Session::get('name') }}" readonly>

                <!-- Mengirim ID user ke backend saat form disubmit -->
                <input type="hidden" name="user_id" value="{{ Session::get('id_user') }}">
            </div>


            <div class="mb-3">
                <label for="ruangan" class="form-label">Nama Ruangan</label>
                <select name="ruangan" class="form-control" required>
                    <option disabled selected>Pilih Ruangan</option>
                    @foreach ($rooms as $room)
                    <option value="{{ $room['id_room'] }}">{{$room['room_name']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Selesai</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="keperluan" class="form-label">Keperluan</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Ajukan</button>
        </form>
    </div>
</div>
@endsection