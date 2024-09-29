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
            <label for="datesNow"><span class="text-uppercase">Date *</span></label>
            <input type="text" name="datesNow" id="datesNow" class="form-control" value="{{ format_date_indonesia_old() }}" disabled>
        </div>

        <div class="form-group">
            <label for="code_item"><span class="text-uppercase">Code Item *</span></label>
            <input type="text" id="code_item" class="form-control" placeholder="Scan your code item" />
        </div>

        <div class="form-group">
            <label for="number_identity_employe"><span class="text-uppercase">NIK Employe*</span></label>
            <input type="text" class="form-control" id="number_identity_employe" name="number_identity_employe" placeholder="Scan Number Identity Employe">
        </div>

        <div class="form-group">
            <label for="name_borrow"><span class="text-uppercase">name of responsible employee*</span></label>
            <input type="text" class="form-control text-uppercase" id="name_borrow" name="name_borrow" placeholder="Name of Responsible Employee..." readonly>
        </div>

        <div class="form-group">
            <label for="division"><span class="text-uppercase">Division *</span></label>
            <input type="text" class="form-control" id="division" name="division" placeholder="Division..." readonly>
        </div>

        <div class="form-group">
            <label for="description"><span class="text-uppercase">Statement *</span></label>
            <textarea name="description" id="description" cols="10" rows="2" class="form-control" placeholder="I declare responsibility for the tools I use" readonly></textarea>
        </div>

    </div>

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
                        <th>Code Item</th>
                        <th>Name Item</th>
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
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> 
          <button type="submit" id="processBorrow" name="save" class="btn btn-outline-primary ml-2"> <i class="fa fa-share" aria-hidden="true"></i> Process </button>
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
  let kodeItems = [];
  let nikEmploye = [];
  $('#code_item').val("").focus();
  $('#number_identity_employe').val("").focus();
  
     // ITEM FUNCTION
     function processScannedCode(kodeProduct) {
    if (kodeProduct !== "") {
        // Cek apakah kode item sudah dipindai sebelumnya
        if (kodeItems.indexOf(kodeProduct) !== -1) {
            Notiflix.Report.warning(
                'Warning', // Title
                'Kode item sudah Scan sebelumnya: ' + kodeProduct,
                'Back'
            );
            $('#code_item').val("").focus();
            return;
        }

        // AJAX request ke server untuk mendapatkan detail produk
        $.ajax({
            url: '/Home/' + kodeProduct,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    // Cek apakah status_borrow = 1
                    if (response.status_borrows == 1) {
                        Notiflix.Report.failure(
                            'Warning', // Title
                            'sedang dipinjam Anda Tidak Bisa Melakukan Peminjaman untuk kode Item: ' + kodeProduct,
                            'Back'
                        );
                        $('#code_item').val("").focus();
                        return;
                    }

                    // Jika tidak ada error, tambahkan ke daftar
                    kodeItems.push(kodeProduct);
                    $('#code_item').val("").focus();       
                    let itemCount = $('#savedItems tr').length + 1; 
                    $('#savedItems').append(`
                        <tr>
                            <td>${itemCount}</td>
                            <td>${kodeProduct}</td>
                            <td>${response.name_item}</td>
                        </tr>
                    `);
                } else {
                    // Tampilkan pesan jika item tidak ditemukan
                    Notiflix.Report.failure(
                        'Warning', // Title
                        'Item tidak ditemukan untuk kode: ' + kodeProduct,
                        'Back'
                    );
                    $('#code_item').val("").focus();
                    return;
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data item.');
            }
        });
    } else {
        // Tampilkan pesan jika kode kosong
        Notiflix.Report.warning(
            'Warning', // Title
            'Silakan masukkan item kode yang valid',
            'Back'
        );
        $('#code_item').val("").focus();
        return;
    }
}


     // NIK FUNCTION
     function processScanned(numberIdentityEmploye) {
            if(numberIdentityEmploye !== ""){
                $.ajax({
                  url: '/Homes/' + numberIdentityEmploye,
                    type: 'GET', 
                    success: function(response) {
                        if (response.success) {
                            nikEmploye.push(numberIdentityEmploye);
                            $('#number_identity_employe').val("").focus();
                            $('#name_borrow').val(`${response.first_name} ${response.last_name}`);
                            $('#division').val(`${response.divisi_name}`);
                        } else {
                          Notiflix.Report.failure(
                          'Warning',
                          'tidak ditemukan untuk NIK: ' + numberIdentityEmploye,
                          'Back',
                      );
                        $('#number_identity_employe').val("").focus();
                         return;
                        }
                    },
                    error: function() {
                      alert('Terjadi kesalahan saat mengambil data item.');
                    }
                });
            } else {
                Notiflix.Report.warning(
                          'Warning',
                          'Silakan masukkan NIK yang valid', 
                          'Back',
                      );
                        $('#number_identity_employe').val("").focus();
                         return;
      
            }
        }

  $('#code_item').on('keypress', function(e) {
        if (e.which === 13) { 
            let kodeProduct = $(this).val();
            processScannedCode(kodeProduct);
        }
    });

    $('#number_identity_employe').on('keyup', function(e){
            let tex = $(this).val();
            if(e.keyCode === 13 && tex !== "") {
                processScanned(tex);
                e.preventDefault();
            }
        });


// function save
$('#processBorrow').click(function() {

  if (!kodeItems.length) {
        Notiflix.Report.warning(
            'Warning', 
            'Tidak ada item yang dipindai. Harap pindai setidaknya satu kode item!', 
            'Back'
        );
        return; 
    }

    
    if (!nikEmploye.length) {
        Notiflix.Report.warning(
            'Warning', 
            'NIK belum dipindai. Harap masukkan NIK terlebih dahulu!', 
            'Back'
        );
        return; 
    }

    

    // Kirim data NIK dan kode item ke server melalui AJAX
    $.ajax({
        url: '/save-borrow',
        type: 'POST',
        data: {
            nikEmploye: nikEmploye[0],  // Ambil NIK pertama yang dipindai
            kodeItems: kodeItems,       // Kirim seluruh kode item yang sudah dipindai
            _token: $('meta[name="csrf-token"]').attr('content') // Kirim token CSRF
        },
        success: function(response) {
            if (response.success) {
                Notiflix.Report.success(
                    'Success',
                    'Data berhasil disimpan!',
                    'OK'
                );
                // Reset data setelah berhasil disimpan
                nikEmploye = [];
                kodeItems = [];
                $('#name_borrow').val('');
                $('#division').val('');
                $('#savedItems').empty();
            } else {
                Notiflix.Report.failure(
                    'Error',
                    'Terjadi kesalahan dalam penyimpanan data.',
                    'Back'
                );
            }
        },
        error: function() {
            Notiflix.Report.failure(
                'Error',
                'Terjadi kesalahan dalam penyimpanan data.',
                'Back'
            );
        }
    });
});

// END
});
</script>




@endsection