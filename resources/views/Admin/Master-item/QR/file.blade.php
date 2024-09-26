
<!DOCTYPE html>
<html lang="en">
<head>
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


  <section class="content">
    <div class="container">
        <div class="card-body">
            <div class="card" style="width: 3rem;">
                <img src="{{ $qr }}" class="card-img-top" alt="QR Code">
            </div>
        </div>
    </div>
</section>
        
       
       
  <script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>
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
    window.onload = function() {
      window.print();
    };
  </script>
</body>
</html>
