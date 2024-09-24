
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
 
  <style>
    @media print {
      @page {
        size: 74mm 52mm; /* A8 size */
        margin: 0;
      }
      body {
        margin: 0;
        padding: 0;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
      }
      .card {
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 5mm;
      }
      .card-body {
        font-size: 10px;
      }
      .no-print {
        display: none;
      }
    }

    .card-bordered {
      border-top: 2px solid red;
      border-left: 2px solid red;
      border-right: 2px solid red;
      border-bottom: 2px solid red;
      /* Transparent top border */
    }
    .card-body {
      font-size: 12px;
    }
    .qr-container {
      border: 2px solid black;
      padding: 5px;
      display: inline-block;
    }
  </style>


</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->


  <section class="content">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh; margin-top: 5px;">
     
          <div class="card-body">
            <div class="container">
              <div class="row">
                <!-- Card 1 -->
                <div class="col-md-5">
                  <div class="card card-bordered card-outline">
                    <div class="card-body box-profile">
                      <h5 class="text-center text-danger font-weight-bold">ID CARD VISITOR</h5>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <span class="font-weight-bold text-left text-uppercase">DATE: {{format_date_indonesia($row->date_visitor)}}</span><br>
                          <span class="font-weight-bold text-left text-uppercase">NAME: {{ $row->name_visitor}}</span><br>
                          <span class="font-weight-bold text-left text-uppercase">COMPANY: {{ $row->company}}</span><br>
                          <span class="font-weight-bold text-left text-uppercase">APPOINTMENT: {{ ($row->appointment == 1 ? 'YES' : 'NO')}}</span><br>
                          <span class="font-weight-bold text-left text-uppercase">MEET WITH: {{ $row->meet_with}}</span><br>
                          <span class="font-weight-bold text-left text-uppercase">Room: {{$row->room}}</span><br>
                          <span class="font-weight-bold text-left text-uppercase">Hours: {{ $row->meet_hour_start}} - {{ $row->meet_hour_end}}</span><br>
                        </li>
                      </ul>
                      <div class="d-flex justify-content-center">
                        <div class="qr-container">
                          <img src="{{$dataqr}}" alt="QR-CODE" style="width: 100%;">
                        </div>
                      </div>
                      <p class="text-center text-danger font-weight-bold">PT RINNAI INDONESIA</p>
                    </div>
                  </div>
                </div>

                <!-- Card 2 -->
                
             
            </div>
          </div>
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
