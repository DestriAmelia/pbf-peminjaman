@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <h6>Edit Ruangan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('ruangan.update', $room['id_room']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="room_name" class="form-label">Nama Ruangan</label>
                <input type="text" name="room_name" class="form-control" value="{{ old('room_name', $room['room_name']) }}" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $room['location']) }}" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasitas</label>
                <input type="number" name="capacity" class="form-control" pattern="[0-9]*" min=1 value="{{ old('capacity', $room['capacity']) }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="available" {{ $room['status'] == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="unavailable" {{ $room['status'] == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection