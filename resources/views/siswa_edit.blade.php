@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Edit Data Siswa
        </h5>
    </div>
    <div class="card-body">
        <form action="/siswa/{{$siswa->id}}" method="post">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-2">
                    <label for="">NISN</label>
                </div>
                <div class="col-10">
                    <input type="text" name="nis" value="{{$siswa->nis}}" class="form-control text-capitalize mb-3">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="">Nama Siswa</label>
                </div>
                <div class="col-10">
                    <input type="text" name="nama" value="{{$siswa->nama}}" class="form-control text-capitalize">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="">Kelas</label>
                </div>
                <div class="col-10">
                    <select class="form-control text-capitalize mt-3" name="kelas_id" id="">
                        @foreach ($kelass as $kelas)
                            <option value="{{$kelas->id}}" @if ($kelas->id == $siswa->kelas_id) selected
                            @endif>{{$kelas->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Update</h5></button>
                </div>
                <div class="col-6">
                    <a href="javascript:history.back()" class="btn btn-sm btn-danger form-control mt-2"><h5>Batal</h5></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection