@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mt-7">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Edit Data User
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="username" class="form-control-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('name', $user->username) }}" required>
                                @error('username')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-control-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-control-label">Password (Kosongkan jika tidak ingin
                                    mengubah):</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">Konfirmasi Password:</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="showPassword" class="mt-3" onclick="togglePasswords()">
                                <label for="showPassword">Show Password</label>
                            </div>

                            <script>
                                function togglePasswords() {
                                    var passwordFields = document.querySelectorAll("input[type='password']");
                                    passwordFields.forEach(field => {
                                        field.type = field.type === "password" ? "text" : "password";
                                    });
                                }
                            </script>

                            <div class="form-group">
                                <label for="role" class="form-control-label">Role:</label>
                                <select id="role" class="form-control mb-3" name="role" required>
                                    <option value="" disabled hidden>--- Select Role ---</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>user</option>
                                </select>
                                @error('role')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update User</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection