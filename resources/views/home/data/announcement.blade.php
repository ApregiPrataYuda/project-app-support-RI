@extends('frontend.app')
@section('content')

<div class="content-wrapper">
<div class="content-header">
<div class="container">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0"> <small> {{$title}}</small></h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
{{-- <li class="breadcrumb-item active">{{$title}}</li> --}}
</ol>
</div>
</div>
</div>
</div>


<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>

<div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card mb-2">
            <div class="card-header bg-secondary text-white">
              List Announcement <i class="fa fa-volume-up" aria-hidden="true"></i>
            </div>
            <div class="card-body">
              <!-- Konten card di sini -->

              <div class="table-responsive">
                <table class="table table-bordered" id="annoucementTables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:6%">No</th>
                            <th>Date Release</th>
                            <th>Title</th>
                            <th>status</th>
                            <th>Division Created</th>
                            <th>User Created</th>
                            <th>Description</th>
                            <th>File(pdf)</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Preview File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detils">
          <!-- Konten file PDF akan dimuat di sini melalui AJAX -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  


     <script type="text/javascript">
    $(document).ready(function() {
    
      var table = $('#annoucementTables').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url: "{{ route('lists.announcement') }}",
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
              // {data: 'action', name: 'action', orderable: false, searchable: true},
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



     //  preview file
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
                  $('#detils').html(data);  // Tampilkan data dalam elemen #detail_pdf
                  $('#modal-detail').modal('show');  // Tampilkan modal
              },
              error: function(xhr, status, error) {
                  console.error(error);  // Menampilkan error jika ada
              }
          });
      });


  </script>

  

@endsection