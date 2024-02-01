@extends('layouts.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <div class="user-block">
            <h3 class="card-title">Penting</h3>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        1. Baca Bismillah dan Berdoa sebelum memulai pekerjaan.<br />
        2. Sebelum Input nilai pastikan Semester dan Tahun Ajaran sudah sesuai, untuk pengaturannya bisa masuk ke Menu
        (Input Data Master -> Profile). <br />
        3. Kosongkan semua data nilai yang lalu, masuk ke Menu (Input Data Master -> Profile) lalu tekan tombol warna
        merah.<br />
        4. Untuk kenaikan kelas, pastikan dimulai dari kelas 6 terlebih dahulu, lalu kelas 5, kelas 4, dst, jika
        terbalik
        maka harus edit dari menu siswa satu-persatu.<br />
        5. Lakukan Backup berkala dan simpan file backup di tempat berbeda.
    </div>
</div>
@endsection