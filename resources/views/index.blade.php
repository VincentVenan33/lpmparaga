@extends('layouts.template')
@section('main')
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome {{ $username }}!</h3>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
              <div class="d-inline flex-md-grow-1 flex-xl-grow-0">
                <i class="ti-calendar"></i>
                &nbsp;
                <div id="datetime" class="datetime"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 grid-margin transparent my-auto">
        <div class="row">
          <div class="col-md-10 mb-5 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <div class="row">
                  <div class="col-3 my-auto">
                    <i class="ti-rss-alt menu-icon icon-size"></i>
                  </div>
                  <div class="col">
                    <h3 class="mb-4">Online Visitor</h3>
                    <h5 class="fs-30 mb-2">{{ $totalOnline }}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10 mb-5 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <div class="row">
                  <div class="col-3 my-auto">
                    <i class="ti-user menu-icon icon-size"></i>
                  </div>
                  <div class="col">
                    <h3 class="mb-4">Monthly Visitor</h3>
                    <h5 class="fs-30 ">{{ (isset($totalMonthlyVisitors[0]->totalMonthlyVisitors) ? $totalMonthlyVisitors[0]->totalMonthlyVisitors : 0 ) }}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Reports</p>
            <div id="reportsChart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card table-dilihat">
    <div class="card-body">
        <h4 class="card-title">News Data</h4>
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
                    ID Admin
                    </th>
                    <th class="text-center">
                    Dilihat
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $nws)
                                <tr>
                                    <th class="nomor-berita">{{ ( $news->currentPage() - 1 ) * $news->perPage() + $loop->iteration }}</th>
                                    <td class="kategori-berita">{{$nws->kat_berita}}</td>
                                    <td class="judul-berita">{{$nws->judul}}</td>
                                    <td class="admin-berita">{{$nws->id_admin}}</td>
                                    <td class="dilihat">{{$nws->dilihat}}</td>
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
    <!-- content-wrapper ends -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const today = new Date();
    const dates = [];
    new ApexCharts(document.querySelector("#reportsChart"), {
      series: [{
        name: 'Page',
        data: @json($chartcount)
      }],
      chart: {
        height: 350,
        type: 'area',
        toolbar: {
          show: false
        },
        timezone: 'Asia/Jakarta'
      },
      markers: {
        size: 4
      },
      colors: ['#4154f1', '#2eca6a', '#ff771d'],
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.3,
          opacityTo: 0.4,
          stops: [0, 90, 100]
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      xaxis: {
        type: 'datetime',
        categories: @json($chartdate),
        labels: {
          style: {
            fontSize: '15px' // Ukuran font yang ingin Anda gunakan
          }
        }
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        },
        style: {
          fontSize: '15px' // Ukuran font yang ingin Anda gunakan
        }
      }
    }).render();
  });
</script>
@endsection
