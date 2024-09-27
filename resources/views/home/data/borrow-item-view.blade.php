@extends('frontend.app')
@section('content')
<style>
  .multi-column-list {
  display: flex;
  flex-wrap: wrap;
  list-style-type: none;
  max-width: 400px; /* Adjust as needed */
}

.multi-column-list li {
  width: 50%; /* Two items per row */
}

.multi-column-list li:nth-child(5n+1) {
  clear: left; /* Start a new "column" after every 5 items */
}

</style>
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
{{-- <li class="breadcrumb-item active">Top Navigation</li> --}}
</ol>
</div>
</div>
</div>
</div>


<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>

<div class="content">


<div class="row justify-content-center">
  <!-- Card 1 -->
  <div class="col-md-6 col-lg-5 mb-5">
<div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Item Usage Registration Form</h5>
          <br>
          <br>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loanModal">
           Form Registration Item
          </button>
          
        </div>
      </div>
    </div>

    
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Equipment Usage Return Form</h5>
          <br>
          <br>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
             Form Return Item
          </button>
        </div>
      </div>
    </div>
  </div>

</div>
</div>

<div class="content mb-5 d-flex justify-content-center">
    <div class="card bg-dark text-white" style="width: 35rem;">
      <img src="{{ asset('assets/backend/dist/img/tools.png') }}" class="card-img" alt="...">
      <div class="card-img-overlay">
        
      </div>
    </div>
  </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

  <!-- Modal loan-->
<div class="modal fade" id="loanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form {{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
        <div class="row">
    <!-- Kolom Kiri -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="tanggal_dipinjam"><span class="text-uppercase">Date *</span></label>
            <input type="date" name="tanggal_dipinjam" id="tanggal_dipinjam" class="form-control" value="<?= date('Y-m-d')?>" disabled>
        </div>

        <div class="form-group">
            <label for="msbrg"><span class="text-uppercase">Code Item *</span></label>
            <input type="text" id="code_item" class="form-control" placeholder="Scan or enter code item" />
        </div>

        <div class="form-group">
            <label for="nik"><span class="text-uppercase">NIK *</span></label>
            <input type="text" class="form-control" id="nik" name="nik" placeholder="via QR nametag">
        </div>

        <div class="form-group">
            <label for="nama_peminjam"><span class="text-uppercase">Tool User Name *</span></label>
            <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" placeholder="Name Peminjam..." readonly>
        </div>

        <div class="form-group">
            <label for="location"><span class="text-uppercase">Location (Division) *</span></label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Division..." readonly>
        </div>

        <div class="form-group">
            <label for="description"><span class="text-uppercase">Statement *</span></label>
            <textarea name="description" id="description" cols="10" rows="2" class="form-control" placeholder="I declare responsibility for the tools I use" readonly></textarea>
        </div>

    </div>


    <!-- Kolom Kanan -->
    <!-- <div class="col-md-7"> -->
        <!-- Kartu untuk Menyimpan Kode -->
        <!-- <h5 class="card-title">Daftar Kode</h5>
        <div class="card mb-5" style="width: 100%;">
                <div class="card-body"> -->
                   
                    <!-- <ul id="savedItems"  class="multi-column-list"> -->
                        <!-- Daftar kode yang disimpan akan muncul di sini -->
                    <!-- </ul>
                </div>
            </div> -->
    <!-- </div> -->

    <!-- Kolom Kanan -->
<div class="col-md-7">
    <!-- Kartu untuk Menyimpan Kode -->
    <h5 class="card-title">List of items to be borrowed</h5>
    <div class="card mb-5" style="width: 100%;">
        <div class="card-body">
            <table class="table table-bordered" id="savedItemsTable">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Item</th>
                    </tr>
                </thead>
                <tbody id="savedItems">
                    <!-- Daftar kode yang disimpan akan muncul di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>


</div>








        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          <button type="submit" id="save" name="save" class="btn btn-outline-info btn-sm ml-2"> <i class="fa fa-save"></i> save </button>
        </div>
    
      </div>
    </div>
  </div>
  </div>
  </div>



