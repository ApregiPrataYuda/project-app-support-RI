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
            <form>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <label for="tanggal_dipinjam"><span class="text-uppercase"> Date *</span> </label>
                        <input type="date" name="tanggal_dipinjam" id="tanggal_dipinjam" class="form-control" value="<?= date('Y-m-d')?>" disabled>
                       </div>
                    </div>
                   
                    <div class="row justify-content-center">
                    <div class="col-md-6 mt-2">
                        <label for="msbrg"><span class="text-uppercase"> Code Item *</span> </label>
                        <select name="code_item[]" id="msbrg" class="form-control">
                         <option value="">-via QR code-</option>
                          
                        </select> 
                       </div>
                        <p id="p" class="font-italic text-danger"></p>
                    </div>

                    <div class="row justify-content-center">
                      <div class="col-md-6 mt-2">
                      <label for="name_Item"><span class="text-uppercase"> Name Item *</span> </label>
                      <input type="text" class="form-control" value="" id="name_Item" name="name_Item" id="name_Item" placeholder="" readonly>
                      </div>
                      </div>

                    <div class="row justify-content-center">
                      <div class="col-md-6 mt-2">
                      <label for="nik"><span class="text-uppercase"> Nik *</span> </label>
                      <input type="text" class="form-control" value="" id="nik" name="nik" id="nik" placeholder="via QR nametag">
                      </div>
                      </div>

                    <div class="row justify-content-center">
                    <div class="col-md-6 mt-2">
                    <label for="nama_peminjam"><span class="text-uppercase"> tool user name*</span> </label>
                    <input type="text" class="form-control" value="" id="nama_peminjam" name="nama_peminjam" id="nama_peminjam" placeholder="Name Peminjam..." readonly>
                    </div>
                    </div>

                    <div class="row justify-content-center">
                      <div class="col-md-6 mt-2">
                      <label for="nama_peminjam"><span class="text-uppercase"> Location (Division)*</span> </label>
                      <input type="text" class="form-control" value="" id="nama_peminjam" name="nama_peminjam" id="nama_peminjam" placeholder="Name Peminjam..." readonly>
                      </div>
                      </div>

                    <div class="row justify-content-center">
                    <div class="col-md-6 mt-2 mb-2">
                        <label for="description"><span class="text-uppercase"> statement *</span> </label>
                       <textarea name="description" id="description" cols="10" rows="2" class="form-control" placeholder="dengan ini saya menyatakan bertanggung jawab atas tools yang saya gunakan" readonly></textarea>
                    </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </form>
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
@endsection