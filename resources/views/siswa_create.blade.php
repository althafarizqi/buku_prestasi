@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Input Data Siswa
        </h5>
    </div>
    <div class="card-body">
        <form action="/siswa" method="post">
            @csrf
            <input type="number" name="nis" class="form-control text-capitalize" placeholder="NISN">
            <input type="text" name="nama" class="form-control text-capitalize mt-2" placeholder="Nama Siswa">
            <select class="form-control text-capitalize mt-2" name="kelas_id" id="">
                <option value="">--Pilih Kelas--</option>
                @foreach ($kelass as $kelas)
                <option value="{{$kelas->id}}">{{$kelas->nama}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Simpan</h5></button>
        </form>
    </div>
</div>

<div class="card card-success">
    <div class="card-header">
        <h5>
            Daftar Siswa By Kelas
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('siswa.index') }}" method="get">
            <select class="form-control text-capitalize mt-2" name="ByKelas"
                onchange="this.form.submit()">
                <option value="">--Pilih Kelas--</option>
                @foreach ($kelass as $kelas)
                <option value="{{$kelas->id}}">{{$kelas->nama}}</option>
                @endforeach
            </select>
        </form>
        <div class="table-responsive">
            <table class="table text-capitalize table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$siswa->nis}}</td>
                        <td>{{$siswa->nama}}</td>
                        <td>{{$siswa->kelas->nama}}</td>
                        <td>
                            <a href="siswa/{{$siswa->id}}/edit"
                                class="d-inline badge badge-pill badge-warning">Edit</a>
                            <form class="d-inline" action="siswa/{{$siswa->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="d-inline btn btn-sm badge badge-pill badge-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
