@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
<style>
    .container-box {
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
</style>
@endsection

@section('title', 'LAPOR!')

@section('content')
{{-- Section Header --}}
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('user.landing') }}">
                    <h4 class="semi-bold mb-0 text-white">LAPOR!</h4>
                    <p class="italic mt-0 text-white"></p>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
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
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</section>

{{-- Section Body --}}
<div class="container-box">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">
                <div class="content content-top shadow">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    @if (Session::has('pengaduan'))
                        <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
                    @endif

                    <div class="card mb-3">Tulis Laporan Disini</div>

                    <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="return validateForm()">
                        @csrf

                        <div class="card mb-3 d-flex justify-content-between">
                            <label for="kategori_id" class="mr-2">Kategori Laporan:</label>
                            <select name="kategori_id" id="kategori_id">
                                @foreach ($kategori as $kg)
                                    <option value="{{ $kg->id }}">{{ $kg->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                                rows="4">{{ old('isi_laporan') }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="file" name="foto[]" class="form-control" multiple accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-custom mt-2">Kirim</button>
                    </form>
                </div>
            </div>

            <script>
                function validateForm() {
                    const files = document.querySelector('input[type="file"]').files;
                    if (files.length < 2) {
                        alert('Minimal upload 2 foto');
                        return false;
                    }
                    return true;
                }
            </script>

            <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
                <div class="content content-bottom shadow">
                    <div>
                        <div class="self-align">
                            <h5><a style="color: #6a70fc" href="#">{{ Auth::guard('masyarakat')->user()->nama }}</a></h5>
                            <p class="text-dark">{{ Auth::guard('masyarakat')->user()->username }}</p>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <p class="italic mb-0">Terverifikasi</p>
                                <div class="text-center">
                                    {{ $hitung[0] }}
                                </div>
                            </div>
                            <div class="col">
                                <p class="italic mb-0">Proses</p>
                                <div class="text-center">
                                    {{ $hitung[1] }}
                                </div>
                            </div>
                            <div class="col">
                                <p class="italic mb-0">Selesai</p>
                                <div class="text-center">
                                    {{ $hitung[2] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8">
                <a class="d-inline tab {{ $siapa != 'me' ? 'tab-active' : ''}} mr-4" href="{{ route('pekat.laporan') }}">
                    Semua
                </a>
                <a class="d-inline tab {{ $siapa == 'me' ? 'tab-active' : ''}}" href="{{ route('pekat.laporan', 'me') }}">
                    Laporan Saya
                </a>
                <hr>
            </div>
            @foreach ($pengaduan as $k => $v)
            <div class="w3-container-fluid">
                <div class="w3-card-4">
                    <header class="w3-container w3-light-grey">
                        <h3>{{ $siapa == 'me' ? $v->masyarakat->nama : 'Anonymous' }}</h3>
                    </header>
                    <div class="w3-container">
                        <p>@if ($v->status == '0')
                            <p class="text-danger">Pending</p>
                        @elseif($v->status == 'proses')
                            <p class="text-warning">{{ ucwords($v->status) }}</p>
                        @else
                            <p class="text-success">{{ ucwords($v->status) }}</p>
                        @endif
                        <p>Kategori Laporan: {{ $v->kategori->nama_kategori }}</p>
                        </p>
                        <hr>

                        @if ($v->foto)
                            <div class="foto-container">
                                @foreach (json_decode($v->foto) as $foto)
                                    <div class="foto-item">
                                        <img src="{{ Storage::url($foto) }}" alt="Foto Pengaduan">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <p>{{ $v->isi_laporan }}</p>
                        <br>
                    </div>
                </div>
            </div>
            @if ($v->tanggapan)
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Admin Responses: <br> <br></p>
                            <p class="card-text">
                                {{ $v->tanggapan->petugas->nama_petugas }} <br> {{ $v->tanggapan->tanggapan }}
                            </p>
                            <div class="tanggal text-right">
                                <p>{{ date('d M, h:i', strtotime($v->tanggapan->tgl_tanggapan)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
