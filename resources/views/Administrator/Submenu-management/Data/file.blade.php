@extends('layouts.app')
@section('content')
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1><?= $title ?></h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
<li class="breadcrumb-item active"><?= $title ?></li>
</ol>
</div>
</div>
</div>
</section>



<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>
<!--start view for user -->
<section class="content">

@if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
@endif

        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-secondary">
            <a href="" class="btn btn-sm btn-outline-dark"> <i class="fa fa-plus"></i> Tambah Data</a>
            <a href="" class="btn btn-sm btn-outline-dark"> <i class="fa fa-window-restore"></i> Restore Data</a>

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
          <table class="table table-bordered" id="submenu">
  <thead>
  <tr>
                        <th style="width: 4%;">No</th>
                        <th>Menu</th>
                        <th>title</th>
                        <th>url</th>
                        <th>icon</th>
                        <th>status</th>
                        <th>catatan</th>
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

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#submenu').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('get.submenu') }}",
            type: 'GET',
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'menu', name: 'menu'},
            {data: 'title', name: 'title'},
            {data: 'url', name: 'url'},
            {data: 'icon', name: 'icon'},
            {data: 'is_active', name: 'is_active'},
            {data: 'noted', name: 'noted'},
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

  function confirmDelete(Roleid) {
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
                document.getElementById('delete-form-menu-' + Roleid).submit();
            }
        });
    }
</script>


@endsection