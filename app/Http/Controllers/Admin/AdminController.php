<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function formLogin()
    {
        return view('admin.login');
    }


    public function deletePengaduan($id)
    {
        $data = Pengaduan::find($id);
        $data->delete();
        return redirect()->action([PengaduanController::class, 'index']);
    }

    public function deleteMasyarakat($id)
    {
        $data = Masyarakat::find($id);
        $data->delete();
        return redirect()->action([MasyarakatController::class, 'index']);
    }

    public function login(Request $request)
    {
        $username = Petugas::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar!']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak terdaftar!']);
        }

        $auth = Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]);
        

        if ($auth) {
            return redirect()->route('dashboard.index');
        }else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.formLogin');
    }
}