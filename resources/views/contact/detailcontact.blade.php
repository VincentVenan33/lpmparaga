@extends('layouts.template')
@section('main')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Inbox</h4>
            <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="{{ $contact->nama }}" class="form-control bg-white" readonly>
            </div>
            <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ $contact->email }}" class="form-control bg-white" readonly>
            </div>
            <div class="form-group">
            <label for="pesan">Pesan</label>
            <textarea name="pesan" class="form-control bg-white" readonly>{{$contact->pesan}}</textarea>
            </div>
            <a class="btn btn-primary" href="{{ route('viewcontact') }}"><i class="ti-angle-double-left"></i>&nbsp; Back</a>
        </div>
        </div>
    </div>
</div>
@endsection
