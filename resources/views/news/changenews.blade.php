@extends('layouts.template')
@section('main')
<div class="main-panel">
    <div class="content-wrapper">
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
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="form-group">
                  <label for="kat_berita">Kategori Berita</label>
                  <input type="text" name="kat_berita" value="{{ $news->kat_berita }}" class="form-control @error('kat_berita')is-invalid @enderror" value="{{old('kat_berita')}}">
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
                    <label for="foto_url">Images</label><br>
                    <div id="preview_images">
                      @if($news->foto_url)
                        @foreach(explode(',', $news->foto_url) as $image)
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
                      <input type="file" name="foto_url[]" class="custom-file-input @error('foto_url') is-invalid @enderror" id="foto_url" onchange="previewImages(this);" multiple>
                      <label class="custom-file-label" for="foto_url" id="images-label">Choose images</label>
                      @error('foto_url')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
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
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <!-- partial -->
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
