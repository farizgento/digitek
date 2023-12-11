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
                                @if(auth()->check())
                                    @foreach ($jenisbukus as $jenis)
                                        <li><a class="dropdown-item" href="{{ route('buku-user', $jenis) }}">{{ $jenis->nama }}</a></li>
                                    @endforeach
                                @else
                                    @foreach ($allJenis as $jenis)
                                        <li><a class="dropdown-item" href="{{ route('buku-user', $jenis) }}">{{ $jenis->nama }}</a></li>
                                    @endforeach
                                @endif
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
        @if (auth()->check())        
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
        @endif
        <!-- About-->
        <section class="h-50 bg-primary d-flex align-items-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="justify-content-center">
                    <div class="">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-white-75">Home</a></li>
                              <li class="breadcrumb-item text-white-75">Koleksi</li>
                              <li class="breadcrumb-item text-white">{{ $jenisbuku->nama }}</li>
                            </ol>
                        </nav>
                        <hr class="border border-danger opacity-75">
                        <h3 class="text-white mb-4">Koleksi {{ $jenisbuku->nama }}</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="container pt-3">
            <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                @forelse( auth()->check() ? $bukus : $allBukus as $key => $buku )
                <div class="col">
                    <div class="card" style="min-height: 35rem">
                        <img src="{{ asset('storage/' . $buku->sampul_buku) }}" class="card-img-top" style="max-height: 18rem" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $buku->judul }}</h5>
                        @if ($buku->penulis)
                        <p class="card-text mb-1">Penulis : {{ $buku->penulis }}</p>
                        @endif
                        @if ($buku->penerbitan)
                        <p class="card-text mb-1">Penerbitan : {{ $buku->penerbitan }}</p>
                        @endif
                        @if ($buku->edisi)
                        <p class="card-text mb-1">Edisi : {{ $buku->edisi }}</p>
                        @endif
                        @if ($buku->bulan)
                        <p class="card-text mb-1">Bulan : {{ $buku->bulan }}</p>
                        @endif
                        @if ($buku->isbn)
                        <p class="card-text mb-1">ISBN : {{ $buku->isbn }}</p>
                        @endif
                        @if ($buku->stok)
                        <p class="card-text mb-1">Stok : {{ $buku->stok }}</p>
                        @endif
                        @if ($buku->lokasi)
                        <p class="card-text mb-1">Lokasi : {{ $buku->lokasi->lokasi }}</p>
                        @endif
                        @if ($buku->namatipebukus)
                        <p class="card-text mb-1">Tipe : 
                            @foreach($buku->namatipebukus as $tipebuku)
                            {{ $tipebuku }}
                            @if(!$loop->last) {{-- Tampilkan koma jika bukan elemen terakhir --}}
                                ,
                            @endif
                        @endforeach    
                        </p>
                        @endif
                        @if (auth()->check())
                            @if ($buku->path)
                            <p class="card-text mb-1">Ebook : 
                                <a href="{{ route('view-ebook-member',$buku) }}" target="_blank" class="text-decoration-none">Buka</a>
                            </p>
                            @else
                                <a href="{{ route('add-cart',$buku) }}" class="btn btn-success">Tambah</a>
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Tidak ada buku tersedia.</p>
                </div>
                @endforelse
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2023 - DIGITEK</div></div>
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
