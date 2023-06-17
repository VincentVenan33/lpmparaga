<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LPM Paraga || {{ $title }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{  url('') }}/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{  url('') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{  url('') }}/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{  url('') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{  url('') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="{{  url('') }}/text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{  url('') }}/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="{{  url('') }}/css/trix.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{  url('') }}/images/Copy of Paraga HD png bg SQUARE.png" />
  <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{route('dashboard')}}"><img src="{{  url('') }}/images/16024254591111.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}"><img src="{{  url('') }}/images/Paraga HD png bg.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <h1></h1>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <h4 class="mr-3 mb-0">{{ $username }}</h4>
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <i class="ti-settings"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ route('changeprofil', Auth::id()) }}">
                  <i class="ti-user text-primary"></i>
                  Profil
                </a>
                <a class="dropdown-item" href="{{ route('actionlogout') }}">
                  <i class="ti-power-off text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="{{route('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(auth()->user()->role === 'SUPER_ADMIN')
          <li class="nav-item">
            <a class="nav-link" href="{{route('viewusers')}}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{route('viewnews')}}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">News</span>
            </a>
          </li>

        </ul>
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Form elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Charts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Error pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> --}}
        {{-- </ul> --}}
      </nav>
      @yield('main')
      <!-- partial -->
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{  url('') }}/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{  url('') }}/js/template.js"></script>
  <script src="{{  url('') }}/vendors/chart.js/Chart.min.js"></script>
  <script src="{{  url('') }}/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{  url('') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="{{  url('') }}/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{  url('') }}/js/off-canvas.js"></script>
  <script src="{{  url('') }}/js/hoverable-collapse.js"></script>
  <script src="{{  url('') }}/js/settings.js"></script>
  <script src="{{  url('') }}/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{  url('') }}/js/dashboard.js"></script>
  <script src="{{  url('') }}/js/Chart.roundedBarCharts.js"></script>
  <script type="text/javascript" src="{{  url('') }}/js/trix.js"></script>
  <!-- End custom js for this page-->
  <!-- Toast -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
  <script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>
  <script>
        function tampilkanTanggalWaktu() {
            var sekarang = new Date();
            var tanggal = sekarang.getDate() + ' ' + bulanIndonesia(sekarang.getMonth()) + ' ' + sekarang.getFullYear();
            var jam = formatAngka(sekarang.getHours());
            var menit = formatAngka(sekarang.getMinutes());
            var detik = formatAngka(sekarang.getSeconds());
            var waktu = jam + ':' + menit + ':' + detik;
            document.getElementById('datetime').innerHTML = tanggal + ' ' + waktu;
        }

        function bulanIndonesia(bulan) {
            var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            return namaBulan[bulan];
        }

        function formatAngka(angka) {
            return angka < 10 ? '0' + angka : angka;
        }

        if (window.location.pathname === '/dashboard') {
    tampilkanTanggalWaktu();
    setInterval(tampilkanTanggalWaktu, 1000);
  }
    </script>
    <script>
        var currentUrl = "{{ url()->current() }}";

        var navLinks = document.querySelectorAll(".nav > li > a");

        for (var i = 0; i < navLinks.length; i++) {
          var link = navLinks[i];

          if (link.getAttribute("href") === currentUrl) {

            link.parentElement.classList.add("active");
          }
        }
      </script>
      <script>
        function previewImages(input) {
            var previewImagesContainer = document.getElementById('preview_images');

            if (!previewImagesContainer) {
                return;
            }

            if (!input.files) {
                return;
            }

            Array.from(input.files).forEach(function(file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.setAttribute('src', e.target.result);
                    img.setAttribute('width', '20%');

                    var removeIcon = document.createElement('i');
                    removeIcon.classList.add('fas', 'fa-trash', 'cancel-icon');
                    removeIcon.setAttribute('title', 'Remove Gambar');
                    removeIcon.addEventListener('click', function() {
                        removeImage(file);
                    });

                    removeIcon.style.marginLeft = '5%';

                    var filename = document.createElement('p');
                    filename.textContent = file.name; // Menampilkan nama file

                    var imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-container');
                    imageContainer.appendChild(img);
                    imageContainer.appendChild(removeIcon);
                    imageContainer.appendChild(filename);

                    previewImagesContainer.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            });
        }

        function removeImage(file) {
            // Fungsi untuk menghapus gambar dari pratinjau
            var previewImagesContainer = document.getElementById('preview_images');

            if (!previewImagesContainer) {
                return;
            }

            var imageContainers = previewImagesContainer.getElementsByClassName('image-container');

            for (var i = 0; i < imageContainers.length; i++) {
                var filenameElement = imageContainers[i].getElementsByTagName('p')[0];
                var filename = filenameElement.textContent.trim();

                if (filename === file.name) {
                    previewImagesContainer.removeChild(imageContainers[i]);
                    break;
                }
            }
        }
    </script>

        <!-- menggilangkan upload file button -->
        <style>
            trix-toolbar [data-trix-button-group="file-tools"]{
                display:none;
            }
        </style>
        <script>
            document.addEventListener('trix-file-accept', function(e){
                e.preventDefault();
            })
        </script>
</body>

</html>

