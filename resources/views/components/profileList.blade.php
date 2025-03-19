@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('users.create') }}" class="btn btn-md btn-success">Tambahkan User</a>
                            </div>
                        </div>

                        <div class="card-header">
                            <h4>
                                List Pengguna
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body px-0 pt-0 pb-4">
                                <div class="table-responsive p-0">
                                    <table id="datatable" class="table align-items-center mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="white-space: nowrap;" class="text-center">No</th>
                                                <th style="white-space: nowrap;" class="text-center">Username</th>
                                                <th style="white-space: nowrap;" class="text-center">Name</th>
                                                <th style="white-space: nowrap;" class="text-center">email</th>
                                                <th style="white-space: nowrap;" class="text-center">role</th>
                                                <th style="white-space: nowrap;" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $index => $user)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td class="text-center">{{ $user->username }}</td>
                                                    <td class="text-center">{{ $user->name }}</td>
                                                    <td class="text-center">{{ $user->email }}</td>
                                                    <td class="text-center">{{ $user->role }}</td>
                                                    <td class="d-flex justify-content-center gap-2">
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="POST" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                            class="d-flex gap-2">
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="btn btn-primary">Edit</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>

                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="16">
                                                        <div class="alert alert-danger text-center">
                                                            Tidak User yang terdaftar
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
