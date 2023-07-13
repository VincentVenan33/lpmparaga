@extends('layouts.template')
@section('main')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Anggota Paraga</h4>
                    <a class="btn btn-primary btn-icon-text text-white text-decoration-none" href="{{route('addanggota')}}"><i class="ti-plus btn-icon-prepend"></i>&nbsp; Add Anggota</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                            No.
                            </th>
                            <th>
                            Nama
                            </th>
                            <th>
                            jabatan
                            </th>
                            <th class="text-center">
                            Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($anggota as $agt)
                                        <tr>
                                            <th class="nomor-berita">{{ ( $anggota->currentPage() - 1 ) * $anggota->perPage() + $loop->iteration }}</th>
                                            <td class="kategori-berita">{{$agt->nama}}</td>
                                            <td class="judul-berita">{{$agt->jabatan}}</td>
                                            <td class="button-container">
                                                <div class="button-wrapper">
                                                <a href="{{route('detailanggota', $agt->id)}}" class="btn btn-info btn-sm"><i class="ti-info"></i></a>
                                                </div>
                                                <div class="button-wrapper horizontal-buttons">
                                                <a href="{{route('changeanggota', $agt->id)}}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                                <a href="{{route('deleteanggota', $agt->id)}}" onclick="return confirm('Apakah Anda Yakin Menghapus anggota ini?');" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Table Paging" class="mb-0 text-muted">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item{{ ($anggota->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $anggota->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $anggota->lastPage(); $i++)
                                        <li class="page-item{{ ($anggota->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $anggota->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item{{ ($anggota->currentPage() == $anggota->lastPage()) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $anggota->nextPageUrl() }}" aria-label="Next">
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
