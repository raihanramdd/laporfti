<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        $tanggapan = Tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();

        if ($tanggapan) {
            $pengaduan->update(['status' => $request->status]);

            date_default_timezone_set('Asia/Bangkok');

            $tanggapan->update([
                'tgl_tanggapan' => date('Y-m-d H:i:s'),
                'tanggapan'=> $request->tanggapan,
                'id_petugas'=> Auth::guard('admin')->user()->id_petugas,
            ]);

            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);

        } else {
            $pengaduan->update(['status' => $request->status]);

            date_default_timezone_set('Asia/Bangkok');

            $tanggapan = Tanggapan::create ([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d H:i:s'),
                'tanggapan'=> $request->tanggapan,
                'id_petugas'=> Auth::guard('admin')->user()->id_petugas,
            ]);

            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' =>'Berhasil Dikirim']);
        }
    }
}
