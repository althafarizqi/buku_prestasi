<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 1fr;
            position: relative;
            background: url('{{asset('img/mq_watermark.png')}}') center center no-repeat;
            background-size: 400px; /* Sesuaikan dengan kebutuhan */
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.874); /* Sesuaikan dengan warna dan tingkat transparansi yang diinginkan */
            z-index: -1; /* Meletakkan elemen overlay di belakang konten lainnya */
        }

        table {
            border-collapse: collapse;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 8px;
            border: 1px solid #eee;
            box-shadow: 0 0 0.5px rgba(0, 0, 0, 0.10);
            font-size: 12px;
            line-height: 20px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr>
                <td>
                    <table style="border: 0px solid black; width: 800px;">
                        <tr style="border: 0px solid black;">
                            <td colspan="3" style="border: 0px solid black; width: 100px; text-align: center;">
                                <img src="{{asset('img/logo_mq.jpg')}}" alt="Mastro Logo" style="max-width: 750px;" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table style="border: 0px solid black; width: 750px;">
                        <tr style="border: 0px solid black;">
                            <td colspan="3" style="border: 0px solid black; width: 120px;">
                                <p style="text-align: center; font-weight: bold; font-size: 16px">RAPORT TAHFIDZ AKHIR
                                    SEMESTER
                                    {{$semester}}
                                    <br /> TAHUN PELAJARAN {{$tahun_ajaran}}
                                </p>
                                <span style="margin-left: 50px; text-align: left;">SEKOLAH<span
                                        style="margin-left: 30px;">:</span>&nbsp;{{$nama}}</span><br />
                                <span style="margin-left: 50px; text-align: left;">NAMA<span
                                        style="margin-left: 52px; ">:</span>&nbsp;<span
                                        style="text-transform: uppercase">{{$siswaData->nama}}</span></span><br />
                                <span style="margin-left: 50px; text-align: left;">NISN<span
                                        style="margin-left: 58px;">:</span>&nbsp;{{$siswaData->nis}}</span><br />
                                <span style="margin-left: 50px; text-align: left;">KELAS<span
                                        style="margin-left: 48px; text-transform: uppercase">:</span>&nbsp;<span
                                        style="text-transform: uppercase">{{$siswaData->kelas->nama}}</span></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr style=" align-items: center;">
                <td>
                    <br />
                    <span style="text-align: left; margin-left: 25px; font-weight: bold;">NILAI TES KENAIKAN
                        JUZ DAN
                        UJIAN SEMESTER</span>
                    <div align="center">
                        <table style="border: 1px solid black; width: 750px;">
                            <thead>
                                <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    No</th>
                                <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    UJIAN</th>
                                <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    JUZ</th>
                                <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    FASHOHAH</th>
                                <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    TAJWID</th>
                                <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    KELANCARAN
                                </th>
                                <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    RATA-RATA
                                </th>
                                {{-- <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                    KETERANGAN
                                </th> --}}
                            </thead>
                            <tbody>
                                <tr style="text-align: center;">
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                        1</td>
                                    <td
                                        style="border-right: 1px solid black; border-bottom: 1px solid black; width: 120px;">
                                        PAS</td>
                                    <td
                                        style="border-right: 1px solid black; border-bottom: 1px solid black; width: 80px;">
                                        @foreach($pasdetail as $pasd){{$pasd->juz}}<br />@endforeach</td>
                                    <td
                                        style="border-right: 1px solid black; border-bottom: 1px solid black; width: 100px;">
                                        @foreach($pasdetail as $pasd){{$pasd->fashohah}}<br />@endforeach</td>
                </td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 90px;">
                    @foreach($pasdetail as $pasd){{$pasd->tajwid}}<br />@endforeach</td>
                </td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                    @foreach($pasdetail as $pasd){{$pasd->kelancaran}}<br />@endforeach</td>
                </td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                    @foreach($pasdetail as $pasd){{$pasd->rata_rata}}<br />@endforeach</td>
                </td>
                {{-- <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                    @foreach($pasdetail as $pasd){{$pasd->keterangan}}<br />@endforeach</td>
                </td> --}}
            </tr>
            <tr style="text-align: center;">
                <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                    2</td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 120px;">
                    UKJ</td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 80px;">
                    @foreach($ukjdetail as $ukjd){{$ukjd->juz}}<br />@endforeach</td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 100px;">
                    @foreach($ukjdetail as $ukjd){{$ukjd->fashohah}}<br />@endforeach</td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 90px;">
                    @foreach($ukjdetail as $ukjd){{$ukjd->tajwid}}<br />@endforeach</td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                    @foreach($ukjdetail as $ukjd){{$ukjd->kelancaran}}<br />@endforeach</td>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                    @foreach($ukjdetail as $ukjd){{$ukjd->rata_rata}}<br />@endforeach</td>
                {{-- <td>{{$ukj->first()->keterangan}}</td> --}}
            </tr>
            </tbody>
        </table>
    </div>
    </td>
    </tr>

    <tr style="align-items: center;">
        <td>
            <br />
            <span style="text-align: left; margin-left: 25px; font-weight: bold;">NILAI TAHFIDZ
                (HAFALAN)</span>
            <div align="center">
                <table style="border: 1px solid black; width: 750px;">
                    <thead>
                        <th style="border-right: 1px solid black; border: 1px solid black;">
                            No</th>
                        <th style="border-right: 1px solid black; border: 1px solid black;">
                            SURAH</th>
                        <th style="border-right: 1px solid black; border: 1px solid black;">
                            FASHOHAH</th>
                        <th style="border-right: 1px solid black; border: 1px solid black;">
                            TAJWID</th>
                        <th style="border-right: 1px solid black; border: 1px solid black;">
                            KELANCARAN
                        </th>
                        <th style="border-right: 1px solid black; border: 1px solid black;">
                            RATA-RATA
                        </th>
                        {{-- <th style="border-right: 1px solid black; border: 1px solid black;">
                            KETERANGAN
                        </th> --}}
                    </thead>
                    <tbody>
                        @php
                            $nama_hafalan = [];
                            $nilai_fashohah = [];
                            $nilai_tajwid = [];
                            $nilai_kelancaran = [];
                            $nilai_rata_rata = [];
                        @endphp
                        @foreach ($hafalandetail as $hafalan)
                        @php
                            $nama_hafalan[] = $hafalan->nama;
                            $nilai_tajwid[0] = $hafalan->tajwid;
                            $nilai_fashohah[0] = $hafalan->fashohah;
                            $nilai_kelancaran[0] = $hafalan->kelancaran;
                            $nilai_rata_rata[0] = $hafalan->rata_rata;
                        @endphp
                        {{--
                        <tr style="text-align: center;">
                            <td style="border-right: 1px solid black; border: 1px solid black;">
                                {{$loop->iteration}}</td>
                            <td
                                style="text-align: left; border-right: 1px solid black; border: 1px solid black; width: 200px;">
                                &nbsp;{{ implode(', ', $nama_hafalan) }}</td>
                            <td style="border-right: 1px solid black; border: 1px solid black; width: 100px;">
                                {{$hafalan->fashohah}}</td>
                            <td style="border-right: 1px solid black; border: 1px solid black; width: 90px;">
                                {{$hafalan->tajwid}}</td>
                            <td style="border-right: 1px solid black; border: 1px solid black;">
                                {{$hafalan->kelancaran}}</td>
                            <td style="border-right: 1px solid black; border: 1px solid black;">
                                {{$hafalan->rata_rata}}</td>
                            <td style="border-right: 1px solid black; border: 1px solid black;">
                                {{$hafalan->keterangan}}
                            </td>
                        </tr>
                        --}}
                        @endforeach
                        <tr style="text-align: left;">
                            <td colspan="2"  style="border-right: 1px solid black; border: 1px solid black;">
                                {{ implode(', ', $nama_hafalan) }}
                            </td>
                            <td  style="border-right: 1px solid black; border: 1px solid black;">
                                {{ implode(', ', $nilai_fashohah) }}
                            </td>
                            <td  style="border-right: 1px solid black; border: 1px solid black;">
                                {{ implode(', ', $nilai_tajwid) }}
                            </td>
                            <td  style="border-right: 1px solid black; border: 1px solid black;">
                                {{ implode(', ', $nilai_kelancaran) }}
                            </td>
                            <td  style="border-right: 1px solid black; border: 1px solid black;">
                                {{ implode(', ', $nilai_rata_rata) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>

    <tr style="align-items: center;">
        <td>
            <br />
            <span style="text-align: left; margin-left: 25px; font-weight: bold;">NILAI TAHSIN
                (PERBAIKAN
                BACAAN)</span>
            <div align="center">
                <table style="border: 1px solid black; width: 750px;">
                    <thead>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            No</th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            JILID/TINGKAT
                        </th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            FASHOHAH</th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            TAJWID</th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            KELANCARAN
                        </th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            RATA-RATA
                        </th>
                        {{-- <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            KETERANGAN
                        </th> --}}
                    </thead>
                    <tbody>
                        @foreach ($tahsindetail as $tahsin)
                        <tr style="text-align: center;">
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                1</td>
                            <td
                                style="text-align: left; border-right: 1px solid black; border-bottom: 1px solid black; width: 200px;">
                                &nbsp;{{$tahsin->tingkat}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 100px;">
                                {{$tahsin->fashohah}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 90px;">
                                {{$tahsin->tajwid}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                {{$tahsin->kelancaran}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                {{$tahsin->rata_rata}}</td>
                            {{-- <td>{{$tahsin->keterangan}}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </td>
    </tr>

    <tr style="align-items: center;">
        <td>
            <br />
            <span style="text-align: left; margin-left: 25px; font-weight: bold;">NILAI
                BULANAN</span>
            <div align="center">
                <table style="border: 1px solid black; width: 750px;">
                    <thead>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            No</th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            BULAN</th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            FASHOHAH</th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            TAJWID</th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            KELANCARAN
                        </th>
                        <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            RATA-RATA
                        </th>
                        {{-- <th style="border-right: 1px solid black; border-bottom: 1px solid black;">
                            KETERANGAN
                        </th> --}}
                    </thead>
                    <tbody>
                        @foreach ($bulanandetail as $bulanan)
                        <tr style="text-align: center;">
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                {{$loop->iteration}}</td>
                            <td
                                style="text-align: left; border-right: 1px solid black; border-bottom: 1px solid black; width: 200px;">
                                &nbsp;{{$bulanan->nama}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 100px;">
                                {{$bulanan->murrum}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black; width: 90px;">
                                {{$bulanan->mursek}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                {{$bulanan->ziyadah}}</td>
                            <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                {{$bulanan->rata_rata}}</td>
                            {{-- <td style="border-right: 1px solid black; border-bottom: 1px solid black;">
                                {{$bulanan->keterangan}}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </td>
    </tr>

    <tr style="align-items: center;">
        <td>
            <br />
            <span style="text-align: left; margin-left: 25px; font-weight: bold;">CATATAN
                USTADZ/USTADZAH
                PENDAMPING</span>
            <div align="center">
                <table style="border: 1px solid black; width: 750px;">
                    <tbody>
                        <tr style="text-align: left;">
                            <td colspan="6"
                                style="font-size: 12px; padding-left: 15px;border-right: 1px solid black; border-bottom: 1px solid black;">
                                <p>Alhamdulillah, ananda <span
                                        style="text-transform: uppercase">{{$siswaData->nama}}</span> telah
                                    menyelesaikan
                                    Penilaian Akhir Semester dengan predikat {{$pasdetail->last()->keterangan}}<span
                                        style="font-weight: 700; text-transform: uppercase"></span>,
                                    sampai
                                    akhir semester ini hafalan ananda
                                    <span style="text-transform: uppercase">{{$siswaData->nama}}</span> telah sampai di
                                    surah
                                    @if ($hafalandetail->isNotEmpty())
                                    {{ $hafalandetail->last()->nama }}
                                    @endif
                                    Juz
                                    @if ($hafalandetail->isNotEmpty())
                                    {{ $hafalandetail->last()->juz }}
                                    @endif. Besar
                                    harapan kami
                                    agar
                                    ananda <span style="text-transform: uppercase">{{$siswaData->nama}}</span>
                                    mampu mempertahankan prestasi yang telah dicapai
                                    dan
                                    meningkatkan semangat dalam menghafal Al-Quran dan juga
                                    muroja'ah.
                                <p>Semoga Allah senantiasa memberikan kemudahan bagi ananda <span
                                        style="text-transform: uppercase">{{$siswaData->nama}}</span>.
                                    Baraakallah fiik.</p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <table style="border: 0px solid black; width: 800px;">
                <tr style="border: 0px solid black;">
                    <td colspan="2" style="border: 0px solid black; max-width: 50%; text-align: center; ">
                        Kepala
                        Madrasah<br><br><br>{{$kepsek}}
                    </td>
                    <td colspan="2" style="border: 0px solid black; max-width: 50%; text-align: center; ">
                        Waka tahfidz<br><br><br>{{$siswaData->kelas->pengampu_tahfidz}}
                    </td>
                    <td colspan="2" style="border: 0px solid black; max-width: 50%; text-align: center; ">
                        Wali
                        Kelas<br><br><br>{{$siswaData->kelas->wali_kelas}}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
    </div>
</body>

</html>