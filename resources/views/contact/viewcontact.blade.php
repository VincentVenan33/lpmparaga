@extends('layouts.template')
@section('main')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Message</h4>
            <a class="btn btn-primary btn-icon-text text-white text-decoration-none" href="{{route('readAllcontact')}}"><i class="ti-check-box btn-icon-prepend"></i>&nbsp; Mark All as Read</a>
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
                    Email
                    </th>
                    <th>
                    Pesan
                    </th>
                    <th>
                    Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($contact as $ctc)
                                <tr class="{{ $ctc->status == 0 ? 'table-secondary' : '' }}">
                                    <th class="nomor-berita">{{ ( $contact->currentPage() - 1 ) * $contact->perPage() + $loop->iteration }}</th>
                                    <td class="kategori-berita">{{$ctc->nama}}</td>
                                    <td class="judul-berita">{{$ctc->email}}</td>
                                    <td class="isi-berita">{{$ctc->pesan}}</td>
                                    <td>
                                        <a href="{{route('detailcontact', $ctc->id)}}" class="btn btn-{{ $ctc->status == 0 ? 'warning' : 'secondary' }} btn-sm">
                                            <i class="fa {{ $ctc->status == 0 ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                        </a>
                                        <a href="{{route('deletecontact', $ctc->id)}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Table Paging" class="mb-0 text-muted">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item{{ ($contact->currentPage() == 1) ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $contact->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $contact->lastPage(); $i++)
                                <li class="page-item{{ ($contact->currentPage() == $i) ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $contact->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item{{ ($contact->currentPage() == $contact->lastPage()) ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $contact->nextPageUrl() }}" aria-label="Next">
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
