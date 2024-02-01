@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Edit Data Waka Tahfidz
        </h5>
    </div>
    <div class="card-body">
        <form action="/pengampu/{{$pengampu->first()->id}}" method="post">
            @csrf
            @method('PUT')
            <input type="text" name="nama" value="{{$pengampu->first()->nama}}" class="form-control text-capitalize" placeholder="nama pengampu...">
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Update</h5></button>
                </div>
                <div class="col-6">
                    <a href="/pengampu" type="submit" class="btn btn-sm btn-danger form-control mt-2"><h5>Batal</h5></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection