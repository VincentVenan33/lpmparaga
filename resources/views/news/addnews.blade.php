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
                <input type="text" name="foto_url[]" class="form-control @error('foto_url') is-invalid @enderror" id="foto_url" multiple readonly>
                <button type="button" class="btn btn-primary open-modal-relative">Upload Image</button>
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
<div class="modal fade" id="fileModal" display: none; aria-hidden="true" style="z-index: 100000 !important;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">File Manager</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" style="padding:0px; margin:0px; width: 800px;">
          <iframe width="100%" height="400" src="http://127.0.0.1:8000/responsive_filemanager/filemanager/dialog.php?type=2&field_id=fieldID4&fldr=&crossdomain=1" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
@endsection
@section('addjs')
<script>
    $('.open-modal-relative').on('click', function() {
    $('#fileModal').modal('toggle');
    $target = $(this).data('target');
    $(window).on('message', OnMessage1);
  });
  </script>
@endsection
