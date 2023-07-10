@extends('layouts.template')
@section('main')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Detail Gambar</h4>
        <div class="form-group">
            <label for="judul_foto">Judul Foto</label>
            <input type="text" name="judul_foto" value="{{ $gambar->judul_foto }}" class="form-control bg-white" readonly>
        </div>
        <div class="form-group">
            <label for="id_news">ID News</label>
            <input type="text" name="id_news" value="{{ $gambar->id_news }}" class="form-control bg-white" readonly>
        </div>
        <div class="form-group">
        <label for="foto">Images</label><br>
        <div id="preview_images">
            @if($gambar->foto)
            @foreach(explode(',', $gambar->foto) as $image)
                <img src="{{ route('getFile', ['filename' => $image]) }}" alt="{{ $image }}" width="30%">
                <input type="hidden" name="existing_images[]" value="{{ $image }}">
                <p>{{ $image }}</p>
            @endforeach
            @endif
        </div>
        </div>
        <div class="form-group">
        <label for="id_admin">ID Admin</label>
        <input type="text" name="id_admin" value="{{ $gambar->id_admin }}" class="form-control bg-white" readonly>
        </div>
        <a class="btn btn-primary" href="{{ route('viewgambar') }}"><i class="ti-angle-double-left"></i>&nbsp; Back</a>
    </div>
    </div>
</div>
</div>
@endsection
