@extends('layouts.template-login')
@section('login')
    <!-- container-scroller -->
    <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                <img src="{{  url('') }}/../../images/16024254591111.png" alt="logo">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" action="{{ route('actionlogin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg" id="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password" required>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mr-2">Login</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
@endsection
