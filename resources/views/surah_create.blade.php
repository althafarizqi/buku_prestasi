@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Input Data Surah
        </h5>
    </div>
    <div class="card-body">
        <form action="/surah" method="post">
            @csrf
            <input type="text" name="nama" class="form-control text-capitalize" placeholder="nama surah...">
            <select class="form-control text-capitalize mt-3" name="juz" id="">
                <option class="text-muted" value="">Pilih Juz</option>
                @foreach ($juzs as $juz)
                    <option value="{{$juz->id}}">{{$juz->nama}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Simpan</h5></button>
        </form>
    </div>
</div>

<div class="card card-success">
    <div class="card-header">
        <h5>
            Daftar Surah
        </h5>
    </div>
    <div class="card-body">
        <table class="table text-capitalize">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Surah</th>
                    <th>Juz</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surahs as $surah)
                <tr>
                    <td>{{ ($surahs->currentPage() - 1) * $surahs->perPage() + $loop->iteration }}</td>
                    <td>{{$surah->nama}}</td>
                    <td>{{$surah->juz}}</td>
                    <td>
                        <a href="surah/{{$surah->id}}/edit"
                            class="d-inline badge badge-pill badge-warning">Edit</a>
                        <form class="d-inline" action="surah/{{$surah->id}}" method="post">
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
        <div class="d-flex justify-content-center">
            {!! $surahs->withQueryString()->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection