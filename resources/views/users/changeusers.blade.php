@extends('layouts.template')
@section('main')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Edit Users</h4>
              <form method="post" action="{{route('updateusers')}}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$users->id}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Nama</label>
                  <input type="text" name="name" value="{{$users->name}}" class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}">
                        @error("name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="inputusername">Username</label>
                        <input type="text" name="username" value="{{$users->username}}" class="form-control @error('username')is-invalid @enderror" value="{{old('username')}}">
                        @error("username")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email</label>
                        <input type="email" name="email" value="{{$users->email}}" class="form-control @error('email')is-invalid @enderror" value="{{old('email')}}">
                        @error("email")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="inputPassword5">Password</label>
                        <input type="password" name="newpassword" value="" class="form-control">
                        <input type="hidden" name="password" value="{{$users->password}}" class="form-control @error('password')is-invalid @enderror" value="{{old('password')}}">
                        @error("password")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                @if(Auth::user()->role == "SUPER_ADMIN")
                <div class="form-group">
                    <label for="status">Role</label>
                    <select name="role" style="color: black;" class="form-control @error('role')is-invalid @enderror">
                        <option value="{{$users->role}}">{{$users->role}}</option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="USER">USER</option>
                    </select>
                    @error("role")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                <div class="form-group">
                    <div class="row mt-4">
                        <div class="col-1">
                            <label for="status">Status</label>
                        </div>
                        <div class="col col-sm-1 status-swith">
                            <label class="form-control border-0 switch">
                                <input name="status" value="{{$users->status}}" type="checkbox" {{ ($users->status == 1 ? 'checked' : '') }}>
                                <span class="slider round"></span>
                            </label>
                            {{-- <td> <input data-id="{{$s->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $s->status ? 'checked' : '' }}> --}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>&nbsp; Save</button>
                <a class="btn btn-light text-black text-decoration-none" href="{{route('viewusers')}}"><i class="ti-angle-double-left"></i>&nbsp; Cancel</a>
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
