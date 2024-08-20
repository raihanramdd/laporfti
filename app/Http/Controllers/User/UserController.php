<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class UserController extends Controller
{
    public function index()
    {
        return view('user.landing');
    }

    public function jumlahLaporan()
    {
        $jumlahLaporan = Pengaduan::count(); // Mendapatkan jumlah laporan dari database
        return view('user.landing', ["jumlahLaporan" => $jumlahLaporan]);
    }


    public function login(Request $request)
    {
        $username = Masyarakat::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // $request->session()->regenerate();
            if ($request->route()->named('user.landing')) {
                return redirect()->back();
            }
            return redirect()->action([$this::class, 'laporan']);
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function formRegister()
    {
        return view('user.register');
    }

    public function lamanAlurproses()
    {
        $jumlahLaporan = Pengaduan::count();
        return view('user.alur', ["jumlahLaporan" => $jumlahLaporan]);
    }

    public function lamanKontak()
    {
        $jumlahLaporan = Pengaduan::count();
        return view('user.kontak', ["jumlahLaporan" => $jumlahLaporan]);
    }

    public function lamanFAQ()
    {
        $jumlahLaporan = Pengaduan::count();
        return view('user.faq', ["jumlahLaporan" => $jumlahLaporan]);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'npm' => ['required'],
            'nama' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'telp' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $username = Masyarakat::where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        $masyarakat = Masyarakat::create([
            'npm' => $data['npm'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
        ]);


        return redirect()->route('user.landing');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect()->route('user.landing');
    }

    public function storePengaduan(Request $request)
{
    if (! Auth::guard('masyarakat')->check()) {
        return redirect()->back()->with(['pesan' => 'Login dibutuhkan!'])->withInput();
    }

    $data = $request->all();

    $validate = Validator::make($data, [
        'isi_laporan' => ['required'],
        'kategori_id' => ['required'],
        'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi foto
    ]);

    if ($validate->fails()) {
        return redirect()->back()->withInput()->withErrors($validate);
    }

    $fotoPaths = [];
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            $fotoPaths[] = $file->store('assets/pengaduan', 'public');
        }
    }

    date_default_timezone_set('Asia/Bangkok');

    $kategori = Kategori::find($data['kategori_id']);

    $kategori->pengaduan()->create([
        'tgl_pengaduan' => date('Y-m-d H:i:s'),
        'npm' => Auth::guard('masyarakat')->user()->npm,
        'isi_laporan' => $data['isi_laporan'],
        'foto' => json_encode($fotoPaths), // Menyimpan foto dalam bentuk JSON
        'status' => '0',
    ]);

    return redirect()->route('pekat.laporan', 'me')->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
}


    public function laporan($siapa = '')
    {
        $terverifikasi = Pengaduan::where([['npm', Auth::guard('masyarakat')->user()->npm], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['npm', Auth::guard('masyarakat')->user()->npm], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['npm', Auth::guard('masyarakat')->user()->npm], ['status', 'selesai']])->get()->count();
        $kategori = Kategori::all();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($siapa == 'me') {
            $pengaduan = Pengaduan::where('npm', Auth::guard('masyarakat')->user()->npm)->orderBy('tgl_pengaduan', 'desc')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa, 'kategori' => $kategori]);

        } else {
            $pengaduan = Pengaduan::where([['npm', '!=', Auth::guard('masyarakat')->user()->npm], ['status', '!=', '0']])->orderBy('tgl_pengaduan', 'desc')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa, 'kategori' => $kategori]);
        }
    }
}
