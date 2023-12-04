@extends('layout.master')
@section('title','Selamat Datang Admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row mb-3">
            <h3 class="card-title"> Data admin </h3>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah data admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('add-admin') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="name" placeholder="Masukan nama admin">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Sekolah</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="sekolah_id">
                                    <option disabled selected>Pilih Sekolah</option>
                                    @foreach ($sekolahs as $sekolah)
                                        <option value="{{ $sekolah->id }}">{{ $sekolah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email admin">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password admin">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Password Confirmation</label>
                                <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Masukan password admin">
                            </div>
                            <input type="text" name="role" value="admin" hidden>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 300px;">
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $key => $admin)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->sekolah->nama }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tampilkan link paginasi -->
        {{ $admins->links() }}
    </div>
    <!-- /.card-body -->
</div>
@endsection