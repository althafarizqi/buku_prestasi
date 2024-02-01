@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h2 class="d-none d-sm-block">Cetak Raport</h2>
        <h4 class="d-block d-sm-none text-center">Cetak Raport</h4>
    </div>
    <div class="card-body">
        <div>
            <form action="{{ route('raport.index') }}" method="get">
                <div class="input-group">
                    <select name="kelasId" class="custom-select" id="inputGroupSelect04"
                        aria-label="Example select with button addon" onchange="this.form.submit()">
                        <option value="">----Pilih Kelas----</option>
                        @foreach($kelass as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                    {{-- <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Tampilkan</button>
                    </div> --}}
                </div>
            </form>
        </div>
        {{-- <form action="{{ route('raport.index') }}" method="post">
            @csrf --}}
            <div class="table-responsive-sm" id="data-siswa">
                <table id="example1" class="table table-striped dataTable dtr-inline">
                    <thead>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>Raport</th>
                    </thead>
                    <tbody>
                        @foreach ($results as $siswa)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$siswa->nama}}</td>
                            <td>
                                <form class="form-group" action="raport/{{$siswa->id}}" method="get">
                                    <button class="btn btn-danger btn-sm mr-1" type="submit">Cetak</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    {{-- </form> --}}
</div>
@endsection