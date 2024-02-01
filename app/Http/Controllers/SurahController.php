<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surah;
use App\Models\Juz;

class SurahController extends Controller
{
    public function index()
    {
        $surahs = Surah::paginate(25);
        $juzs = Juz::all();

        return view('surah_create', compact('surahs','juzs'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'nama' => 'required',
            'juz' => 'required',
        ],
        [
            'nama.required'  =>  'Nama tidak boleh kosong!',
            'juz.required'  =>  'Juz tidak boleh kosong!'
        ]);

        $data = $request->all();

        Surah::create($data);

        return back()->withSuccess('Data Surah berhasil disimpan');
    }

    public function edit($id)
    {
        $surah = Surah::findOrFail($id);
        // dd($surah);
        $juzs = Juz::all();
        return view('surah_edit', compact('surah','juzs'));
    }

    public function update(Request $request, $id)
    {
        $surah = Surah::findOrFail($id);

        $surah->update([
            'nama' => $request->nama,
            'juz' => $request->juz,
        ]);

        return redirect('surah')->withSuccess('Data berhasi di Update');
    }

    public function destroy($id)
    {
        $surah = Surah::findOrFail($id);
        $surah->delete();
        return back()->withSuccess('Data surah berhasil di Hapus');
    }
}
