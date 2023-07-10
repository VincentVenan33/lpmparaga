@extends('layouts.template')
@section('main')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Gambar Data</h4>
                    <a class="btn btn-primary btn-icon-text text-white text-decoration-none" href="{{route('addgambar')}}"><i class="ti-plus btn-icon-prepend"></i>&nbsp; Add gambar</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                            No.
                            </th>
                            <th>
                            Judul Foto
                            </th>
                            <th>
                            id news
                            </th>
                            <th style="text-align: center">
                            Foto
                            </th>
                            <th>
                            Admin
                            </th>
                            <th class="text-center">
                            Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gambar as $gbr)
                                        <tr>
                                            <th class="nomor-berita">{{ ( $gambar->currentPage() - 1 ) * $gambar->perPage() + $loop->iteration }}</th>
                                            <td class="judul-berita">{{$gbr->judul_foto}}</td>
                                            <td class="id-news">{{$gbr->id_news}}</td>
                                            <td class="gambar-foto"><img src="{{ route('getFile', ['filename' => $gbr->foto]) }}" alt="{{ $gbr->foto }}" width="50%"></td>
                                            <td class="admin-berita">{{$gbr->id_admin}}</td>
                                            <td class="button-container">
                                                <div class="button-wrapper">
                                                <a href="{{route('detailgambar', $gbr->id)}}" class="btn btn-info btn-sm"><i class="ti-info"></i></a>
                                                </div>
                                                <div class="button-wrapper horizontal-buttons">
                                                <a href="{{route('changegambar', $gbr->id)}}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                                <a href="{{route('deletegambar', $gbr->id)}}" onclick="return confirm('Apakah Anda Yakin Menghapus gambar ini?');" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Table Paging" class="mb-0 text-muted">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item{{ ($gambar->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $gambar->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $gambar->lastPage(); $i++)
                                        <li class="page-item{{ ($gambar->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $gambar->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item{{ ($gambar->currentPage() == $gambar->lastPage()) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $gambar->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