<!-- Modal return-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Return Item Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
       

    <div class="row justify-content-center">

    
    <!-- Card 1 -->
    <div class="col-md-6 mr-2">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
            <input type="text" class="form-control focus-primary" placeholder="Scan QR code" focus>
            </div>
        </div>
    </div>




    <!-- Card 2 -->
    <div class="col-md-6 mr-2">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <span class="font-weight-bold">Detail Item</span>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Name Item: </li>
                <li class="list-group-item">Employe Borrow: </li>
                <li class="list-group-item">Location Usage: </li>
                <li class="list-group-item">From Time: </li>
                <li class="list-group-item">End Time: </li>
                <li class="list-group-item">status: </li>
            </ul>
        </div>
    </div>
</div>





              
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


  
  <script>
    $(document).ready(function(){
        // Inisialisasi array untuk menyimpan kode item
        let kodeItems = [];
        // Fokuskan pada input kode item saat halaman siap
        $('#code_item').val("").focus();
        
        // Fungsi untuk memproses kode item yang dipindai
        function processScannedCode(kodeProduct) {
            // Periksa apakah kode tidak kosong
            if(kodeProduct !== ""){
                // Ambil nama item dari server menggunakan AJAX
                $.ajax({
                  url: '/Home/' + kodeProduct,
                    type: 'GET', 
                    success: function(response) {
                        if (response.success) {
                            // Tambahkan kode item ke array
                            kodeItems.push(kodeProduct);
                            // Kosongkan input setelah menyimpan
                            $('#code_item').val("").focus();
                            // Tampilkan array di console
                            console.log(kodeItems);
                            
                            // Menampilkan kode item dan nama item di UI
                            // let itemCount = $('#savedItems li').length + 1;
                            // $('#savedItems').append('<li><p class="badge badge-primary ml-2 mr-2 mb-2">' + itemCount + '. ' + kodeProduct + ': ' + response.name_item + '</p></li>');
                            let itemCount = $('#savedItems tr').length + 1; // Update the selector to count table rows
$('#savedItems').append(`
    <tr>
        <td>${itemCount}</td>
        <td>${kodeProduct}</td>
        <td>${response.name_item}</td>
    </tr>
`);
                        } else {
                            alert('Item not found for code: ' + kodeProduct);
                        }
                    },
                    error: function() {
                        alert('Error retrieving item data.');
                    }
                });
            } else {
                alert('Please enter a valid code.');
            }
        }

        // Menggunakan event 'input' atau 'keyup' untuk menangkap input dari scanner
        $('#code_item').on('keyup', function(e){
            let tex = $(this).val();
            // Periksa jika tombol yang ditekan adalah 'Enter' (kode ASCII 13)
            if(e.keyCode === 13 && tex !== "") {
                // Proses kode yang dipindai
                processScannedCode(tex);
                // Mencegah perilaku default
                e.preventDefault();
            }
        });

    });
</script>


  


<!-- <script>
    $(document).ready(function(){
        // Inisialisasi array untuk menyimpan kode item
        let kodeItems = [];
        // Fokuskan pada input kode item saat halaman siap
        $('#code_item').val("").focus();
        // Fungsi untuk memproses kode item yang dipindai
        function processScannedCode(kodeProduct) {
            // Periksa apakah kode tidak kosong
            if(kodeProduct !== ""){
                // Tambahkan kode item ke array
                kodeItems.push(kodeProduct);
                // Kosongkan input setelah menyimpan
                $('#code_item').val("").focus();
                // Tampilkan array di console
                console.log(kodeItems);
                // Menampilkan kode item yang disimpan di UI jika perlu
                // $('#savedItems').append('<li>' + kodeProduct + '</li>');
                let itemCount = $('#savedItems li').length + 1;
              $('#savedItems').append('<li>' + itemCount + '. ' + kodeProduct + '</li>');
              itemCount++;
            } else {
                alert('Please enter a valid code.');
            }
        }

        // Menggunakan event 'input' atau 'keyup' untuk menangkap input dari scanner
        $('#code_item').on('keyup', function(e){
            let tex = $(this).val();
            // Periksa jika tombol yang ditekan adalah 'Enter' (kode ASCII 13)
            if(e.keyCode === 13 && tex !== "") {
                // Proses kode yang dipindai
                processScannedCode(tex);
                // Mencegah perilaku default
                e.preventDefault();
            }
        });

    });
</script> -->

<!-- code untuk simpan -->
<!-- $.ajax({
    url: '/save-codes',
    method: 'POST',
    data: { codes: kodeItems },
    success: function(response){
        alert('Codes saved successfully!');
    },
    error: function(error){
        console.error('Error saving codes:', error);
    }
}); -->

@endsection