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
                    <form action="{{ route('store-buku-admin') }}" method="post" enctype="multipart/form-data">
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
                                <label>Date:</label>
                                  <div class="input-group date">
                                      <input type="date" name="bulan" class="form-control"/>
                                  </div>
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
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" name="stok" placeholder="Masukan stok buku">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ebook</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="path" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih File Ebook</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Volume</label>
                                <input type="text" class="form-control" id="volume" name="volume" placeholder="Masukan volume buku">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Sampul</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="sampul_buku" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Sampul</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" hidden name="sekolah_id" value="{{ auth()->user()->sekolah_id }}">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Jenis Buku</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="jenis_buku_id">
                                    <option disabled selected>Pilih jenis buku</option>
                                    @foreach ($jenisbukus as $jenisbuku)
                                        <option value="{{ $jenisbuku->id }}">{{ $jenisbuku->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe buku (genre)</label>
                                @foreach ($tipebukus as $key => $tipebuku )
                                <div class="form-check">
                                    <input class="form-check-input" name="tipe_buku_id[]" value="{{ $tipebuku->id }}" type="checkbox">
                                    <label class="form-check-label">{{ $tipebuku->nama }}</label>
                                </div>    
                                @endforeach
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
                    <th>Sampul</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbitan</th>
                    <th>Edisi</th>
                    <th>Bulan</th>
                    <th>ISBN</th>
                    <th>Stok</th>
                    <th>Subyek</th>
                    <th>Tipe Buku</th>
                    <th>Jenis Buku</th>
                    <th>Lokasi Buku</th>
                    <th>Ebook</th>
                    <th>Volume</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bukus as $key => $buku)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><img src="{{ asset('storage/' . $buku->sampul_buku) }}" alt="Sampul Buku" style="max-width: 100px;"></td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbitan }}</td>
                    <td>{{ $buku->edisi }}</td>
                    <td>{{ $buku->bulan }}</td>
                    <td>{{ $buku->isbn }}</td>
                    <td>{{ $buku->stok }}</td>
                    <td>{{ $buku->subyek }}</td>
                    <td> 
                        @foreach($buku->namatipebukus as $tipebuku)
                            {{ $tipebuku }}
                            @if(!$loop->last) {{-- Tampilkan koma jika bukan elemen terakhir --}}
                                ,
                            @endif
                        @endforeach    
                    </td>
                    <td>{{ $buku->jenisbuku->nama }}</td>
                    <td>{{ $buku->lokasibuku->lokasi }}</td>
                    @if($buku->path)
                    <td>
                        <a href="{{ route('view-ebook-admin',$buku) }}" target="_blank">Buka PDF</a>        
                    </td>
                    @else
                        <td>Tidak ada</td>
                    @endif
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
                            <form action="{{ route('update-buku-admin', $buku) }}" method="post" enctype="multipart/form-data">
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
                                    <label for="exampleInputFile">Ebook</label>
                                    <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="path" value="" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">
                                            @if($buku->path)
                                                {{ $buku->path }}
                                            @else
                                                Pilih Ebook
                                            @endif
                                        </label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload File</span>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Volume</label>
                                    <input type="text" class="form-control" id="volume" value="{{ $buku->volume }}" name="volume" placeholder="Masukan volume buku">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Sampul</label>
                                    @if($buku->sampul_buku)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $buku->sampul_buku) }}" alt="Sampul Buku" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="sampul_buku" value="" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">
                                                @if($buku->sampul_buku)
                                                    {{ $buku->sampul_buku }}
                                                @else
                                                    Pilih Sampul
                                                @endif
                                            </label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload Sampul</span>
                                        </div>
                                    </div>
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
                                    <label for="">Tipe buku (genre)</label>
                                    @foreach ($tipebukus as $key => $tipebuku)
                                        <div class="form-check">
                                            <input class="form-check-input" name="tipe_buku_id[]" value="{{ $tipebuku->id }}" type="checkbox" {{ in_array($tipebuku->id, $buku->tipebuku->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $tipebuku->nama }}</label>
                                        </div>
                                    @endforeach
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
                                    <label for="nama">Judul</label>
                                    <input type="text" disabled class="form-control" id="nama" name="judul" value="{{ $buku->judul }}" placeholder="Masukan nama">
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
    </div>
    {{-- {{ $bukus->links() }} --}}
    <!-- /.card-body -->
</div>
@endsection