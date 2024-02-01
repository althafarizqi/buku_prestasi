@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <div class="user-block">
            <h3 class="card-title">Input Nilai Tahfidz</h3>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('hafalan.index') }}" method="get">
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
        <form action="{{ route('hafalan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="siswa_id" value="{{$siswa_id}}">
            <input type="hidden" name="kelas_id" value="{{$kelas_id}}">
            <div>
                <div>
                    <div class="input-group mt-2">
                        <select name="siswaId" class="custom-select" id="inputGroupSelect04"
                            aria-label="Example select with button addon">
                            <option value="">----Pilih Siswa----</option>
                            @foreach($siswaByKelas as $siswa)
                            <option value="{{ $siswa->id }}" @if($siswa->id == $siswa_id) selected @endif>{{
                                $siswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="table-responsive-sm mt-4">
                        <a class="btn btn-success form-control" id="add-input"><h5>Tambah Nilai</h5></a>
                        <table class="table table-sm table-borderless">
                            <thead class="table-light">

                            </thead>
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
            <h3 class="card-title">Daftar Nilai Tahfidz</h3>
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
                        <th>Surah</th>
                        <th>Fashohah</th>
                        <th>Tajwid</th>
                        <th>Kelancaran</th>
                        <th>Rata-rata</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                    $groupedHafalanDetail = $hafalandetail->groupBy('nama');
                    @endphp

                    @foreach ($groupedHafalanDetail as $nama => $group)
                    @foreach ($group as $key => $hafalan)
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
                        <td>{{$hafalan->nama_surah}}</td>
                        <td>{{$hafalan->fashohah}}</td>
                        <td>{{$hafalan->tajwid}}</td>
                        <td>{{$hafalan->kelancaran}}</td>
                        <td>{{$hafalan->rata_rata}}</td>
                        <td>
                            <a href="/hafalandetail/{{$hafalan->id}}/edit"
                                class="badge badge-pill badge-warning">Edit</a>
                                <form class="d-inline" action="hafalandetail/{{$hafalan->id}}" method="post">
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
        <td>
            <div class="row">
                <div class="col">
                    <select class="form-control select2" name="surah_id[]" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                        <option value="">Pilih Surah</option>
                        @foreach($surahs as $surah)
                        <option value="{{$surah->id}}">{{ $surah-> nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="fashohah[]" placeholder="Fashohah" required oninvalid="this.setCustomValidity('Nilai tidak boleh kosong')" oninput="setCustomValidity('')"><br/>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="tajwid[]" value="" placeholder="Tajwid" required oninvalid="this.setCustomValidity('Nilai tidak boleh kosong')" oninput="setCustomValidity('')">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="kelancaran[]" placeholder="Kelancaran" required oninvalid="this.setCustomValidity('Nilai tidak boleh kosong')" oninput="setCustomValidity('')">
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
    let fashohahValue = parseFloat(row.find('input[name="fashohah[]"]').val());
    let tajwidValue = parseFloat(row.find('input[name="tajwid[]"]').val());
    let kelancaranValue = parseFloat(row.find('input[name="kelancaran[]"]').val());
    
    if (!isNaN(fashohahValue) && !isNaN(tajwidValue) && !isNaN(kelancaranValue)) {
    if (fashohahValue > 100 || tajwidValue > 100 || kelancaranValue > 100) {
    alert("Nilai tidak boleh melebihi 100.");
    return;
    }
    
    var rataRataValue = (fashohahValue + tajwidValue + kelancaranValue) / 3;
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
    $("#data").on("input", "input[name='fashohah[]'], input[name='tajwid[]'], input[name='kelancaran[]']", function() {
    updateRataRataAndKeterangan($(this).closest("tr"));
    });
</script>
@endsection