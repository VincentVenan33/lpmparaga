@extends('layouts.template')
@section('main')
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Users</h4>
            <form method="post" action="{{route('saveusers')}}" class="forms-sample">
            @csrf
            <div class="form-group">
                <label for="exampleInputName1">Nama</label>
                <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}">
                    @error("name")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            <div class="form-group">
                <label for="inputusername">Username</label>
                <input type="text" name="username" class="form-control @error('username')is-invalid @enderror" value="{{old('username')}}">
                @error("username")
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" value="{{old('email')}}">
                @error("email")
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPassword5">Password</label>
                <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" value="{{old('password')}}">
                @error("password")
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if(Auth::user()->role == "SUPER_ADMIN")
            <div class="form-group">
                <label for="status">Role</label>
                <select name="role" style="color: black; background: white;" class="form-control @error('role')is-invalid @enderror">
                    <option value="" disabled selected>Pilih Role</option>
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
                        <label class="form-control border-0 switch" style="width: max-content">
                            <input name="status" type="checkbox">
                            <span class="slider round"></span>
                        </label>
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
@endsection
