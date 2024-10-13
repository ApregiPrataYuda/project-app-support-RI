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
          <table class="table table-bordered" id="itemBorrowTable">
  <thead>
  <tr>
                        <th style="width: 4%;">No</th>
                        <th>Date Borrow</th>
                        <th>Name Borrow</th>
                        <th>Division</th>
                        <th>Code Item</th>
                        <th>Name Item</th>
                        <th>item have Division</th>
                        <th>Status Item Borrow Now</th>
                        <th>Last Status</th>
                        <th>Return Date</th>
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
      var table = $('#itemBorrowTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url: "{{ route('get.trans.item') }}",
              type: 'GET',
          },
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'date_borrow', name: 'date_borrow', orderable: false, searchable: true},
              {data: 'name_borrow', name: 'name_borrow'},
              {data: 'divisi_name', name: 'divisi_name'},
              {data: 'item_code', name: 'item_code'},
              {data: 'name_item', name: 'name_item'},
              {data: 'subdivision_name', name: 'subdivision_name'},
              {data: 'status', name: 'status', orderable: false, searchable: true},
              {data: 'last_status', name: 'last_status', orderable: false, searchable: true},
              {data: 'return_date', name: 'return_date', orderable: false, searchable: true},
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