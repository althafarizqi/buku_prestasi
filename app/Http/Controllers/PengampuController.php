<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengampu;

class PengampuController extends Controller
{
     public function index()
    {
        $pengampus = Pengampu::all();

        return view('pengampu_create', compact('pengampus'));
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

        Pengampu::create($data);

        return redirect()->route('pengampu.index')->withSuccess('Data Pengampu Tahfidz berhasil disimpan');
    }

    public function edit($id)
    {
        $pengampu = Pengampu::all()->where('id', $id);
        return view('pengampu_edit', compact('pengampu'));
    }

    public function update(Request $request, $id)
    {
        $pengampu = Pengampu::findOrFail($id);

        $pengampu->update([
            'nama' => $request->nama,
        ]);

        return redirect('pengampu')->withSuccess('Data berhasi di Update');
    }

    public function destroy($id)
    {
        $pengampu = Pengampu::findOrFail($id);
        $pengampu->delete();
        return back()->withSuccess('Data pengampu berhasil di Hapus');
    }
}