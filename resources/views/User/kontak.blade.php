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
    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <p>Silahkan hubungi kami jika terdapat masalah lebih lanjut</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center gy-4">
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="info-item text-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <h3>Alamat</h3>
                            <p>Jl. Margonda Raya No.100,Beji Depok (Ruangan D421)</p>
                        </div>
                    </div><!-- End Info Item -->
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="info-item text-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <div>
                            <h3>Nomor Telefon</h3>
                            <p>021-78881112, ext- 234<br>0818 0717 5316</p>
                        </div>
                    </div><!-- End Info Item -->
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="info-item text-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <h3>Email</h3>
                            <p>t.informatika@gunadarma.ac.id <br> raihanramdani41@yahoo.com</p>
                        </div>
                    </div><!-- End Info Item -->
                </div>
            </div>
        </div>

        <div class="row g-5">
        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.5s">
            <div class="h-100 text-center">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.192653571578!2d106.83061947576607!3d-6.369109262305475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed01b68548ad%3A0x89aea3afc2b2e77d!2sUniversitas%20Gunadarma%20Kampus%20D!5e0!3m2!1sen!2sid!4v1723027384895!5m2!1sen!2sid"
                    width="80%" height="450" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    </section><!-- End Contact Section -->

    


    </main>


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