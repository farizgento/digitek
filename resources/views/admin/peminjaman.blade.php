@extends('layout.master')
@section('title','Selamat Datang Admin')
@section('content')
@include('sweetalert::alert')
<div class="card">
    <div class="card-header">
        <div class="row mb-3">
            <h3 class="card-title"> Data Peminjaman </h3>
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
                    <th>Buku</th>
                    <th>Kondisi</th>
                    <th>Denda</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Konfirmasi Peminjaman</th>
                    <th>Konfirmasi Pengembalian</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $key => $peminjaman)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $peminjaman->users->name }}</td>
                    <td>{{ implode(', ', $peminjaman->bukus->pluck('judul')->toArray()) }}</td>
                    <td>{{ $peminjaman->kondisi_buku }}</td>
                    <td>{{ $peminjaman->denda }}</td>
                    @if ($peminjaman->tanggal_pengembalian)
                    <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                    @else
                    <td>Menunggu konfirmasi</td>
                    @endif
                    <td>{{ $peminjaman->konfirmasi_pinjam }}</td>
                    <td>{{ $peminjaman->konfirmasi_kembali }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="text-decoration-none text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{ $peminjaman->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $peminjaman->id }}">
                                <li class="p-2">
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editModal{{ $peminjaman->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </li>
                                <li class="p-2">
                                    <!-- Tombol Hapus -->
                                    <button class="btn-danger btn-circle w-100" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $peminjaman->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah data Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('update-peminjaman-admin', $peminjaman) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" disabled class="form-control" name="user_id" value="{{ $peminjaman->users->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Buku</label>
                                    <input type="text" disabled class="form-control" name="buku_id[]" value="{{ implode(', ', $peminjaman->bukus->pluck('judul')->toArray()) }}">
                                </div>
                                <div class="form-group">
                                    <label>Kondisi Buku</label>
                                    <input type="text" class="form-control" name="kondisi_buku" value="{{ $peminjaman->kondisi_buku }}">
                                </div>
                                <div class="form-group">
                                    <label>Denda</label>
                                    <input type="number" class="form-control" name="denda" value="{{ $peminjaman->denda }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Konfirmasi Peminjaman</label>
                                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="konfirmasi_pinjam">
                                        @foreach (App\Models\Peminjaman::getKonfirmasiPeminjamanValues() as $value)
                                            <option value="{{ $value }}" @if($peminjaman->konfirmasi_pinjam == $value) selected @endif>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>                                
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Konfirmasi Pengembalian</label>
                                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="konfirmasi_kembali">
                                        @foreach (App\Models\Peminjaman::getKonfirmasiKembaliValues() as $value)
                                            <option value="{{ $value }}" @if($peminjaman->konfirmasi_kembali == $value) selected @endif>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>                                                                 
                                <input type="text" class="form-control" hidden name="sekolah_id" value="{{ $peminjaman->sekolah_id }}">
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
                <div class="modal fade" id="hapusModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus data jenisbuku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('delete-tipe-admin',$peminjaman) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" disabled class="form-control" id="nama" name="nama" value="{{ $peminjaman->nama }}" placeholder="Masukan nama">
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
        {{ $peminjamans->links() }}
    </div>
    <!-- /.card-body -->
</div>
@endsection