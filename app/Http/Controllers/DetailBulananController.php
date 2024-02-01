<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\DetailBulanan;
use App\Models\Bulan;

class DetailBulananController extends Controller
{
    public function edit($id)
    {
        $bulanandetail = Siswa::select('siswas.nama', 'detail_bulanans.*', 'bulans.nama as nama_bulan')
            ->leftJoin('bulanans', 'siswas.id', '=', 'bulanans.siswa_id')
            ->leftJoin('detail_bulanans', 'bulanans.id', '=', 'detail_bulanans.bulanan_id')
            ->leftJoin('bulans', 'detail_bulanans.bulan_id', '=', 'bulans.id')
            ->where('detail_bulanans.id', $id)
            ->get();
        // dd($hafalandetail);

        $detail = DetailBulanan::findOrFail($id);
        $bulans = Bulan::all();

        return view('bulanan_edit', compact('detail', 'bulanandetail', 'bulans'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailBulanan::findOrFail($id);

        // Konversi nilai menjadi float sebelum menyimpan
        $rataRataValue = (float) $request->rata_rata;

        $detail->update([
            'bulan_id' => $request->bulan_id,
            'murrum' => $request->murrum,
            'mursek' => $request->mursek,
            'ziyadah' => $request->ziyadah,
            'rata_rata' => $rataRataValue,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/bulanan')->withSuccess('Data nilai berhasil di Update');
    }

    public function destroy($id)
    {
        $detail = DetailBulanan::findOrFail($id);
        $detail->delete();
        return back()->withSuccess('Data nilai berhasil di Hapus');
    }
}