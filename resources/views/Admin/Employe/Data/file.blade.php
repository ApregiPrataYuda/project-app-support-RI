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
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-secondary">
            <a href="{{route('add.employe')}}" class="btn btn-sm btn-outline-dark"> <i class="fa fa-plus"></i> Add Data</a>
            <a href="{{route('item.master.restore')}}" class="btn btn-sm btn-outline-dark"> <i class="fa fa-window-restore"></i> Restore Data</a>
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
          <table class="table table-bordered" id="EmployeTable">
  <thead>
  <tr>
                        <th style="width: 4%;">No</th>
                        <th style="width: 10%;">Name</th>
                        <th>Divisi</th>
                        <th style="width: 3%;">Branch</th>
                        <th>section employees(Street)</th>
                        <th style="width: 5%;">Status</th>
                        <th style="width: 6%;">Action</th>
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
      var table = $('#EmployeTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url: "{{ route('get.employes') }}",
              type: 'GET',
          },
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'name', name: 'name', orderable: false, searchable: true},
              {data: 'divisi_name', name: 'divisi_name'},
              {data: 'name_alias', name: 'name_alias'},
              {data: 'street', name: 'street'},
              {data: 'status', name: 'status'},
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

@endsection

