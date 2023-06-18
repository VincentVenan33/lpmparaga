@extends('layouts.template')
@section('main')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Detail News</h4>
        <div class="form-group">
        <label for="kat_berita">Kategori Berita</label>
        <input type="text" name="kat_berita" value="{{ $news->kat_berita }}" class="form-control bg-white" readonly>
        </div>
        <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" name="judul" value="{{ $news->judul }}" class="form-control bg-white" readonly>
        </div>
        <div class="form-group">
        <label for="isi">Isi</label>
        <textarea name="isi" class="form-control bg-white" rows="10" readonly>{{ $news->isi }}</textarea>
        </div>
        <div class="form-group">
        <label for="foto_url">Images</label><br>
        <div id="preview_images">
            @if($news->foto_url)
            @foreach(explode(',', $news->foto_url) as $image)
                <img src="{{ route('getFile', ['filename' => $image]) }}" alt="{{ $image }}" width="20%">
                <input type="hidden" name="existing_images[]" value="{{ $image }}">
                <p>{{ $image }}</p>
            @endforeach
            @endif
        </div>
        </div>
        <div class="form-group">
        <label for="id_admin">id_admin</label>
        <input type="text" name="id_admin" value="{{ $news->id_admin }}" class="form-control bg-white" readonly>
        </div>
        <a class="btn btn-primary" href="{{ route('viewnews') }}"><i class="ti-angle-double-left"></i>&nbsp; Back</a>
    </div>
    </div>
</div>
</div>
@endsection
