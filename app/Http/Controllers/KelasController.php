<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Pengampu;



class KelasController extends Controller
{
     public function index()
    {
        $kelass = Kelas::all();
        $walik = Guru::all();
        $pengamput = Pengampu::all();

        return view('kelas_create', compact('kelass', 'walik', 'pengamput'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'nama' => 'required',
            'wali_kelas' => 'required',
            'pengampu_tahfidz' => 'required'
        ],
        [
            'nama.required'  =>  'Nama tidak boleh kosong!',
            'wali_kelas.required'  =>  'Wali Kelas tidak boleh kosong!',
            'pengampu_tahfidz.required'  =>  'Pengampu Tahfidz tidak boleh kosong!'
        ]);

        $data = $request->all();

        Kelas::create($data);

        return redirect()->route('kelas.index')->withSuccess('Data Kelas berhasil disimpan');
    }

    public function edit($id)
    {
        $walik = Guru::all();
        $pengamput = Pengampu::all();
        $kelas = Kelas::findOrFail($id);
        return view('kelas_edit', compact('kelas', 'walik', 'pengamput'));
    }

    public function update(Request $request, $id)
    {
       $kelas = Kelas::findOrFail($id);

       $kelas->update([
            'nama' => $request->nama,
            'wali_kelas' => $request->wali_kelas,
            'pengampu_tahfidz' => $request->pengampu
        ]);

        return redirect('/kelas')->withSuccess('Data kelas berhasil di Update');
    }
}