@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>
            Input Data Surah
        </h5>
    </div>
    <div class="card-body">
        <form action="/surah/{{$surah->id}}" method="post">
            @method('PUT')
            @csrf
            <input type="text" name="nama" value="{{$surah->nama}}" class="form-control text-capitalize" placeholder="nama guru...">
            <select class="form-control text-capitalize mt-3" name="juz" id="">
                @foreach ($juzs as $juz)
                    <option value="{{$juz->id}}" @if ($juz->id == $surah->juz) selected
                    @endif>{{$juz->nama}}</option>
                @endforeach
            </select>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-sm btn-primary form-control mt-2"><h5>Update</h5></button>
                </div>
                <div class="col-6">
                    <a href="javascript:history.back()" class="btn btn-sm btn-danger form-control mt-2"><h5>Batal</h5></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection