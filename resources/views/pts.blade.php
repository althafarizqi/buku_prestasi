@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="d-none d-sm-block">Penilaian Tengah Semester</h2>
        <h4 class="d-block d-sm-none text-center">Penilaian Tengah Semester</h4>
    </div>
    <div class="card-body">
        <div>
            <form action="{{ route('pts.index') }}" method="get">
                <div class="input-group">
                    <select name="kelasId" class="custom-select" id="inputGroupSelect04"
                        aria-label="Example select with button addon" onchange="this.form.submit()">
                        <option value="">----Pilih Kelas----</option>
                        @foreach($kelass as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                    {{-- <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Tampilkan</button>
                    </div> --}}
                </div>
            </form>
        </div>
        <form action="{{ route('pts.index') }}" method="post">
            @csrf
            <div class="table-responsive-sm" id="data-siswa">
                <table id="example1" class="table table-striped dataTable dtr-inline">
                    <thead class="text-center">
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Juz</th>
                        <th>Fashoh</th>
                        <th>Tajwid</th>
                        <th>Lancar</th>
                        <th>Rata-rata</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        @foreach ($results as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nama }}<input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}"></td>
                            <td>{{ $siswa->kelas->nama }}<input type="hidden" name="kelas_id[]"
                                    value="{{ $siswa->kelas->id }}">
                            </td>
                            <td class="text-center">
                                <input style="max-width: 40px;" class="juz-input text-center form-control-sm"
                                    type="text" name="juz[]" id="juz-{{ $siswa->id }}">
                                <span id="errorMsg" style="display:none;">you can give score -10 to +10 only</span>

                            </td>
                            <td class="text-center">
                                <input style="max-width: 40px;" class="text-center form-control-sm" type="text"
                                    name="fashohah[]" id="fashohah_{{ $siswa->id }}">
                            </td>
                            <td class="text-center">
                                <input style="max-width: 40px;" class="text-center form-control-sm" type="text"
                                    name="tajwid[]" id="tajwid_{{ $siswa->id }}">
                            </td>
                            <td class="text-center">
                                <input style="max-width: 40px;" class="text-center form-control-sm" type="text"
                                    name="kelancaran[]" id="kelancaran_{{ $siswa->id }}">
                            </td>
                            <td class="text-center">
                                {{-- <input style="max-width: 40px;" class="text-center form-control-sm" type="text"
                                    name="rata_rata[]" id="rata-rata"> --}}
                                <input style="max-width: 60px;" class="text-center form-control-sm" type="text" readonly
                                    name="rata_rata[]" id="rata-rata_{{ $siswa->id }}">
                            </td>
                            <td>
                                <input style="max-width: 100px;" class="text-center form-control-sm" type="text"
                                    readonly name="keterangan[]" id="keterangan_{{ $siswa->id }}">
                            </td>
                        </tr>
                        <script>
                            var fashohah_{{ $siswa->id }} = document.getElementById("fashohah_{{ $siswa->id }}");
                            var tajwid_{{ $siswa->id }} = document.getElementById("tajwid_{{ $siswa->id }}");
                            var kelancaran_{{ $siswa->id }} = document.getElementById("kelancaran_{{ $siswa->id }}");
                            var rataRata_{{ $siswa->id }} = document.getElementById("rata-rata_{{ $siswa->id }}");
                            var keterangan_{{ $siswa->id }} = document.getElementById("keterangan_{{ $siswa->id }}");
                        
                                fashohah_{{ $siswa->id }}.addEventListener("input", function() {
                                    updateRataRataAndKeterangan(
                                        fashohah_{{ $siswa->id }},
                                        tajwid_{{ $siswa->id }},
                                        kelancaran_{{ $siswa->id }},
                                        rataRata_{{ $siswa->id }},
                                        keterangan_{{ $siswa->id }}
                                    );
                                });
                        
                                tajwid_{{ $siswa->id }}.addEventListener("input", function() {
                                    updateRataRataAndKeterangan(
                                        fashohah_{{ $siswa->id }},
                                        tajwid_{{ $siswa->id }},
                                        kelancaran_{{ $siswa->id }},
                                        rataRata_{{ $siswa->id }},
                                        keterangan_{{ $siswa->id }}
                                    );
                                });
                        
                                kelancaran_{{ $siswa->id }}.addEventListener("input", function() {
                                    updateRataRataAndKeterangan(
                                        fashohah_{{ $siswa->id }},
                                        tajwid_{{ $siswa->id }},
                                        kelancaran_{{ $siswa->id }},
                                        rataRata_{{ $siswa->id }},
                                        keterangan_{{ $siswa->id }}
                                    );
                                });
                        
                                // Function to update rata-rata and keterangan
                                function updateRataRataAndKeterangan(fashohah, tajwid, kelancaran, rataRata, keterangan) {
                                    var fashohahValue = parseFloat(fashohah.value);
                                    var tajwidValue = parseFloat(tajwid.value);
                                    var kelancaranValue = parseFloat(kelancaran.value);
                        
                                    if (!isNaN(fashohahValue) && !isNaN(tajwidValue) && !isNaN(kelancaranValue)) {
                                        if (fashohahValue > 100 || tajwidValue > 100 || kelancaranValue > 100) {
                                            alert("Nilai tidak boleh melebihi 100.");
                                            return;
                                        }
                        
                                        var rataRataValue = (fashohahValue + tajwidValue + kelancaranValue) / 3;
                                        rataRata.value = rataRataValue.toFixed(2);
                                        
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
                        
                                        keterangan.value = keteranganValue;
                                    }
                                }
                        </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary form-control">Simpan</button>
    </div>
    </form>
</div>
@endsection