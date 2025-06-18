@extends('layouts.app')

@section('content')
<h1>{{ $title }}</h1>

<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="confpassword" class="form-label">Konfirmasi Password</label>
        <input type="password" name="confpassword" id="confpassword" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection