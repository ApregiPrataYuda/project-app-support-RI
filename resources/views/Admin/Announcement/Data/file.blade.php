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
<div id="flashError" data-flash="{{ session('error') }}"></div>
<!--start view for user -->

<section class="content">
<a href="{{route('add.announcement')}}" class="btn btn-outline-secondary btn-sm mb-2"><i class="fa fa-plus"></i> Add Announcement <i class="fa fa-bullhorn"></i></a>
</section>
<section class="content">
    <div class="row">
      <!-- Card Kiri -->
      <div class="col-md-7">
        <div class="card">
          <div class="card-header bg-secondary">
              <span>list of announcement that you created</span>
             
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
            <table class="table table-bordered" id="viewDataYourCreated">
              <thead>
                <tr>
                  <th style="width:4%;">No</th>
                  <th>Date Release</th>
                  <th>Title</th>
                  <th>status Announce</th>
                  <th>Divisi Created Announce</th>
                  <th>User Created Announce</th>
                  <th>sent to division</th>
                  <th>Description</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Isi tabel card kiri -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
      <!-- Card Kanan -->
      <div class="col-md-5">
        <div class="card">
          <div class="card-header bg-secondary">
            <span>list of announcements addressed to your division</span>
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
            <table class="table table-bordered" id="viewDataRetriveForYou">
              <thead>
                <tr>
                    <th style="width: 6%;">No</th>
                    <th>Date Release</th>
                    <th>Title</th>
                    <th>status</th>
                    <th>Sending Division</th>
                    <th>Sending User</th>
                    <th>Description</th>
                    <th>File(pdf)</th>
                </tr>
              </thead>
              <tbody>
                <!-- Isi tabel card kanan -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- start modal for  list of announcement that you created-->
  <div class="modal fade" id="modal-preview-created" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Preview File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detailCreated">
          <!-- Konten file PDF akan dimuat di sini melalui AJAX -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal for  list of announcement that you created-->





    <!--start list of announcements addressed to your division-->
    <div class="modal fade" id="modal-preview-retrive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Preview File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detailRetrive">
          <!-- Konten file PDF akan dimuat di sini melalui AJAX -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <!--end list of announcements addressed to your division-->

 <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#viewDataYourCreated').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url: "{{ route('geting.Announcement.your.req') }}",
              type: 'GET',
          },
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'date_created', name: 'date_created', orderable: false, searchable: true},
              {data: 'title', name: 'title', orderable: false, searchable: true},
              {data: 'status', name: 'status', orderable: false, searchable: true},
              {data: 'name_divisi_created', name: 'name_divisi_created', orderable: false, searchable: true},
              {data: 'name', name: 'name', orderable: false, searchable: true},
              {data: 'divisi_tujuan', name: 'divisi_tujuan', orderable: false, searchable: true},
              {data: 'description', name: 'description', orderable: false, searchable: true},
              {data: 'file_name', name: 'file_name', orderable: false, searchable: true},
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





<script type="text/javascript">
    $(document).ready(function() {
      var table = $('#viewDataRetriveForYou').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url: "{{ route('geting.Announcement.your.retrieve') }}",
              type: 'GET',
          },
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'date_created', name: 'date_created'},
              {data: 'title', name: 'title'},
              {data: 'status', name: 'status'},
              {data: 'divisi_name', name: 'divisi_name'},
              {data: 'name', name: 'name'},
              {data: 'description', name: 'description'},
              {data: 'file_name', name: 'file_name'},
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

    //view file created
    $(document).on('click', '.reviews', function() {
       var id = $(this).attr("id");
      // Ambil CSRF token dari meta tag
         var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
              url: '{{ route('get.file.announcement.created') }}',  // URL Laravel route
              method: 'POST',  // Metode POST
              data: {
                  id: id,  // Kirimkan ID
                  _token: csrfToken  // Sertakan CSRF token
              },
              success: function(data) {
                  $('#detailRetrive').html(data);  // Tampilkan data dalam elemen #detail_pdf
                  $('#modal-preview-retrive').modal('show');  // Tampilkan modal
              },
              error: function(xhr, status, error) {
                  console.error(error);  // Menampilkan error jika ada
              }
          });
      });

       //view file sending to your div
    $(document).on('click', '.seeDataFile', function() {
       var id = $(this).attr("id");
      // Ambil CSRF token dari meta tag
         var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
              url: '{{ route('get.file.announcement.retrive') }}',  // URL Laravel route
              method: 'POST',  // Metode POST
              data: {
                  id: id,  // Kirimkan ID
                  _token: csrfToken  // Sertakan CSRF token
              },
              success: function(data) {
                  $('#detailCreated').html(data);  // Tampilkan data dalam elemen #detail_pdf
                  $('#modal-preview-created').modal('show');  // Tampilkan modal
              },
              error: function(xhr, status, error) {
                  console.error(error);  // Menampilkan error jika ada
              }
          });
      });

      function confirmDelete(itemId) {
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
                document.getElementById('delete-form-announcement-' + itemId).submit();
            }
        });
    }
  </script>
  

@endsection