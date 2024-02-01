<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Console\Commands\MoveDataPenilaian;
use Illuminate\Support\Facades\Artisan;
use App\Models\Profile;
use App\Models\KenaikanJuz;
use App\Models\DetailKenaikanJuz;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::where('id',1)->get();
        return view('profile', compact('profiles'));
    }

    public function edit($id)
    {
        $profiles = Profile::where('id',1)->get();
        return view('profile_edit', compact('profiles'));
    }

    public function update(Request $request, $id)
    {
        $profiles = Profile::findOrFail($id);

        $profiles->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kepala_sekolah' => $request->kepala_sekolah,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect('/profile')->withSuccess('Profile Sekolah berhasil di Update');
    }

    public function deleteAllDataWithSoftDeletes()
    {
        KenaikanJuz::query()->delete();
        DetailKenaikanJuz::query()->delete();

        return redirect('/profile')->with('success', 'Semua data berhasil dihapus');
    }

    public function moveDataPenilaian()
    {
        Artisan::call('move:move-data-penilaian');

        return redirect()->back()->with('success', 'Data has been moved successfully.');
    }
}