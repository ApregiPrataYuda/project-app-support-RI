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
              List Paket
            </div>
            <div class="card-body">
              <!-- Konten card di sini -->


              <div class="table-responsive">
                <table class="table table-bordered" id="paketTables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:6%">No</th>
                            <th>No ID PAKET</th>
                            <th>Nama Pemilik Paket</th>
                            <th>Tanggal Diterima</th>
                            <th>Status</th>
                            <th>Kurir</th>
                            <th>Nama Penerima(Security/Resepsionis)</th>
                            <th>Ambil Paket</th>
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
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <article class="card">
            <div class="card-body row">
            <div class="col">
               <span class="text-capitalize">Dengan ini saya menyatakan bahwa saya telah mengambil paket Atas Nama </span>
               <span id="name"></span>
              <textarea class="form-control" id="noidpaket" cols="10" rows="5" readonly></textarea>
             </div>
            </div>
        </article>
        </div>
        <div class="modal-footer">
          <button type="button" id="getPaket" class="btn btn-primary">Ambil Paket</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
    
      var table = $('#paketTables').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url: "{{ route('lists.paket') }}",
              type: 'GET',
          },
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'noidpaket', name: 'noidpaket'},
              {data: 'name', name: 'name'},
              {data: 'tanggal_diterima', name: 'tanggal_diterima'},
              {data: 'status', name: 'status'},
              {data: 'kurir', name: 'kurir'},
              {data: 'name_penerima', name: 'name_penerima'},
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


    $(document).ready(function() {
        $(document).on('click', '#sets', function() {
           var id = $(this).data('id');
           var noidpaket = $(this).data('noidpaket');
           var name = $(this).data('name');
          $( '#id').text(id);  
          $( '#noidpaket').text(noidpaket);  
          $( '#name').text(name);  
        })
      }) 

       
      $(document).ready(function() {
        $('#noidpaket').hide();
        $(document).on('click', '#getPaket', function() {
           var noPaket = $('#noidpaket').val();
           $.ajax({
              type: 'POST',
              url: '{{ route('get.paket.user') }}',
              data: {
                  'noPaket': noPaket
              },
              dataType: 'json',
              headers: {
                  'X-CSRF-TOKEN': csrfToken // Sertakan CSRF token di header
              },
              success: function (data) {
                  Swal.fire({
                      position: 'top-center',
                      icon: 'success',
                      title: 'Paket Sudah Diambil',
                      showConfirmButton: false,
                      timer: 1500
                  }).then(function() {
                      location.reload(); // Reload halaman setelah notifikasi
                  });
              },
              error: function (xhr, status, error) {
                  // Menangani kesalahan
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Terjadi kesalahan: ' + xhr.responseText, // Menampilkan pesan kesalahan
                  });
              }
          });




        })
      }) 
    
  </script>

@endsection