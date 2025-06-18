@extends('layouts.app')
@section('content')

<div class="card shadow mb-4">

    <div class="card-header bg-primary text-white">

        <h6>Edit User</h6>

    </div>

    <div class="card-body">

        <form action="{{ route('user.update', $user['id_user']) }}" method="POST">

            @csrf

            @method('PUT')



            <div class="mb-3">

                <label for="name" class="form-label">Nama User</label>

                <input type="text" name="name" class="form-control" value="{{ old('name', $user['name']) }}" required>

            </div>

            <div class="mb-3">

                <label for="email" class="form-label">Email</label>

                <input type="text" name="email" class="form-control" value="{{ old('email', $user['email']) }}" required>

            </div>

            <div class="mb-3">

                <label for="status" class="form-label">Status</label>

                <input type="text" name="status" class="form-control" value="{{ old('status', $user['status']) }}" required>

            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user['role'] == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

            <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>

        </form>

    </div>

</div>

@endsection