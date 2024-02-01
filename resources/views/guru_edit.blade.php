@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Input Data Guru/Wali Kelas
        </h5>
    </div>
    <div class="card-body">
        <form action="/guru/{{$guru->first()->id}}" method="post">
            @method('PUT')
            @csrf
            <input type="text" name="nama" value="{{$guru->first()->nama}}" class="form-control text-capitalize" placeholder="nama guru...">
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Update</h5></button>
                </div>
                <div class="col-6">
                    <a href="/guru" type="submit" class="btn btn-sm btn-danger form-control mt-2"><h5>Batal</h5></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection