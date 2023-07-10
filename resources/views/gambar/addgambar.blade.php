@extends('layouts.template')
@section('main')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Add Gambar</h4>
        <form method="POST" action="{{route('savegambar')}}" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul_foto">Judul Foto</label>
            <input type="text" name="judul_foto" class="form-control @error('judul_foto')is-invalid @enderror" value="{{old('judul_foto')}}">
            @error("judul_foto")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_news">ID News</label>
            <input type="id_news" name="id_news" class="form-control @error('id_news')is-invalid @enderror" value="{{old('id_news')}}">
            @error("id_news")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="foto">Images</label><br>
            <div id="preview_images"></div>
            <div class="custom-file">
                <input type="file" name="foto[]" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" onchange="previewImages(this);" multiple>
                <label class="custom-file-label" for="foto" id="images-label">Choose images</label>
                @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="id_admin">ID Admin</label>
            <input type="id_admin" name="id_admin" class="form-control @error('id_admin')is-invalid @enderror" value="{{old('id_admin')}}">
            @error("id_admin")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>&nbsp; Save</button>
        <a class="btn btn-light text-black text-decoration-none" href="{{route('viewgambar')}}"><i class="ti-angle-double-left"></i>&nbsp; Cancel</a>
        </form>
    </div>
    </div>
</div>
</div>
@endsection
