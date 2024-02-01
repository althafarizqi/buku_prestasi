<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Surah;
use App\Models\DetailHafalan;

class DetailHafalanController extends Controller
{
    public function edit($id)
    {
        $hafalandetail = Siswa::select('siswas.nama', 'detail_hafalans.*', 'surahs.nama as nama_surah')
                ->leftJoin('hafalans', 'siswas.id', '=', 'hafalans.siswa_id')
                ->leftJoin('detail_hafalans', 'hafalans.id', '=', 'detail_hafalans.hafalan_id')
                ->leftJoin('surahs', 'detail_hafalans.surah_id', '=', 'surahs.id')
                ->where('detail_hafalans.id', $id)
                ->get();
        // dd($hafalandetail);

        $detail = DetailHafalan::findOrFail($id);
        $surahs = Surah::all();

        return view('hafalan_edit', compact('detail', 'hafalandetail', 'surahs'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailHafalan::findOrFail($id);
        // dd($request->surah_id);
        // Konversi nilai menjadi float sebelum menyimpan
        $rataRataValue = (float) $request->rata_rata;

        $detail->update([
            'surah_id' => $request->surah_id,
            'fashohah' => $request->fashohah,
            'tajwid' => $request->tajwid,
            'kelancaran' => $request->kelancaran,
            'rata_rata' => $rataRataValue,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/hafalan')->withSuccess('Data nilai berhasil di Update');
    }

    public function destroy($id)
    {
        $detail = DetailHafalan::findOrFail($id);
        $detail->delete();
        return back()->withSuccess('Data nilai berhasil di Hapus');
    }
}