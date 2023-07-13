@extends('layouts.template')
@section('main')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Detail Angota</h4>
        <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="{{ $anggota->nama }}" class="form-control bg-white" readonly>
        </div>
        <div class="form-group">
        <label for="jabatan">Jabatan</label>
        <input type="text" name="jabatan" value="{{ $anggota->jabatan }}" class="form-control bg-white" readonly>
        </div>
        <a class="btn btn-primary" href="{{ route('viewanggota') }}"><i class="ti-angle-double-left"></i>&nbsp; Back</a>
    </div>
    </div>
</div>
</div>
@endsection
