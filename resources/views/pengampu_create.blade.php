@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Input Data Waka Tahfidz
        </h5>
    </div>
    <div class="card-body">
        <form action="/pengampu" method="post">
            @csrf
            <input type="text" name="nama" class="form-control text-capitalize" placeholder="masukkan nama waka tahfidz...">
            <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Simpan</h5></button>
        </form>
    </div>
</div>

<div class="card card-success">
    <div class="card-header">
        <h5>
            Daftar Waka Tahfidz
        </h5>
    </div>
    <div class="card-body">
        <table class="table text-capitalize">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengampus as $pengampu)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pengampu->nama}}</td>
                    <td>
                        <a href="pengampu/{{$pengampu->id}}/edit"
                            class="d-inline badge badge-pill badge-warning">Edit</a>
                        <form class="d-inline" action="pengampu/{{$pengampu->id}}" method="post">
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
@endsection