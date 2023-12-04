<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>DIGITEK</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset ('template-user') }}/css/styles.css" rel="stylesheet" />
        @include('sweetalert::alert')
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">DIGITEK</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item d-flex align-items-center"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a class="nav-link dropdown-toggle" href="#" id="koleksiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Koleksi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="koleksiDropdown">
                                @foreach ($jenisbukus as $key => $jenisbuku )
                                <li><a class="dropdown-item" href="{{ route('buku-user', $jenisbuku) }}">{{ $jenisbuku->nama }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @if (auth()->check())
                        <li class="nav-item d-flex align-items-center"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalCart">Keranjang</a></li>
                        @endif
                        @if (auth()->check())
                        <li class="nav-item d-flex align-items-center"><a class="nav-link" href="{{ route('get-peminjaman-member') }}">Peminjaman</a></li>
                        @endif
                        <li class="nav-item d-flex align-items-center">                            
                            @if (auth()->check())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark ms-2">Logout</button>
                            </form>
                            @else
                                <a class="btn btn-outline-dark ms-2" href="/login">Login</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Modal Keranjang-->
        <div class="modal fade" id="modalCart" tabindex="-1" aria-labelledby="ModalLabelCart" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabelCart">Keranjang Pinjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @foreach($bukucarts as $bukucart)
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0">ID :{{ $bukucart->id }}</p>
                        <p class="m-0">Judul :{{ $bukucart->judul }}</p>
                        <form action="{{ route('hapus-cart', $bukucart->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                    <hr>
                @endforeach
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Pinjam</button>
                </form>
                </div>
            </div>
            </div>
        </div>
        <!-- About-->
        <section class="h-50 bg-primary d-flex align-items-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="justify-content-center">
                    <div class="">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-white-75">Home</a></li>
                              <li class="breadcrumb-item text-white-75">Peminjaman</li>
                            </ol>
                        </nav>
                        <hr class="border border-danger opacity-75">
                        <h3 class="text-white mb-4">DATA PEMINJAMAN</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="container pt-3">
            {{-- tabel peminjaman user --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Buku</th>
                        <th scope="col">Denda</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Konfirmasi Peminjaman</th>
                        <th scope="col">Konfirmasi Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamans as $key => $peminjaman)
                    <tr>
                        <td scope="row">{{ $key+1 }}</td>
                        <td>
                            @foreach($peminjaman->judulbukus as $judulbuku)
                                {{ $judulbuku }}
                                @if(!$loop->last) {{-- Tampilkan koma jika bukan elemen terakhir --}}
                                ,
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $peminjaman->denda }}</td>
                        @if ($peminjaman->tanggal_pengembalian)
                            <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                        @else
                            <td>Proses</td>
                        @endif 
                        <td>{{ $peminjaman->konfirmasi_pinjam }}</td> 
                        <td>{{ $peminjaman->konfirmasi_kembali }}</td> 
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada buku yang dipinjam.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>        
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2023 - Company Name</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset ('template-user') }}/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
