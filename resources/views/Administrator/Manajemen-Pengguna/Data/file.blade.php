@extends('layouts.app')
@section('content')
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>{{$title}}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
<li class="breadcrumb-item active">{{$title}}</li>
</ol>
</div>
</div>
</div>
</section>

<div id="flash" data-flash="{{ session('success') }}"></div>

<!--start view for user -->
<section class="content">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-secondary">
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-outline-dark"> <i class="fa fa-plus"></i> Tambah Data</a>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
          <table class="table table-bordered" id="userTable">
  <thead>
  <tr>
                        <th style="width: 4%;">No</th>
                        <th>Username</th>
                        <th>FullName</th>
                        <th style="width: 10%;">Role</th>
                        <th style="width: 15px;">Image</th>
                        <th style="width: 15px;">Detail</th>
                        <th style="width: 15px;">Access</th>
                        <th style="width: 25px;">Action</th>
                      </tr>
  </thead>
  <tbody>

  </tbody>
</table>
        </div>
        <!-- /.card -->
  </section>
<!--start view for end -->


<!-- Modal -->
<div class="modal fade" id="modals-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Detail</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="container">
    <article class="card">
        <header class="card-header"> Details Data User </header>
        <div class="card-body">
            <h6>Nama Pengguna: <span id="fullname"></span></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Username:</strong> <br> <p id="username"></p> </div>
                    <div class="col"> <strong>Email:</strong> <br> <p id="email"></p> </div>
                    <div class="col"> <strong>Status:</strong> <br> <p id="status"></p></div>
                    <div class="col"> <strong>Role</strong> <br> <p id="role"></p> </div>
                </div>
            </article>
            <hr>
        

            <article class="card">
                <div class="card-body row">
                <div class="col"> <strong>Password:</strong> <br> <textarea class="form-control" id="password" cols="10" rows="5" readonly></textarea> </div>
                </div>
            </article>
        </div>
    </article>
</div>
    
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-chevron-left"></i>  Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('get.user') }}",
            type: 'GET',
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'fullname', name: 'fullname'},
            {data: 'role', name: 'role',orderable: false, searchable: false},
            {data: 'image', name: 'image'},
            {data: 'detail', name: 'detail'},
            {data: 'access', name: 'access',},
            {data: 'action', name: 'action', orderable: false, searchable: true},
        ],
        responsive: true,
        autoWidth: false,
        language: {
            processing: "Loading Data...",
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries to show",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            },
            zeroRecords: "No matching records found"
        }
    });
  });
  
</script>

<script>
        $(document).ready(function() {
        $(document).on('click', '#sets', function() {
           var username = $(this).data('username');
           var fullname = $(this).data('fullname');
           var email = $(this).data('email');
           var status = $(this).data('status');
           var role = $(this).data('role');
           var password = $(this).data('password');
        
          $( '#username').text(username);  
          $( '#fullname').text(fullname);  
          $( '#email').text(email);  
          $( '#status').text(status);  
          $( '#role').text(role);  
          $( '#password').text(password);  
         
        })
      }) 
</script>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Form ID harus sesuai dengan ID form di PHP
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
@endsection



