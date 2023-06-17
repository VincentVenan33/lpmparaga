@extends('layouts.template')
@section('main')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">News Data</h4>
            <a class="btn btn-primary btn-icon-text text-white text-decoration-none" href="{{route('addnews')}}"><i class="ti-plus btn-icon-prepend"></i>&nbsp; Add News</a>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  No.
                </th>
                <th>
                  Kategori Berita
                </th>
                <th>
                  Judul
                </th>
                <th>
                  Isi
                </th>
                <th>
                  Admin
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($news as $nws)
                            <tr>
                                <th>{{ ( $news->currentPage() - 1 ) * $news->perPage() + $loop->iteration }}</th>
                                <td>{{$nws->kat_berita}}</td>
                                <td>
                                    @php
                                    $words = explode(' ', $nws->judul);
                                    $firstLine = implode(' ', array_slice($words, 0, 3));
                                    $remainingWords = array_slice($words, 3);
                                    $remainingLines = array_chunk($remainingWords, 3);
                                @endphp
                                <p>{{ $firstLine }}</p>
                                @foreach ($remainingLines as $line)
                                    <p>{{ implode(' ', $line) }}</p>
                                @endforeach</td>
                                <td> @php
                                    $words = explode(' ', $nws->isi);
                                    $firstLine = implode(' ', array_slice($words, 0, 4));
                                    $remainingWords = array_slice($words, 4);
                                    $remainingLines = array_chunk($remainingWords, 4);
                                @endphp
                                <p>{{ $firstLine }}</p>
                                @foreach ($remainingLines as $line)
                                    <p>{{ implode(' ', $line) }}</p>
                                @endforeach</td>
                                <td>{{$nws->id_admin}}</td>
                                <td>
                                <a href="{{route('changenews', $nws->id)}}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                <a href="{{route('detailnews', $nws->id)}}" class="btn btn-info btn-sm"><i class="ti-info"></i></a>
                                <a href="{{route('deletenews', $nws->id)}}" onclick="return confirm('Apakah Anda Yakin Menghapus news ini?');" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <nav aria-label="Table Paging" class="mb-0 text-muted">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item{{ ($news->currentPage() == 1) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $news->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $news->lastPage(); $i++)
                            <li class="page-item{{ ($news->currentPage() == $i) ? ' active' : '' }}">
                                <a class="page-link" href="{{ $news->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item{{ ($news->currentPage() == $news->lastPage()) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $news->nextPageUrl() }}" aria-label="Next">
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
</div>
</div>
@endsection