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
        <style>
            #cardCarousel {
    position: relative;
}

.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 5%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    height: 50px;
    width: 50px;
    background-size: 100%, 100%;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.5);
}

.carousel-control-prev {
    left: 0;
}

.carousel-control-next {
    right: 0;
}
        </style>
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
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">PERPUSTAKAAN DIGITEK</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">
                            Digitek, perpustakaan yang memeluk inovasi dan kreativitas. Setiap buku adalah pintu ke dunia tak terbatas, di mana pengetahuan menjadi petualangan</p>
                        <a class="btn btn-primary btn-xl" href="#about"> Selamat datang di Digitek, tempatnya penjelajahan ilmu.</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Temukan pengetahuan tanpa batas di Digitek!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Kami memiliki buku-buku yang Anda inginkan, cerita-cerita yang Anda cari, dan kebijaksanaan yang Anda butuhkan. Selamat datang dalam dunia pembelajaran yang tak terbatas.</p>
                        <a class="btn btn-light btn-xl" href="#services">Mulai Jelajahi !</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Layanan Untuk Anda</h2>
                <hr class="divider"/>
                <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $cardsPerSlide = 4;
                            $ebooksData = auth()->check() ? $ebooks : $allEbooks;
                            $totalBooks = count($ebooksData);
                            $totalSlides = ceil($totalBooks / $cardsPerSlide);
                        @endphp
                
                        @for ($i = 0; $i < $totalSlides; $i++)
                            <div class="carousel-item{{ $i == 0 ? ' active' : '' }}">
                                <div class="row gx-4 gx-lg-5">
                                    @for ($j = 0; $j < $cardsPerSlide && ($i * $cardsPerSlide + $j) < $totalBooks; $j++)
                                        @php
                                            $index = $i * $cardsPerSlide + $j;
                                            $ebook = $ebooksData[$index];
                                        @endphp
                                        <div class="col-lg-3 col-md-6 text-center">
                                            <a href="{{ route('view-ebook-member',$ebook) }}" target="_blank" class="text-decoration-none text-dark">
                                                <div class="card" style="min-height: 23rem;">
                                                    <img src="{{ asset('storage/'.$ebook->sampul_buku) }}" class="card-img-top" alt="{{ $ebook->judul }}" style="max-height: 200px">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $ebook->judul }}</h5>
                                                        <p class="card-text text-start mb-1"><small>Halaman : {{ $ebook->halaman }} </small></p>
                                                        <p class="card-text text-start mb-1"><small>ISBN: {{ $ebook->isbn }}</small></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endfor
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Berikutnya</span>
                    </button>
                </div>
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
