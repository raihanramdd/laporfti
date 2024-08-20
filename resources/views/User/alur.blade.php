@extends('layouts.user')

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Vesperr Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('import/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('import/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('import/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/other.css') }}">

</head>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('user.landing') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('images/FTI_Transparan.png') }}" alt="Logo" class="img-fluid w-25">
                <h1 class="sitename">LAPOR!</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>

                    @if (Auth::guard('masyarakat')->check())
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.logout') }}"
                                style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                        </li>
                    @else
                        <li><a href="{{ route('pekat.lamanAlurproses') }}">Alur Proses<br></a></li>
                        <li><a href="{{ route('pekat.lamanKontak') }}">Kontak</a></li>
                        <li><a href="{{ route('pekat.lamanFaq') }}">FAQ</a></li>
                        <li class="nav-item">
                        <button class="btn text-white mx-2" type="button" data-toggle="modal"
                            data-target="#loginModal">Masuk</button>
                        </li>
                        <li><a class="btn btn-outline-white mx-2" href="{{ route('pekat.formRegister') }}">Daftar</a></li>
                    @endif



                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>


        </div>
    </header>


    <!-- Logika Login PopUp -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Masuk terlebih dahulu</h3>
                    <p>Silahkan masuk menggunakan akun yang sudah didaftarkan.</p>
                    <form action="{{ route('pekat.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-purple text-white mt-3" style="width: 100%">MASUK</button>
                    </form>
                    @if (Session::has('pesan'))
                        <div class="alert alert-danger mt-2">
                            {{ Session::get('pesan') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Alur Proses Pelaporan</h2>
            <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
        </div><!-- End Section Title -->

        <div class="container d-flex justify-content-center">
            <img src="{{ asset('images/alur.png') }}" alt="Logo" style="width:1100px; height:600px;">
        </div>

    </section><!-- /Faq Section -->


    <footer id="footer" class="footer">

        <div class="copyright text-center ">
            <h5 class="medium text-white mt-3">JUMLAH LAPORAN SAAT INI</h5>
            <h2 class="medium text-white">{{ $jumlahLaporan }}</h2>
            <h5 class="small text-white mt-1">©2024. All rights reserved.</h5>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('import/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>


    <!-- Main JS File -->
    <script src="{{ asset('import/assets/js/main.js') }}"></script>



    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/66b0b3c632dca6db2cba226c/1i4h3sghl';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    @section('js')
    @if (Session::has('pesan'))
        <script>
            $('#loginModal').modal('show');
        </script>
    @endif
    @endsection


</body>

</html>