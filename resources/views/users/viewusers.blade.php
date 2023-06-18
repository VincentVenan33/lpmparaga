@extends('layouts.template')
@section('main')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Data</h4>
                    <a class="btn btn-primary btn-icon-textt ext-white text-decoration-none" href="{{route('addusers')}}"><i class="ti-plus btn-icon-prepend"></i>&nbsp; Add Users</a>
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
                        Username
                        </th>
                        <th>
                        E-mail
                        </th>
                        <th>
                        Role
                        </th>
                        <th>
                        Status
                        </th>
                        <th>
                        Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $usr)
                                    <tr>
                                        <th class="user-number">{{ ( $users->currentPage() - 1 ) * $users->perPage() + $loop->iteration }}</th>
                                        <td class="user-name">{{$usr->name}}</td>
                                        <td class="user-username">{{$usr->username}}</td>
                                        <td class="user-email">{{$usr->email}}</td>
                                        <td class="user-role">{{$usr->role}}</td>
                                        <td class="user-status">{{($usr->status ==1 ? "AKTIF" : "NON AKTIF")}}</td>
                                        <td>
                                        <a href="{{route('changeusers', $usr->id)}}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                        <a href="{{route('deleteusers', $usr->id)}}" onclick="return confirm('Apakah Anda Yakin Menghapus Users ini?');" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Table Paging" class="mb-0 text-muted">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item{{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                                    <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                    <li class="page-item{{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item{{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
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
