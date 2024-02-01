<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();

        return view('guru_create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'nama' => 'required'
        ],
        [
            'nama.required'  =>  'Nama tidak boleh kosong!'
        ]);

        $data = $request->all();

        Guru::create($data);

        return redirect()->route('guru.index')->withSuccess('Data Guru berhasil disimpan');
    }

    public function edit($id)
    {
        $guru = Guru::all()->where('id', $id);
        return view('guru_edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $guru->update([
            'nama' => $request->nama,
        ]);

        return redirect('guru')->withSuccess('Data berhasi di Update');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return back()->withSuccess('Data guru berhasil di Hapus');
    }
}