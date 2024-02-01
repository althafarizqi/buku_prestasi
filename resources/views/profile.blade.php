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
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Sekolah</th>
                        <th>ALamat Sekolah</th>
                        <th>Kepala Sekolah</th>
                        <th>Semester</th>
                        <th>Tahun ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$profiles->first()->nama}}</td>
                        <td>{{$profiles->first()->alamat}}</td>
                        <td>{{$profiles->first()->kepala_sekolah}}</td>
                        <td>{{$profiles->first()->semester}}</td>
                        <td>{{$profiles->first()->tahun_ajaran}}</td>
                        <td>
                            <a href="/profile/{{$profiles->first()->id}}/edit"
                                class="badge badge-pill badge-warning">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <a href="{{ route('move.all.data') }}" class="mt-4 btn btn-danger form-control"
                onclick="return confirm('Anda yakin ingin mengosongkan semua data?')">Kosongkan Semua Data Nilai Yang
                Lalu</a>
        </div>
    </div>
</div>
</div>
@endsection
