@extends('layout.master')
@section('title','Selamat Datang Super Admin')
@section('content')
@include('sweetalert::alert')
<div class="card">
    <div class="card-header">
        <div class="row mb-3">
            <h3 class="card-title"> Data Tipe buku </h3>
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
                        <h5 class="modal-title">Tambah Data Tipe Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('store-tipe-super') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama jenisbuku">
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
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipebukus as $key => $tipebuku)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $tipebuku->nama }}</td>
                    <td>{{ $tipebuku->sekolah->nama }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="text-decoration-none text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{ $tipebuku->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $tipebuku->id }}">
                                <li class="p-2">
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editModal{{ $tipebuku->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </li>
                                <li class="p-2">
                                    <!-- Tombol Hapus -->
                                    <button class="btn-danger btn-circle w-100" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $tipebuku->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $tipebuku->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $tipebuku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah data jenisbuku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('update-tipe-super', $tipebuku) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $tipebuku->nama }}" placeholder="Masukan nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Sekolah</label>
                                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="sekolah_id">
                                        @foreach ($sekolahs as $sekolah)
                                            <option value="{{ $sekolah->id }}" @if($sekolah->id == $tipebuku->sekolah_id) selected @endif>
                                                {{ $sekolah->nama }}
                                            </option>
                                        @endforeach
                                    </select>
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
                <div class="modal fade" id="hapusModal{{ $tipebuku->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $tipebuku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus data jenisbuku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('delete-tipe-super',$tipebuku) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" disabled class="form-control" id="nama" name="nama" value="{{ $tipebuku->nama }}" placeholder="Masukan nama">
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
        {{ $tipebukus->links() }}
    </div>
    <!-- /.card-body -->
</div>
@endsection