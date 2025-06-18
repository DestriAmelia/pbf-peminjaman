@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <h6>Edit Peminjaman</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('pinjam.update', $booking['id_booking']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_name" class="form-label">Nama User</label>
                <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $booking['user_name']) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="room_name" class="form-label">Nama Ruangan</label>
                <input type="text" name="room_name" class="form-control" value="{{ old('room_name', $booking['room_name']) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $booking['start_date']) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('end_date', $booking['end_date']) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Waktu Mulai</label>
                <input type="time" name="start_date" class="form-control" value="{{ old('start_time', $booking['start_time']) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">Waktu Selesai</label>
                <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $booking['end_time']) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Pending" {{ $booking['status'] == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Accepted" {{ $booking['status'] == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="Declined" {{ $booking['status'] == 'Declined' ? 'selected' : '' }}>Declined</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('pinjam.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection