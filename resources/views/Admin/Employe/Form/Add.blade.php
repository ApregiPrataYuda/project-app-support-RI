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
<li class="breadcrumb-item"><a href="{{route('Admin.paket')}}">Kembali</a></li>
<li class="breadcrumb-item active"><?= $title ?></li>
</ol>
</div>
</div>
</div>
</section>

<!--start view for user -->
<section class="content">
        <!-- Default box -->
<div class="card">
<div class="card-header bg-secondary">
<h3 class="card-title"><?= $title ?></h3>
<div class="card-tools">
<button type="button" class="btn btn-tool" data-card-widget="collapse">
<i class="fas fa-minus"></i>
</button>
<button type="button" class="btn btn-tool" data-card-widget="remove">
<i class="fas fa-times"></i>
</button>
</div>
</div>


<div class="card-body">
<div class="container mt-0">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- <div class="card"> -->
                    
                    <div class="card-body">
                        @csrf

                            <div class="form-group">
                                <label for="nikEmployes" class="text-capitalize">Nik*</label>
                                <input type="text" class="form-control" id="nikEmployes" name="nikEmployes" value="{{old('nikEmployes')}}" placeholder="Scan Your Badge">
                                @error('nikEmployes')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="first_name" class="text-capitalize">First Name*</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}" placeholder="First Name">
                                @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="last_name" class="text-capitalize">Last Name <small>(opsional)</small></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}" placeholder="Last Name">
                                @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="text-capitalize">Position*</label>
                                <select name="position" id="position" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="Admin" {{ old('position') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Operator" {{ old('position') == 'Operator' ? 'selected' : '' }}>Operator</option>
                                <option value="Staff" {{ old('position') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Assitant Suvervisor" {{ old('position') == 'Assitant Suvervisor' ? 'selected' : '' }}>Assitant Suvervisor</option>
                                <option value="Suvervisor" {{ old('position') == 'Suvervisor' ? 'selected' : '' }}>Suvervisor</option>
                                <option value="Chief" {{ old('position') == 'Chief' ? 'selected' : '' }}>Chief</option>
                                <option value="Assistan Manager" {{ old('position') == 'Assistan Manager' ? 'selected' : '' }}>Assistan Manager</option>
                                <option value="Manager" {{ old('position') == 'Manager' ? 'selected' : '' }}>Assistan Manager</option>
                                <option value="Other" {{ old('position') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('position')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>

                            <button type="submit"  id="save" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-outline-warning btn-sm"><i class="fa fa-undo"></i> Reset</button>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>


<div class="card-footer">
&copy; <?= date('Y') ?> Developer BY Apregi
</div>
</div>
        <!-- /.card -->
  </section>
<!--start view for end -->

<script type="text/javascript">


$('#nikEmployes').on('keyup', function(e){
            let tex = $(this).val();
            if(e.keyCode === 13 && tex !== "") {
                e.preventDefault();
            }
});

    // assetCode
    $(document).ready(function() {
        $("#position").select2({
           placeholder: "SELECT A POSITION",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });


    $('#save').click(function() {
    // Ambil nilai dari elemen input
    let nikEmployes = $('#nikEmployes').val();
    let first_name = $('#first_name').val();
    let last_name = $('#last_name').val();
    let position = $('#position').val();
    console.log(nikEmployes);
    


    // Cek apakah semua input tidak kosong
    // if (kodeProduct !== "" && nameProduct !== "" && price !== "" && status_product !== "" && 
    //     idSubkategori !== "" && idUnit !== "" && idSupplier !== "" && expriedProduct !== "") {
        
        // Cek apakah kodeProduct sudah ada
        // $.ajax({
        //     url: '', // Ganti dengan URL yang sesuai untuk mengecek kode produk
        //     type: 'POST',
        //     data: { kodeProduct: kodeProduct },
        //     headers: {
        //                     "X-CSRF-TOKEN": ""
        //                 },
        //     success: function(response) {
        //         if (response.exists) {
        //             // Jika kodeProduct sudah ada, tampilkan pesan
        //             Swal.fire({
        //                 title: "Kode produk sudah ada!",
        //                 icon: "warning"
        //             });
        //             $('#kode_product').focus(); // Memfokuskan pada input kode produk

        //         } else {
                    // Jika kodeProduct tidak ada, lanjutkan proses penyimpanan
                    // var formData = new FormData();
                    // formData.append("kodeProduct", kodeProduct);
                    // formData.append("nameProduct", nameProduct);
                    // formData.append("price", price);
                    // formData.append("idUnit", idUnit);
                    // formData.append("idSupplier", idSupplier);
                    // formData.append("idSubkategori", idSubkategori);
                    // formData.append("expriedProduct", expriedProduct);
                    // formData.append("image", image); // Menambahkan file
                    // formData.append("noted", noted);
                    // formData.append("status_product", status_product);

                    // Melakukan permintaan AJAX untuk menyimpan data
                    // $.ajax({
                    //     url: '',
                    //     type: 'POST',
                    //     data: formData,
                    //     processData: false, // Penting untuk tidak memproses data
                    //     contentType: false, // Penting untuk tidak mengatur konten tipe
                    //     headers: {
                    //         "X-CSRF-TOKEN": ""
                    //     },
                    //     beforeSend: function() {
                    //         $('#message_info').html("Sedang memproses data, silahkan tunggu...");
                    //     },
                    //     success: function(response) {
                    //         // Tangani respons sukses
                    //         Swal.fire({
                    //             position: "top-center",
                    //             icon: "success",
                    //             title: "Data berhasil disimpan",
                    //             showConfirmButton: false,
                    //             timer: 1500
                    //         }).then(() => {
                                // Refresh halaman
    //                             location.reload();
    //                         });
    //                     },
    //                     error: function(jqXHR, textStatus, errorThrown) {
    //                         // Tangani kesalahan
    //                         Swal.fire({
    //                             title: "Terjadi kesalahan: " + errorThrown,
    //                             text: "Silakan coba lagi.",
    //                             icon: "error"
    //                         });
    //                         $('#kode_product').focus(); // Memfokuskan pada input kode produk
    //                     }
    //                 });
    //             }
    //         },
            
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             // Tangani kesalahan saat melakukan pengecekan
    //             Swal.fire({
    //                 title: "Terjadi kesalahan saat memeriksa kode produk: " + errorThrown,
    //                 icon: "error"
    //             });
    //             $('#kode_product').focus(); // Memfokuskan pada input kode produk
    //         }
    //     });
    // } else {
    //     // Jika ada input yang kosong
    //     Swal.fire({
    //         title: "Inputan Tidak boleh Kosong",
    //         icon: "warning"
    //     });
    //     $('#kode_product').focus(); // Memfokuskan pada input kode produk
    // }
});

            //end code process kirim data
              

</script>

@endsection
      