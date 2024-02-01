<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Surah;
use App\Models\Tahsin;
use App\Models\DetailTahsin;

class DetailTahsinController extends Controller
{
    public function edit($id)
    {
        $tahsindetail = Siswa::select('siswas.nama', 'detail_tahsins.*')
                ->leftJoin('tahsins', 'siswas.id', '=', 'tahsins.siswa_id')
                ->leftJoin('detail_tahsins', 'tahsins.id', '=', 'detail_tahsins.tahsin_id')
                ->where('detail_tahsins.id', $id)
                ->get();

        $detail = DetailTahsin::findOrFail($id);
        

        return view('tahsin_edit', compact('detail', 'tahsindetail'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailTahsin::findOrFail($id);

        // Konversi nilai menjadi float sebelum menyimpan
        $rataRataValue = (float) $request->rata_rata;

        $detail->update([
            'tingkat' => $request->tingkat,
            'fashohah' => $request->fashohah,
            'tajwid' => $request->tajwid,
            'kelancaran' => $request->kelancaran,
            'rata_rata' => $rataRataValue,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('tahsin')->withSuccess('Data nilai berhasil di Update');
    }

    public function destroy($id)
    {
        $detail = DetailTahsin::findOrFail($id);
        $detail->delete();
        return back()->withSuccess('Data nilai berhasil di Hapus');
    }
}