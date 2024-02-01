<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- PWA  -->
  <meta name="theme-color" content="#6777ef"/>
  <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
  <link rel="manifest" href="{{ asset('manifest.json') }}">

  <title>Raport Tahfidz</title>

  <link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">

   <!-- Scripts -->
   @vite(['resources/js/app.js'])
</head>

<body class="">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <div id="app">
      <nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
      </nav>
    </div>
    <!-- /.navbar -->



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="ml-1 mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img style="width: 70px" src="{{asset('img/book.jpg')}}" class="img-circle elevation-2" alt="Buku Prestasi">
          </div>
          <div class="info mt-3 ml-2">
            <a class="text-decoration-none font-weight-bolder" href="/"><h4>Raport Tahfidz</h4></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-4">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Input Data Master
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="profile" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile Sekolah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="guru" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Guru / Wali Kelas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pengampu" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Waka Tahfidz</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="kelas" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kelas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="siswa" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Siswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="surah" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Surah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="naik-kelas" class="nav-link">
                    <i class="nav-icon fab fa-hackerrank"></i>
                    <p>
                      Naik Kelas
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="ukj" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  UKJ
                </p>
              </a>
              {{--
            <li class="nav-item">
              <a href="pts" class="nav-link">
                <p>
                  PTS
                </p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="pas" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  PAS
                </p>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a href="tahsin" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Tahsin
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="hafalan" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Tahfidz
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="bulanan" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Bulanan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="raport" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Raport
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content mt-4">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- Default box -->
              @yield('content')
              <!-- /.card -->
            </div>
          </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2023 <a href="#">Wawan Darmawan</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->

  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
  <script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  {{-- <script src="{{asset('dist/js/notif.js')}}"></script> --}}
  <script src="{{asset('dist/js/notif.js')}}"></script>

  {{-- <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script> --}}


  @include('sweetalert::alert')
  @yield('darmawan')
  <script>
    $(function () {

              // //Initialize Select2 Elements
              $('.select2').select2()

              //Initialize Select2 Elements
              $('.select2bs4').select2({
              theme: 'bootstrap4'
              })

          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "paging": false,
            "searching": false,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            "buttons": []
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
  </script>

<script src="{{ asset('sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
            );
        } else {
            console.error("Service workers are not supported.");
    }
</script>

</body>

</html>
