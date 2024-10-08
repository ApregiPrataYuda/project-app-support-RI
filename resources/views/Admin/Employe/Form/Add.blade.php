@extends('layouts.app')
@section('content')


<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>{{ $title }}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="{{route('Admin.Employe.List')}}">Back</a></li>
<li class="breadcrumb-item active">{{ $title }}</li>
</ol>
</div>
</div>
</div>
</section>

<div class="alert alert-warning ml-2 mr-2" role="alert">
    <h4 class="alert-heading">announcement!</h4>
    <p class="mb-0">Enter employee data according to your division, to prevent data confusion.</p>
  </div>

<!--start view for user -->
<section class="content">
        <!-- Default box -->
<div class="card">
<div class="card-header bg-secondary">
<h3 class="card-title">{{ $title }}</h3>
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
                        <!-- <div class="form-group">
                                <label for="scanbadge" class="text-capitalize">Scan ID card*</label>
                                <input type="text" class="form-control" id="scanbadge" name="scanbadge" value="{{old('scanbadge')}}" placeholder="Scan Your Badge">
                                @error('scanbadge')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>   -->

                            <div class="form-group">
                                <label for="nikEmployes" class="text-capitalize">Nik*</label>
                                <input type="text" class="form-control" id="nikEmployes" name="nikEmployes" value="{{old('nikEmployes')}}" placeholder="Scan Your Badge">
                                @error('nikEmployes')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name*</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="text-capitalize">Gender*</label>
                                <select name="gender" id="gender" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="Pria" {{ old('gender') == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Wanita" {{ old('gender') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                                </select>
                                @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>



                            <div class="form-group">
                                <label class="text-capitalize">title*</label>
                                <select name="title" id="title" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="EMPLOYEE" {{ old('title') == 'EMPLOYEE' ? 'selected' : '' }}>EMPLOYEE</option>
                                <option value="ASS. SUPERVISOR" {{ old('title') == 'ASS. SUPERVISOR' ? 'selected' : '' }}>ASS. SUPERVISOR</option>
                                <option value="SUPERVISOR" {{ old('title') == 'SUPERVISOR' ? 'selected' : '' }}>SUPERVISOR</option>
                                <option value="CHIEF" {{ old('title') == 'CHIEF' ? 'selected' : '' }}>CHIEF</option>
                                <option value="MANAGER" {{ old('title') == 'Assistan MANAGER' ? 'selected' : '' }}>MANAGER</option>
                                <option value="ASS. MANAGER" {{ old('title') == 'ASS. MANAGER' ? 'selected' : '' }}>ASS. MANAGER</option>
                                <option value="OTHER" {{ old('OTHER') == 'Other' ? 'selected' : '' }}>OTHER</option>
                                </select>
                                @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>


                                <div class="form-group">
                                <label class="text-capitalize">Status Employe*</label>
                                <select name="pager" id="pager" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="TETAP" {{ old('pager') == 'TETAP' ? 'selected' : '' }}>TETAP</option>
                                <option value="KONTRAK" {{ old('pager') == 'KONTRAK' ? 'selected' : '' }}>KONTRAK</option>
                                </select>
                                @error('pager')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>



                                <div class="form-group">
                                <label class="text-capitalize">SUB-Division*</label>
                                <select name="street" id="street" class="form-control">
                                <option value="">-Pilih-</option>
                                @foreach ($divisi as $divs)
                                        <option class="text-uppercase" value="{{ $divs->divisi_name }}" 
                                        {{ old('street') == $divs->divisi_name ? 'selected' : '' }}>
                                            {{ $divs->divisi_name }} 
                                        </option>
                                @endforeach
                                </select>
                                @error('street')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>

                                <div class="form-group">
                                <label class="text-capitalize">Status*</label>
                                <select name="status" id="status" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>AKTIF</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>NONAKTIF</option>
                                </select>
                                @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>

                            <button type="submit"  id="save" class="btn btn-outline-secondary btn-sm"><i class="fa fa-save"></i> Save</button>
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

    $(document).ready(function() {
        $("#title").select2({
           placeholder: "SELECT A TITLE",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });


    $(document).ready(function() {
        $("#gender").select2({
           placeholder: "SELECT A GENDER",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });

    $(document).ready(function() {
        $("#pager").select2({
           placeholder: "SELECT A STATUS EMPLOYE",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });

    $(document).ready(function() {
        $("#street").select2({
           placeholder: "SELECT A SUB-DIVISION",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });

    $('#save').click(function() {
    // Ambil nilai dari elemen input
    let nikEmployes = $('#nikEmployes').val();
    let name = $('#name').val();
    let title = $('#title').val();
    let pager = $('#pager').val();
    let street = $('#street').val();
    let status = $('#status').val();
    let gender = $('#gender').val();
  

    // Cek apakah semua input tidak kosong
    if (nikEmployes !== "" && name !== "" && title !== "" && pager !== "" && 
      street !== "" && status !== "" && gender !== "") {
        $.ajax({
            url: "{{ route('check.employe') }}",// Ganti dengan URL yang sesuai untuk mengecek kode produk
            type: 'POST',
            data: { nikEmployes: nikEmployes },
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') // Get CSRF token
            },
            success: function(response) {
                if (response.exists) {
                    // Jika kodeProduct sudah ada, tampilkan pesan
                    Swal.fire({
                        title: "Data Employe sudah ada!",
                        icon: "warning"
                    });
                    $('#nikEmployes').focus(); // Memfokuskan pada input kode produk
                } else {
                    // Jika NIK tidak ada, lanjutkan proses penyimpanan
                    var formData = new FormData();
                    formData.append("nikEmployes", nikEmployes);
                    formData.append("name", name);
                    formData.append("title", title);
                    formData.append("pager", pager);
                    formData.append("street", street);
                    formData.append("status", status);
                    formData.append("gender", gender);
                    // Melakukan permintaan AJAX untuk menyimpan data
                    $.ajax({
                        url: "{{ route('store.employe') }}",
                        type: 'POST',
                        data: formData,
                        processData: false, // Penting untuk tidak memproses data
                        contentType: false, // Penting untuk tidak mengatur konten tipe
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            $('#message_info').html("Sedang memproses data, silahkan tunggu...");
                        },
                        success: function(response) {
                            // Tangani respons sukses
                            Swal.fire({
                                title: "top-center",
                                icon: "success",
                                title: "Data berhasil disimpan",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Refresh halaman
                                location.reload();
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Tangani kesalahan
                            Swal.fire({
                                title: "Terjadi kesalahan: " + errorThrown,
                                text: "Silakan coba lagi.",
                                icon: "error"
                            });
                            $('#nikEmployes').focus(); // Memfokuskan pada input kode produk
                        }
                    });
                 
                }
            },
            
            error: function(jqXHR, textStatus, errorThrown) {
                // Tangani kesalahan saat melakukan pengecekan
                Swal.fire({
                    title: "Terjadi kesalahan saat memeriksa NIK: " + errorThrown,
                    icon: "error"
                });
                $('#nikEmployes').focus(); // Memfokuskan pada input kode produk
            }
        });


        }else{
            Swal.fire({
            title: "Opps?",
            text: "input cannot be blank?",
            icon: "question"
            });
        $('#nikEmployes').focus(); // Memfokuskan pada input kode produk
        }
    });

</script>

@endsection
      