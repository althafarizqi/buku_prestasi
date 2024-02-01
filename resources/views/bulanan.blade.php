@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <div class="user-block">
            <h3 class="card-title">Input Nilai Bulanan</h3>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('bulanan.index') }}" method="get">
            <div class="input-group">
                <select name="kelasId" class="custom-select" id="inputGroupSelect04"
                    aria-label="Example select with button addon" onchange="this.form.submit()">
                    <option value="">----Pilih Kelas----</option>
                    @foreach($kelass as $kelas)
                    <option value="{{ $kelas->id }}" @if($kelas->id == $kelas_id) selected @endif>{{
                        $kelas->nama }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <form action="{{ route('bulanan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kelas_id" value="{{$kelas_id}}">
            <div>
                <div>
                    <div class="input-group mt-2">
                        <select name="siswaId" class="custom-select" id="inputGroupSelect04"
                            aria-label="Example select with button addon">
                            <option value="">----Pilih Siswa----</option>
                            @foreach($results as $siswa)
                            <option value="{{ $siswa->id }}" @if($siswa->id == $siswa_id) selected @endif>{{
                                $siswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="table-responsive-sm mt-4">
                        <a class="btn btn-sm btn-success form-control" id="add-input"><h5>Tambah Nilai</h5></a>
                        <table class="table table-sm table-borderless">
                            <tbody id="data">
                            </tbody>
                        </table>
                        <button class="btn btn-primary form-control"><h5>Simpan Nilai</h5></button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>


<div class="card card-success">
    <div class="card-header">
        <div class="user-block">
            <h3 class="card-title">Daftar Nilai Bulanan</h3>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Bulan</th>
                        <th>Murojaah Rumah</th>
                        <th>Murojaah Sekolah</th>
                        <th>Ziyadah</th>
                        <th>Rata-rata</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                    $groupedBulananDetail = $bulanandetail->groupBy('nama');
                    @endphp

                    @foreach ($groupedBulananDetail as $nama => $group)
                    @foreach ($group as $key => $bulanan)
                    <tr>
                        <td>
                            @if ($key === 0)
                            {{$loop->parent->iteration}}
                            @endif
                        </td>
                        <td class="text-left">
                            @if ($key === 0)
                            {{$nama}}
                            @endif
                        </td>
                        <td>{{$bulanan->nama_bulan}}</td>
                        <td class="text-center">{{$bulanan->murrum}}</td>
                        <td class="text-center">{{$bulanan->mursek}}</td>
                        <td class="text-center">{{$bulanan->ziyadah}}</td>
                        <td class="text-center">{{$bulanan->rata_rata}}</td>
                        <td>
                            <a href="bulanandetail/{{$bulanan->id}}/edit"
                                class="badge badge-pill badge-warning">Edit</a>
                            <form class="d-inline" action="bulanandetail/{{$bulanan->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="d-inline btn btn-sm badge badge-pill badge-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('darmawan')
<script>
    let dataRow = 0;
    $("#add-input").click(() => {
    dataRow++;
    inputRow(dataRow);
    });
    
    function inputRow(i) {
    let tr = `<tr id="input-tr-${i}">
        <td class="pb-0">
            <div class="form-row">
                <div class="col">
                    <select class="form-control select2" name="bulan_id[]" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                        <option value="">Pilih Bulan</option>
                        @foreach($bulans as $bulan)
                        <option value="{{$bulan->id}}">{{ $bulan-> nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="murrum[]" placeholder="Murojaah Rumah" required oninvalid="this.setCustomValidity('Nilai tidak boleh kosong')" oninput="setCustomValidity('')"><br/>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="mursek[]" value="" placeholder="Murojaah Sekolah" required oninvalid="this.setCustomValidity('Nilai tidak boleh kosong')" oninput="setCustomValidity('')">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="ziyadah[]" placeholder="Ziyadah">
                    <input type="hidden" class="form-control" name="rata_rata[]" readonly placeholder="Rata-Rata">
                    <input type="hidden" class="form-control" name="keterangan[]" readonly placeholder="Keterangan">
                </div>
                <div class="col">
                   <button class="btn form-control btn-sm btn-danger delete-record float-right" data-id="${i}">Hapus</button>
                </div>
            </div>
        </td>
    </tr>`;
    $("#data").append(tr);

    // Inisialisasi Select2 untuk elemen <select> yang baru ditambahkan
        $(`#input-tr-${i} select`).select2();
    }
    
    $("#data").on("click", ".delete-record", function () {
    let id = $(this).attr("data-id");
    $("#input-tr-" + id).remove();
    });
    
    function updateRataRataAndKeterangan(row) {
    let murrumValue = parseFloat(row.find('input[name="murrum[]"]').val()) || 0;
    let mursekValue = parseFloat(row.find('input[name="mursek[]"]').val()) || 0;
    let ziyadahValue = parseFloat(row.find('input[name="ziyadah[]"]').val()) || 0;
    
    if (!isNaN(murrumValue) && !isNaN(mursekValue) && !isNaN(ziyadahValue)) {
    if (murrumValue > 100 || mursekValue > 100 || ziyadahValue > 100) {
    alert("Nilai tidak boleh melebihi 100.");
    return;
    }
    
    var rataRataValue = (murrumValue + mursekValue + ziyadahValue) / 3;
    row.find('input[name="rata_rata[]"]').val(rataRataValue.toFixed(2));
    
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
    
    row.find('input[name="keterangan[]"]').val(keteranganValue);
    }
    }

    // Memanggil fungsi updateRataRataAndKeterangan saat input berubah
    $("#data").on("input", "input[name='murrum[]'], input[name='mursek[]'], input[name='ziyadah[]']", function() {
    updateRataRataAndKeterangan($(this).closest("tr"));
    });
</script>
@endsection