@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <div class="user-block">
            <h3 class="card-title">Profile Sekolah</h3>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="/profile/{{$profiles->first()->id}}" method="POST">
            @method('PUT')
            @csrf
            <div>
                <label for="">Nama Sekolah</label>
                <input type="text" class="form-control" name="nama" value="{{$profiles->first()->nama}}">
            </div>
            <div>
                <label for="">Alamat Sekolah</label>
                <input type="text" class="form-control" name="alamat" value="{{$profiles->first()->alamat}}">
            </div>
            <div>
                <label for="">Kepala Sekolah</label>
                <input type="text" class="form-control" name="kepala_sekolah"
                    value="{{$profiles->first()->kepala_sekolah}}">
            </div>
            <div>
                <label for="">Semester</label>
                <select class="form-control" name="semester">
                    <option value="GENAP" @if ('GENAP'==$profiles->first()->semester) selected @endif>GENAP</option>
                    <option value="GANJIL" @if ('GANJIL'==$profiles->first()->semester) selected @endif>GANJIL</option>
                </select>
            </div>
            <div>
                <label for="">Tahun Ajaran</label>
                <input type="text" class="form-control" name="tahun_ajaran"
                    value="{{$profiles->first()->tahun_ajaran}}">
            </div>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Update</h5></button>
                </div>
                <div class="col-6">
                    <a href="/profile" type="submit" class="btn btn-sm btn-danger form-control mt-2"><h5>Batal</h5></a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection