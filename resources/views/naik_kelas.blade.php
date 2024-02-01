@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <div class="user-block">
            <h3 class="card-title">Kenaikan Kelas</h3>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('naik-kelas.index') }}" method="get">
            <div class="input-group">
                <select name="kelasId" class="custom-select" id="inputGroupSelect04"
                    aria-label="Example select with button addon" onchange="this.form.submit()">
                    <option value="">----Pilih Kelas----</option>
                    @foreach($kelass as $kelas)
                    <option value="{{ $kelas->id }}" @if($kelas->id == $kelas_id) selected @endif>{{
                        $kelas->nama }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<div class="card card-success">
    <div class="card-header">
        <div class="user-block">
            <h3 class="card-title">Kenaikan Kelas</h3>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="d-none d-md-block">
            <form action="{{ route('naik-kelas.updateKelas') }}" method="post">
                @csrf
                <input name="kelas" type="hidden" value="{{$kelas_id}}">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th style="width: 15%">
                                <select style="width: 150px;" class="form-control form-control-sm" id="headerSelect"
                                    onchange="syncSelects(this)">
                                    <option>Naik Kelas</option>
                                    @foreach($kelass as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                            </th>
                        </tr>
                        <tr></tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$siswa->nis}}</td>
                            <td>{{$siswa->nama}}</td>
                            <td>{{$siswa->kelas}}</td>
                            <td>
                                <select style="width: 150px;" name="kelas_id"
                                    class="form-control form-control-sm bodySelect">
                                    <option value="">Naik Kelas</option>
                                    @foreach($kelass as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">
                                <button type="submit" class="btn btn-primary form-control">Naik Kelas</button>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection

@section('darmawan')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function syncSelects(headerSelect) {
        var selectedValue = $(headerSelect).val();
        $('.bodySelect').val(selectedValue);
    }
</script>
@endsection