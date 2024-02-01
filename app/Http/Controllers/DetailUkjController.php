<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\KenaikanJuz;
use App\Models\DetailKenaikanJuz;
use App\Models\Juz;

class DetailUkjController extends Controller
{
    public function edit($id)
    {
        $ukjdetail = Siswa::select('siswas.nama', 'detail_kenaikan_juzs.*')
            ->leftJoin('kenaikan_juzs', 'siswas.id', '=', 'kenaikan_juzs.siswa_id')
            ->leftJoin('detail_kenaikan_juzs', 'kenaikan_juzs.id', '=', 'detail_kenaikan_juzs.kenaikan_juz_id')
            ->where('detail_kenaikan_juzs.id', $id)
            ->get();


        $detail = DetailKenaikanJuz::findOrFail($id);
        $juzs = Juz::all();
        return view('ukj_edit', compact('detail', 'ukjdetail', 'juzs'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailKenaikanJuz::findOrFail($id);
       
        // Konversi nilai menjadi float sebelum menyimpan
        $rataRataValue = (float) $request->rata_rata;

        $detail->update([
            'juz' => $request->juz,
            'fashohah' => $request->fashohah,
            'tajwid' => $request->tajwid,
            'kelancaran' => $request->kelancaran,
            'rata_rata' => $rataRataValue,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('ukj')->withSuccess('Data nilai berhasil di Update');
    }

    public function destroy($id)
    {
        $detail = DetailKenaikanJuz::findOrFail($id);
        $detail->delete();
        return back()->withSuccess('Data nilai berhasil di Hapus');
    }
}
