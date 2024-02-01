@extends('layouts.main')
@section('content')
<form action="/hafalandetail/{{$detail->id}}" method="post">
    @method('PUT')
    @csrf
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>Nama</th>
                <th>Surah</th>
                <th>Fashohah</th>
                <th>Tajwid</th>
                <th>Kelancaran</th>
                <th>Rata-rata</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <td><span class="text-left text-bold">{{$hafalandetail->first()->nama}}</span></td>
                <td>
                    <select style="width: 180px" class="form-control select2" name="surah_id">
                        <option value="{{$detail->surah_id}}">{{$detail->surah->nama}}</option>
                        @foreach($surahs as $surah)
                        <option value="{{$surah->id}}">{{ $surah->nama}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input style="width: 100px" class="form-control text-center" type="text" name="fashohah"
                        value="{{$detail->fashohah}}"></td>
                <td><input style="width: 100px" class="form-control text-center" type="text" name="tajwid"
                        value="{{$detail->tajwid}}"></td>
                <td><input style="width: 100px" class="form-control text-center" type="text" name="kelancaran"
                        value="{{$detail->kelancaran}}"></td>
                <td><input style="width: 100px" class="form-control text-center" type="text" name="rata_rata"
                        value="{{$detail->rata_rata}}"></td>
                <td><input style="width: 120px" class="form-control text-center" type="text" name="keterangan"
                        value="{{$detail->keterangan}}"></td>
                <td class="row">
                    <div><button class="btn btn-primary form-control" type="submit">Update</button></div>
                    <div class="ml-1"><a href="/hafalan" class="btn btn-warning">Batal</a></div>
                </td>
            </tr>
        </tbody>

    </table>
</form>
@endsection

@section('darmawan')
<script>
    $(document).ready(function () {
        function updateRataRataAndKeterangan(row) {
            let fashohahValue = parseFloat(row.find('input[name="fashohah"]').val()) || 0;
            let tajwidValue = parseFloat(row.find('input[name="tajwid"]').val()) || 0;
            let kelancaranValue = parseFloat(row.find('input[name="kelancaran"]').val()) || 0;

            if (fashohahValue > 100 || tajwidValue > 100 || kelancaranValue > 100) {
                alert("Nilai tidak boleh melebihi 100.");
                return;
            }

            var rataRataValue = (fashohahValue + tajwidValue + kelancaranValue) / 3;
            row.find('input[name="rata_rata"]').val(rataRataValue.toFixed(2));

            var keteranganValue = "";
            if (rataRataValue >= 90) {
                keteranganValue = "Jayyid jiddan";
            } else if (rataRataValue >= 80) {
                keteranganValue = "Jayyid";
            } else if (rataRataValue >= 70) {
                keteranganValue = "Maqbul";
            } else if (rataRataValue >= 60) {
                keteranganValue = "Naqis";
            } else {
                keteranganValue = "Dhoif";
            }

            row.find('input[name="keterangan"]').val(keteranganValue);
        }

        // Memanggil fungsi updateRataRataAndKeterangan saat input berubah
        $("input[name='fashohah'], input[name='tajwid'], input[name='kelancaran']").on("input", function () {
            updateRataRataAndKeterangan($(this).closest("form"));
        });
    });
</script>
@endsection