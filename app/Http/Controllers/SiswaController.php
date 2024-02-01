<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $kelas = $request->input('ByKelas');
        $kelass = Kelas::all();
        $siswas = Siswa::where('kelas_id', $kelas)->get();

        return view('siswa_create', compact('kelass', 'siswas'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required'
        ],
        [
            'nis.required'  =>  'NIS tidak boleh kosong!',
            'nama.required'  =>  'Nama tidak boleh kosong!',
            'kelas_id.required'  =>  'Kelas tidak boleh kosong!'
        ]);
        
        try {
            $byNis = $request->input('nis');
            $siswaByNis = Siswa::where('nis', $byNis)->get();
            $data = $request->all();

        Siswa::create($data);

        return redirect()->route('siswa.index', ['ByKelas' => $request->input('kelas_id')])
            ->withSuccess('Data Siswa <br/>' . $request->input('nama') . '<br/> berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('siswa.index')
                ->with('error', 'Maaf, NIS '. $request->input('nis') . '<br/>sudah terdaftar <br/>a/n ' . $siswaByNis->first()->nama . '<br/> kelas ' . $siswaByNis->first()->kelas->nama . '<br/> periksa kembali data anda sebelum disimpan!')
                ->withInput();
        }
        
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelass = Kelas::all();
        return view('siswa_edit', compact('siswa','kelass'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect('siswa')->withSuccess('Data berhasi di Update');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return back()->withSuccess('Data siswa berhasil di Hapus');
    }
}