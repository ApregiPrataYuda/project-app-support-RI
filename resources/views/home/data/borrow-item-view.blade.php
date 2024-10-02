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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#returnsModal">
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
<div class="modal fade" id="returnsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Return Item Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
    <div class="row">
    <!-- Card 1 -->
    <div class="col-md-3 mr-2 mb-2">
        <!-- <div class="card" style="width: 18rem;">
            <div class="card-header"> -->
            <input type="text" class="form-control focus-primary" id="codeItemReturn" placeholder="scan Your QR-CODE">
            <!-- </div>
        </div> -->
    </div>

    <div class="col-md-12">
    <h2 class="card-title font-weight-bolder">List of items to be borrowed</h2>
    <div class="card mb-5" style="width: 100%;">
        <div class="card-body">
            <table class="table table-bordered" id="accommodateItemsTable">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Name employe Borrow & Division</th>
                        <th>Name Item</th>
                        <th>Item have divisions</th>
                        <th>Status</th>
                        <th>Last status</th>
                        <th>From Time(date borrow)</th>
                        <th>End Time(date borrow)</th>
                    </tr>
                </thead>
                <tbody id="accommodateItems">
                    <!-- Daftar kode yang disimpan akan muncul di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> 
        <button type="submit" id="returnBorrows" name="return" class="btn btn-outline-primary ml-2"> <i class="fa fa-reply" aria-hidden="true"></i> Return </button>
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
     
        if (kodeItems.indexOf(kodeProduct) !== -1) {
            Notiflix.Report.warning(
                'Warning', // Title
                'Kode item sudah Scan sebelumnya: ' + kodeProduct,
                'Back'
            );
            $('#code_item').val("").focus();
            return;
        }

        
        $.ajax({
            url: '/Home/' + kodeProduct,
            type: 'GET',
            success: function(response) {
                if (response.success) {

                    if (response.status_borrows == 1) {
                        Notiflix.Report.failure(
                            'Warning', // Title
                            'sedang dipinjam Anda Tidak Bisa Melakukan Peminjaman untuk kode Item: ' + kodeProduct,
                            'Back'
                        );
                        $('#code_item').val("").focus();
                        return;
                    } 

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



<!-- return code -->
<script>
$(document).ready(function(){ 
    let kodeItems = [];
    $('#codeItemReturn').val("").focus();
    function processScannedReturn(kodeItemReturns) {
    if (kodeItemReturns !== "") {
     
        if (kodeItems.indexOf(kodeItemReturns) !== -1) {
                Notiflix.Report.warning(
                    'Warning', // Title
                    'Kode item sudah Scan sebelumnya: ' + kodeItemReturns,
                    'Back',
                    function() {
                        setTimeout(function() {
                            $("#codeItemReturn").val("").focus();
                        }, 50);
                    }
                );
                return;
            }
        $.ajax({
            url: '/Home-return-item/' + kodeItemReturns,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    kodeItems.push(kodeItemReturns);
                    $('#codeItemReturn').val("").focus();       
                    let itemCount = $('#accommodateItems tr').length + 1; 
                    $('#accommodateItems').append(`
                        <tr>
                            <td>${itemCount}</td>
                            <td class="text-uppercase">${response.first_name} ${response.last_name} - ${response.employee_divisi_name}</td>
                            <td>${response.name_item}</td>
                            <td>${response.tools_divisi_name}</td>
                            <td>${response.status}</td>
                            <td>${response.last_status}</td>
                            <td>${response.date_borrow}</td>
                            <td>${response.return_date}</td>
                        </tr>
                    `);
                } else {
                   
                    Notiflix.Report.failure(
                        'Warning', // Title
                        'Item tidak ditemukan atau sedang tidak di pinjam',
                        'Back',
                        function() {
                        setTimeout(function() {
                            $("#codeItemReturn").val("").focus();
                        }, 50);
                     }
                    );
                    return;
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data item.');
            }
        });
    } else {
        Notiflix.Report.warning(
            'Warning', // Title
            'Silakan masukkan item kode yang valid',
            'Back'
        );
        $('#codeItemReturn').val("").focus();
        return;
    }
}


//process return
$('#returnBorrows').click(function() {
if (!kodeItems.length) {
      Notiflix.Report.warning(
          'Warning', 
          'Tidak ada item yang akan di return!', 
          'Back'
      );
      return; 
  }

  $.ajax({
        url: '/Return-item-borrow',
        type: 'POST',
        data: {
            kodeItems: kodeItems,
            _token: '{{ csrf_token() }}', // Kirim token CSRF
        },
        success: function(response) {
            if (response.success) {
                Notiflix.Report.success(
                    'Success',
                    'Item Success Dikembalikan!',
                    'OK'
                );
                // Reset data setelah berhasil disimpan
                kodeItems = [];
                $('#codeItemReturn').val('').focus();
                $('#accommodateItems').empty();

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


   //scan
    $('#codeItemReturn').on('keyup', function(e){
            let tex = $(this).val();
            if(e.keyCode === 13 && tex !== "") {
                processScannedReturn(tex);
                e.preventDefault();
            }
        });

        
})
</script>



<!-- auto focus -->
<script>
$(document).ready(function() {
    // // Ketika modal ditampilkan
    $('#returnsModal').on('shown.bs.modal', function () {
        // Fokus ke inputan
        $('#codeItemReturn').focus();
    });

    $("#codeItemReturn").val("").focus();
                    $("#returnsModal").click(function(){
                        $("#codeItemReturn").val("").focus();
                    })
});
</script>



@endsection