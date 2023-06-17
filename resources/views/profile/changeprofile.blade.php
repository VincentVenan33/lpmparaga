@extends('layouts.template')
@section('main')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Profile</h4>
              <form method="post" action="{{route('updateprofile', $user->id)}}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$user->id}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Nama</label>
                  <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}">
                        @error("name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="inputusername">Username</label>
                        <input type="text" name="username" value="{{$user->username}}" class="form-control @error('username')is-invalid @enderror" value="{{old('username')}}">
                        @error("username")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email')is-invalid @enderror" value="{{old('email')}}">
                        @error("email")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password Lama</label>
                    <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror">
                    @error('oldpassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputPassword5">Password Baru</label>
                        <input type="password" name="newpassword" value="" class="form-control">
                        <input type="hidden" name="password" value="{{$user->password}}" class="form-control @error('password')is-invalid @enderror" value="{{old('password')}}">
                        @error("password")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                  </div>
                <div class="form-group">
                    <div class="row mt-4">
                        <div class="col-1">
                            <label for="status">Status</label>
                        </div>
                        <div class="col col-sm-1 status-swith">
                            <label class="form-control border-0 switch">
                                <input name="status" value="{{$user->status}}" type="checkbox" {{ ($user->status == 1 ? 'checked' : '') }}>
                                <span class="slider round"></span>
                            </label>
                            {{-- <td> <input data-id="{{$s->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $s->status ? 'checked' : '' }}> --}}
                        </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>&nbsp; Save</button>
                    <button class="btn btn-light mr-2" onclick="window.history.back();">
                        <i class="ti-angle-double-left"></i>&nbsp; Cancel
                    </button>
                    @if (Auth::user()->role !== 'SUPER_ADMIN')
                    <button type="button" class="btn btn-danger btn-icon-text">
                        <a href="{{ route('deleteprofil') }}" class="text-white text-decoration-none" onclick="return confirm('Apakah Anda yakin ingin menghapus akun?');">
                            <i class="ti-trash btn-icon-prepend"></i>
                            Hapus Akun
                        </a>
                    </button>
                    @endif
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
