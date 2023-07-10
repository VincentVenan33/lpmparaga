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
            <label for="foto">Images</label><br>
            <div id="preview_images">
                @if($gambar->foto)
                @foreach(explode(',', $gambar->foto) as $image)
                    <div>
                    <img src="{{ route('getFile', ['filename' => $image]) }}" alt="{{ $image }}" width="20%" data-filename="{{ $image }}">
                    <input type="hidden" name="existing_images[]" value="{{ $image }}">
                    <i class="fas fa-trash cancel-icon remove-image ml-4" title="Remove Gambar"></i>
                    <p>{{ $image }}</p>
                    </div>
                @endforeach
                @endif
            </div>
            <div class="custom-file">
                <input type="file" name="foto[]" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" onchange="previewImages(this);" multiple>
                <label class="custom-file-label" for="foto" id="images-label">Choose images</label>
                @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="id_admin">id_admin</label>
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
@endsection

<script>
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
</script>
