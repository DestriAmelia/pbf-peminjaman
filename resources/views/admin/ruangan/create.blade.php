@extends('layouts/app')

@section('content')
<h1>{{ $title }}</h1>

<form action="{{ route('ruangan.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="room_name" class="form-label">Nama Ruangan</label>
        <input type="text" name="room_name" id="room_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" name="location" id="location" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="capacity" class="form-label">Kapasitas</label>
        <input type="number" name="capacity" id="capacity" class="form-control" pattern="[0-9]*" min=1 required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="available">Tersedia</option>
            <option value="unavailable">Tidak Tersedia</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection