<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return view('Admin.Petugas.index', ['petugas' => $petugas]);
    }

    public function create()
    {
        return view('Admin.Petugas.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:petugas'],
            'password' => ['required', 'string', 'min:6'],
            'telp' => ['required', 'string'],
            'level' => ['required', 'in:admin,petugas'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Petugas::create([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);
        return view('Admin.Petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);

        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:petugas,username,' . $id_petugas],
            'password' => ['nullable', 'string', 'min:6'],
            'telp' => ['required', 'string'],
            'level' => ['required', 'in:admin,petugas'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => $data['password'] ? Hash::make($data['password']) : $petugas->password,
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui');
    }

    public function destroy($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
}
