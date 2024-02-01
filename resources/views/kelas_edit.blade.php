@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Edit Data Kelas
        </h5>
    </div>
    <div class="card-body">
        <form action="/kelas/{{$kelas->id}}" method="post">
            @method('PUT')
            @csrf
            <div class="row">
                <label class="col-2">Kelas</label>
                <input type="text" name="nama" class="col-10 form-control text-capitalize"
                    value="{{$kelas->nama}}">
            </div>
            <div class="row">
                <label class="col-2">Wali Kelas</label>
                <select class="col-10 form-control text-capitalize mt-2" name=" wali_kelas" id="">
                    @foreach ($walik as $wali)
                    <option value="{{$wali->nama}}" @if ($wali->nama == $kelas->wali_kelas) selected @endif>{{$wali->nama}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <label class="col-2">Waka Tahfidz</label>
                <select class="col-10 form-control text-capitalize mt-2" name="pengampu" id="">
                    @foreach ($pengamput as $pengampu)
                    <option value="{{$pengampu->nama}}" @if ($pengampu->nama == $kelas->pengampu_tahfidz) selected
                        @endif>{{$pengampu->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Update</h5></button>
                </div>
                <div class="col-6">
                    <a href="/kelas" type="submit" class="btn btn-sm btn-danger form-control mt-2"><h5>Batal</h5></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection