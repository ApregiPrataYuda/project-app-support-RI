<!DOCTYPE html>
<html lang="en">

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$title}}</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/backend/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link href="{{ asset('assets/backend/vendors/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendors/sweetalert2/animate.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/plugins/toastr/toastr.min.css') }}">

</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light navbar-secondary">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" style="color: RGB(245, 245, 245);" class="nav-link">PT RINNAI INDONESIA </a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light elevation-4 bg-secondary">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{ asset('assets/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image">
        <span style="color: RGB(245, 245, 245); font-style: bold;" class="brand-text font-weight-dark">PT RINNAI <small>INDONESIA</small></span>
      </a>

      @php
      $user = getUserData();
      $first_name = $user->first_name;
      $last_name = $user->last_name;
      $imageUser = $user->image;
    @endphp


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('/assets/backend/dist/img/avatar/' . $imageUser) }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a style="color: RGB(245, 245, 245);" href="#" class="d-block">| 
              {{ $user->employee->first_name }}   {{ $user->employee->last_name }}
          </a>
          </div>
        </div>

      
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @include('layouts.partials.navbar')
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>
    
    
      <!-- Content Header (Page header) -->
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.partials.footer')
    
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Scripts -->

  <script src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/backend/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('assets/backend/dist/js/demo.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/backend/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('assets/backend/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
  <link href="{{ asset('assets/backend/vendors/jquery-ui/jquery-ui.css') }}" rel="stylesheet">
  <script>
    
        document.addEventListener('DOMContentLoaded', function () {
            var flashMessage = document.getElementById('flash').dataset.flash;
            if (flashMessage) {
                Swal.fire({
                    title: 'Success!',
                    text: flashMessage,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            var flashMessage = document.getElementById('flashError').dataset.flash;
            if (flashMessage) {
                Swal.fire({
                    title: 'Error!',
                    text: flashMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });

      $(document).on('click', '#btn-logout', function(e) {
      e.preventDefault();
      // link for href
      var link = $(this).attr('href');
      Swal.fire({
        title: 'Are you sure?',
        text: "Will Logout!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Logout!',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = link;
        }
      })
    })
    </script>
</body>
</html>
