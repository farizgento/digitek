@extends('layout.master')
@section('title','Selamat Datang Admin')
@section('content')
@include('sweetalert::alert')
<div class="card">
    <div class="card-header">
        <div class="row mb-3">
            <h3 class="card-title"> Data Buku </h3>
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
                        <h5 class="modal-title">Tambah data buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('store-buku-admin') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan judul buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">penulis</label>
                                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukan penulis buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Penerbitan</label>
                                <input type="text" class="form-control" id="penerbitan" name="penerbitan" placeholder="Masukan penerbitan buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Edisi</label>
                                <input type="text" class="form-control" id="edisi" name="edisi" placeholder="Masukan edisi buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Bulan</label>
                                <input type="text" class="form-control" id="bulan" name="bulan" placeholder="Masukan bulan buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Masukan isbn buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Subyek</label>
                                <input type="text" class="form-control" id="subyek" name="subyek" placeholder="Masukan subyek buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Jenis</label>
                                <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukan jenis buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Path</label>
                                <input type="text" class="form-control" id="path" name="path" placeholder="Masukan path buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Volume</label>
                                <input type="text" class="form-control" id="volume" name="volume" placeholder="Masukan volume buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">sampul</label>
                                <input type="text" class="form-control" id="sampul" name="sampul_buku" placeholder="Masukan sampul buku">
                            </div>
                            <input type="text" class="form-control" hidden name="sekolah_id" value="{{ auth()->user()->sekolah_id }}">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Jenis Buku</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="jenis_buku_id">
                                    <option disabled selected>Pilih Jenis Buku</option>
                                    @foreach ($jenisbukus as $jenisbuku)
                                        <option value="{{ $jenisbuku->id }}">{{ $jenisbuku->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Tipe Buku</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="tipe_buku_id">
                                    <option disabled selected>Pilih tipe buku</option>
                                    @foreach ($tipebukus as $tipebuku)
                                        <option value="{{ $tipebuku->id }}">{{ $tipebuku->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Lokasi Buku</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="lokasi_buku_id">
                                    <option disabled selected>Pilih Lokasi Buku</option>
                                    @foreach ($lokasibukus as $lokasibuku)
                                        <option value="{{ $lokasibuku->id }}">{{ $lokasibuku->lokasi }}</option>
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
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbitan</th>
                    <th>Edisi</th>
                    <th>Bulan</th>
                    <th>ISBN</th>
                    <th>Subyek</th>
                    <th>Jenis</th>
                    <th>Path</th>
                    <th>Volume</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bukus as $key => $buku)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbitan }}</td>
                    <td>{{ $buku->edisi }}</td>
                    <td>{{ $buku->bulan }}</td>
                    <td>{{ $buku->isbn }}</td>
                    <td>{{ $buku->subyek }}</td>
                    <td>{{ $buku->jenis }}</td>
                    <td>{{ $buku->path }}</td>
                    <td>{{ $buku->volume }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="text-decoration-none text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{ $buku->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $buku->id }}">
                                <li class="p-2">
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editModal{{ $buku->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </li>
                                <li class="p-2">
                                    <!-- Tombol Hapus -->
                                    <button class="btn-danger btn-circle w-100" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $buku->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $buku->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah data buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('update-buku-admin', $buku) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" value="{{ $buku->judul }}" name="judul" placeholder="Masukan judul buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">penulis</label>
                                <input type="text" class="form-control" id="penulis" value="{{ $buku->penulis }}" name="penulis" placeholder="Masukan penulis buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Penerbitan</label>
                                <input type="text" class="form-control" id="penerbitan" value="{{ $buku->penerbitan }}" name="penerbitan" placeholder="Masukan penerbitan buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Edisi</label>
                                <input type="text" class="form-control" id="edisi" value="{{ $buku->edisi }}" name="edisi" placeholder="Masukan edisi buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Bulan</label>
                                <input type="text" class="form-control" id="bulan" value="{{ $buku->bulan }}" name="bulan" placeholder="Masukan bulan buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">ISBN</label>
                                <input type="text" class="form-control" id="isbn" value="{{ $buku->isbn }}" name="isbn" placeholder="Masukan isbn buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Subyek</label>
                                <input type="text" class="form-control" id="subyek" value="{{ $buku->subyek }}" name="subyek" placeholder="Masukan subyek buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Jenis</label>
                                <input type="text" class="form-control" id="jenis" value="{{ $buku->jenis }}" name="jenis" placeholder="Masukan jenis buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Path</label>
                                <input type="text" class="form-control" id="path" value="{{ $buku->path }}" name="path" placeholder="Masukan path buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">Volume</label>
                                <input type="text" class="form-control" id="volume" value="{{ $buku->volume }}" name="volume" placeholder="Masukan volume buku">
                            </div>
                            <div class="form-group">
                                <label for="nama">sampul</label>
                                <input type="text" class="form-control" id="sampul" value="{{ $buku->sampul_buku }}" name="sampul_buku" placeholder="Masukan sampul buku">
                            </div>
                            <input type="text" class="form-control" hidden name="sekolah_id" value="{{ $buku->sekolah_id }}">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Jenis Buku</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="jenis_buku_id">
                                @foreach ($jenisbukus as $jenisbuku)
                                    <option value="{{ $jenisbuku->id }}" @if($jenisbuku->id == $buku->jenis_buku_id) selected @endif>
                                        {{ $jenisbuku->nama }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Tipe Buku</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="tipe_buku_id">
                                    @foreach ($tipebukus as $tipebuku)
                                        <option value="{{ $tipebuku->id }}" @if($tipebuku->id == $buku->jenis_buku_id) selected @endif>
                                            {{ $tipebuku->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Lokasi Buku</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="lokasi_buku_id">
                                    @foreach ($lokasibukus as $lokasibuku)
                                        <option value="{{ $lokasibuku->id }}" @if($lokasibuku->id == $buku->lokasi_buku_id) selected @endif>
                                            {{ $lokasibuku->lokasi }}
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
                <div class="modal fade" id="hapusModal{{ $buku->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus data buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('delete-buku-admin',$buku) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" disabled class="form-control" id="nama" name="nama" value="{{ $buku->nama }}" placeholder="Masukan nama">
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
        {{ $bukus->links() }}
    </div>
    <!-- /.card-body -->
</div>
@endsection