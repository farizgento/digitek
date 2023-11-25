@extends('layout.master')
@section('title','Selamat Datang Admin')
@section('content')
@include('sweetalert::alert')
<div class="card">
    <div class="card-header">
        <div class="row mb-3">
            <h3 class="card-title"> Data lokasi buku </h3>
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
                        <h5 class="modal-title">Tambah data lokasi buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('store-lokasi') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Lokasi">Lokasi/Rak</label>
                                <input type="text" class="form-control" id="nama" name="lokasi" placeholder="Masukan lokasi buku">
                            </div>
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
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lokasibukus as $key => $lokasibuku)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $lokasibuku->lokasi }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="text-decoration-none text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{ $lokasibuku->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $lokasibuku->id }}">
                                <li class="p-2">
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editModal{{ $lokasibuku->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </li>
                                <li class="p-2">
                                    <!-- Tombol Hapus -->
                                    <button class="btn-danger btn-circle w-100" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $lokasibuku->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $lokasibuku->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $lokasibuku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah data lokasi buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('update-lokasi-buku', $lokasibuku) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="lokasi" value="{{ $lokasibuku->lokasi }}" placeholder="Masukan Lokasi">
                                </div>
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

                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusModal{{ $lokasibuku->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $lokasibuku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus data lokasi buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('delete-lokasi-buku',$lokasibuku) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" disabled class="form-control" id="nama" name="lokasi" value="{{ $lokasibuku->lokasi }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
                @endforeach
            </tbody>
        </table>

        <!-- Tampilkan link paginasi -->
        {{ $lokasibukus->links() }}
    </div>
    <!-- /.card-body -->
</div>
@endsection