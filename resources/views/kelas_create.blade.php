@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Input Data Kelas
        </h5>
    </div>
    <div class="card-body">
        <form action="/kelas" method="post">
            @csrf
            <input type="text" name="nama" class="form-control text-capitalize" placeholder="nama kelas...">
            <select class="form-control text-capitalize mt-2" name=" wali_kelas" id="">
                <option value="">--Pilih Wali Kelas--</option>
                @foreach ($walik as $wali)
                <option value="{{$wali->nama}}">{{$wali->nama}}</option>
                @endforeach
            </select>
            <select class="form-control text-capitalize mt-2" name=" pengampu" id="">
                <option value="">--Pilih Waka Tahfidz--</option>
                @foreach ($pengamput as $pengampu)
                <option value="{{$pengampu->nama}}">{{$pengampu->nama}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Simpan</h5></button>
        </form>
    </div>
</div>

<div class="card card-success">
    <div class="card-header">
        <h5>
            Daftar Kelas
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-capitalize table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Waka Tahfidz</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelass as $kelas)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$kelas->nama}}</td>
                        <td>{{$kelas->wali_kelas}}</td>
                        <td>{{$kelas->pengampu_tahfidz}}</td>
                        <td>
                            <a href="/kelas/{{$kelas->id}}/edit" class="badge badge-pill badge-warning">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
