@extends('layouts.template')
@section('main')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit News</h4>
        <form method="POST" action="{{route('updatenews')}}" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" name="id" value="{{$news->id}}">
        </div>
        <div class="form-group">
            <label for="kat_berita">Kategori Berita</label>
            <select name="kat_berita" style="color: black; background: white;" class="form-control @error('kat_berita')is-invalid @enderror">
                <option value="{{ $news->kat_berita }}">{{ $news->kat_berita }}</option>
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
            <input type="text" name="judul" value="{{ $news->judul }}" class="form-control @error('judul')is-invalid @enderror" value="{{old('judul')}}">
            @error("judul")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="isi">Isi</label>
            <input value="{{ $news->isi }}" id="isi" type="hidden" name="isi">
            <trix-editor class="@error('isi')is-invalid @enderror" input="isi"></trix-editor>
            @error("isi")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_admin">id_admin</label>
            <input value="{{ $news->id_admin }}" type="id_admin" name="id_admin" class="form-control @error('id_admin')is-invalid @enderror" value="{{old('id_admin')}}">
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

{{-- <script>
  function previewImages(input) {
    var preview = document.getElementById('preview_images');
    var files = input.files;

    preview.innerHTML = '';

    function readAndPreview(file) {
      if (/\.(jpe?g|png|gif|bmp)$/i.test(file.name)) {
        var reader = new FileReader();

        reader.addEventListener('load', function() {
          var image = new Image();
          image.height = 100;
          image.width = 100;
          image.title = file.name;
          image.src = this.result;

          var div = document.createElement('div');
          div.appendChild(image);

          var input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'new_images[]';
          input.value = file.name;

          var removeButton = document.createElement('i');
          removeButton.classList.add('fas', 'fa-trash', 'cancel-icon', 'remove-image');
          removeButton.setAttribute('title', 'Remove Gambar');
          removeButton.addEventListener('click', function(e) {
            e.preventDefault();
            var div = this.parentElement;
            div.parentNode.removeChild(div);
          });

          var removeButtonContainer = document.createElement('div');
          removeButtonContainer.classList.add('remove-button-container');
          removeButtonContainer.appendChild(removeButton);

          div.appendChild(input);
          div.appendChild(removeButtonContainer);

          preview.appendChild(div);
        });

        reader.readAsDataURL(file);
      }
    }

    if (files) {
      Array.prototype.forEach.call(files, readAndPreview);
    }
  }

  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-image')) {
      e.preventDefault();
      var div = e.target.parentElement;
      div.parentNode.removeChild(div);
    }
  });
</script> --}}
