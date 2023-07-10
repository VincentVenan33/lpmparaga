@extends('layouts.template')
@section('main')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Gambar</h4>
        <form method="POST" action="{{route('updategambar')}}" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" name="id" value="{{$gambar->id}}">
        </div>
        <div class="form-group">
            <label for="judul_foto">Judul Foto</label>
            <input type="text" name="judul_foto" value="{{ $gambar->judul_foto }}" class="form-control @error('judul_foto')is-invalid @enderror" value="{{old('judul_foto')}}">
            @error("judul_foto")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_news">ID News</label>
            <input value="{{ $gambar->id_news }}" type="id_news" name="id_news" class="form-control @error('id_news')is-invalid @enderror" value="{{old('id_news')}}">
            @error("id_news")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputfoto">Foto</label><br>
            @if ($gambar->foto)
                <img id="preview_foto" width="20%" src="{{ route('getFile', ['filename' => $gambar->foto]) }}" alt="Preview foto">
            @else
                <img id="preview_foto" width="20%" src="#" alt="Preview foto" style="display:none;">
            @endif
            <div class="custom-file">
                <input type="file" name="newfoto" value="" class="custom-file-input" id="foto" onchange="previewfoto(this);">
                <input type="hidden" name="foto" value="{{$gambar->foto}}" class="form-control">
                <label class="custom-file-label" for="foto">{{$gambar->foto ? basename($gambar->foto) : 'Choose file'}}</label>
            </div>
            @if ($gambar->foto && $errors->has('newfoto'))
                <div class="invalid-feedback">{{ $errors->first('newfoto') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="id_admin">ID Admin</label>
            <input value="{{ $gambar->id_admin }}" type="id_admin" name="id_admin" class="form-control @error('id_admin')is-invalid @enderror" value="{{old('id_admin')}}">
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
<script>
    function previewfoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#preview_foto')
                .attr('src', e.target.result)
                .show();
        };

        reader.readAsDataURL(input.files[0]);

        // Set the file name as the label text
        var fileName = input.files[0].name;
        $('.custom-file-label').text(fileName);
    } else {
        $('#preview_foto').attr('src', '#').hide();
        $('.custom-file-label').text('Choose file');
    }
}
</script>
@endsection
