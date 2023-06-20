@extends('layouts.template')
@section('main')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Add News</h4>
        <form method="POST" action="{{route('savenews')}}" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="kat_berita">Kategori Berita</label>
            <select name="kat_berita" style="color: black;" class="form-control @error('kat_berita')is-invalid @enderror">
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="Sosial Budaya">Sosial Budaya</option>
                <option value="Kesehatan">Kesehatan</option>
                <option value="Politik">Politik</option>
                <option value="Ekonomi">Ekonomi</option>
                <option value="Gametech">Gametech</option>
                <option value="Olahraga">Olahraga</option>
                <option value="Opini">Opini</option>
            </select>
            @error("kat_berita")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control @error('judul')is-invalid @enderror" value="{{old('judul')}}">
            @error("judul")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="isi">Isi</label>
            <input id="isi" type="hidden" name="isi">
            <trix-editor class="@error('isi')is-invalid @enderror" input="isi"></trix-editor>
            @error("isi")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="foto_url">Images</label><br>
            <div id="preview_images"></div>
            <div class="custom-file">
                <input type="file" name="foto_url[]" class="custom-file-input @error('foto_url') is-invalid @enderror" id="foto_url" onchange="previewImages(this);" multiple>
                <label class="custom-file-label" for="foto_url" id="images-label">Choose images</label>
                @error('foto_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>
        <div class="form-group">
            <label for="id_admin">id_admin</label>
            <input type="id_admin" name="id_admin" class="form-control @error('id_admin')is-invalid @enderror" value="{{old('id_admin')}}">
            @error("id_admin")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>&nbsp; Save</button>
        <a class="btn btn-light text-black text-decoration-none" href="{{route('viewnews')}}"><i class="ti-angle-double-left"></i>&nbsp; Cancel</a>
        </form>
    </div>
    </div>
</div>
</div>
@endsection
