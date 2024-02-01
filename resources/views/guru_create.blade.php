@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Input Data Guru/Wali Kelas
        </h5>
    </div>
    <div class="card-body">
        <form action="/guru" method="post">
            @csrf
            <input type="text" name="nama" class="form-control text-capitalize" placeholder="masukkan nama guru...">
            <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Simpan</h5></button>
        </form>
    </div>
</div>

<div class="card card-success">
    <div class="card-header">
        <h5>
            Daftar Guru/Wali Kelas
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
                @foreach ($gurus as $guru)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$guru->nama}}</td>
                    <td>
                        <a href="guru/{{$guru->id}}/edit"
                            class="d-inline badge badge-pill badge-warning">Edit</a>
                        <form class="d-inline" action="guru/{{$guru->id}}" method="post">
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