@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<style>
    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: transparent;
        padding: -20px 0;
    }

    body {
        padding-bottom: 70px;
    }
</style>
@endsection

@section('title', 'FTI LAPOR!')

@section('content')

<body class="index-page">
    <section class="header">
        <nav class="navbar navbar-expand-lg navbar-light shadow">
            <div class="container">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('user.landing') }}">
                        <h4 class="semi-bold mb-0 text-white">LAPOR!</h4>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Kalo udah berhasil login -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        @if(Auth::guard('masyarakat')->check())
                            <ul class="navbar-nav text-center ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link ml-3 text-white" href="{{ route('pekat.logout') }}"
                                        style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                                </li>
                            </ul>
                        @else
                        <!-- menu header -->
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a href="{{ route('pekat.lamanAlurproses') }}" class="btn text-white mx-2" type="button">Alur Proses</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pekat.lamanKontak') }}" class="btn text-white mx-2" type="button">Kontak</a>
                                </li>
                                <li class="nav-item">
                                <a href="{{ route('pekat.lamanFaq') }}" class="btn text-white mx-2" type="button">FAQ</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav text-center ml-auto">
                                <li class="nav-item">
                                    <button class="btn text-white mx-2" type="button" data-toggle="modal"
                                        data-target="#loginModal">Masuk</button>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pekat.formRegister') }}"
                                        class="btn btn-outline-purple mx-2">Daftar</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="container d-flex justify-content-center">
            <img src="{{ asset('images/FTI_Transparan.png') }}" alt="Logo" class="img-fluid w-25">
        </div>

        <div class="text-center mt-1">
            <h2 class="medium text-white mt-1">Layanan Pengaduan Fakultas FTI</h2>
            <p class="italic text-white mb-5">Laporkan segera permasalahan yang anda alami!</p>
        </div>

        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
    </section>

    <div class="footer pengaduan mt-5 ">
        <div class="bg-purple">
            <div class="text-center">
                <h5 class="medium text-white mt-3">JUMLAH LAPORAN SAAT INI</h5>
                <h2 class="medium text-white">{{ $jumlahLaporan }}</h2>
                <h5 class="small text-white mt-1">©2024. All rights reserved.</h5>
            </div>
        </div>
    </div>

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
</body>
@endsection

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