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
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Back</a></li>
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
<form action="{{ route('update.user', $row->user_id) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="text-capitalize">Employe Name - Nik*</label>
<select name="id_employee" id="id_employee"  class="form-control">
<option value="">-Pilih-</option>
@foreach ($employees as $emp)
        <option class="text-uppercase" value="{{ $emp->id_employee }}" {{ old('id_employee', $row->id_employee ?? '') == $emp->id_employee ? 'selected' : '' }}>
            {{ $emp->name }}   {{ $emp->badgenumber }}
        </option>
@endforeach
</select>
@error('id_employee')
            <div class="text-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-group"> 
<label class="text-capitalize">email</label>
<input type="text" class="form-control" name="email" id="email" value="{{($row->email)}}">
@error('email')
<div class="text-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
    <label class="text-capitalize">Role</label>
    <select name="role_id" id="roleId" class="form-control">
        <option value="">-Pilih-</option>
        @foreach ($roles as $role)
            <option value="{{ $role->role_id }}" {{ old('role_id', $row->role_id ?? '') == $role->role_id ? 'selected' : '' }}>
                {{ $role->role }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>




<div class="form-group">
         <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                        id="imgPreview"
                        src="{{ asset('/assets/backend/dist/img/avatar/' . $row->image) }}"
                         alt="prev image" 
                         alt="Avatar" 
                         class="rounded-circle"
                         style="width: 100px;"
                        />
                      </div>
                        <div class="mt-2">
                        <input class="form-control" type="file"  type="file" name="image" 
                        class="custom-file-input" id="image"  id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif" />
                        <input type="hidden" name="imageold" value="{{($row->image)}}" class="form-control mt-2" id="coversold">
                       </div><small class="badge badge-pill badge-warning text-muted font-italic">Rekomendasi image width 100px - Hight 100px - ext(jpg or png)</small>
                       @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <script>
                      $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                      });
                     </script>
    </div> 
</div>

<div class="col-md-6">
<div class="form-group">
<label class="text-capitalize">username</label>
<input type="text" class="form-control" name="username" id="username" value="{{($row->username)}}">
@error('username')
<div class="text-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label class="text-capitalize">Password</label>
<input type="password" class="form-control" name="password" id="password">
<small class="badge badge-pill badge-warning text-muted font-italic">Biarkan Kosong Jika password tidak Di ubah</small>
@error('password')
<div class="text-danger">{{ $message }}</div>
@enderror
</div>


<div class="form-group">
<label class="text-capitalize">Password Konfirmasi</label>
<input type="password" class="form-control" name="passconf" id="passconf">
<small class="badge badge-pill badge-warning text-muted font-italic">Biarkan Kosong Jika password tidak Di ubah</small>
@error('passconf')
<div class="text-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
    <label class="text-capitalize">Status</label>
    <select name="status" id="status" class="form-control">
        <option value="">-Pilih-</option>
        <option value="1" {{ old('status', $row->is_active ?? '') == 1 ? 'selected' : '' }}>AKTIF</option>
        <option value="0" {{ old('status', $row->is_active ?? '') == 0 ? 'selected' : '' }}>NONAKTIF</option>
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

</div>

</div>
<div class="row mr-0">
    <button type="reset" class="btn btn-outline-warning ml-auto"> <i class="fa fa-undo"></i> Reset</button>
    <button type="submit" class="btn btn-outline-secondary ml-2"> <i class="fa fa-save"></i> Update</button>
<!-- <button type="button" class="btn btn-warning">Primary</button> -->
</div>
</div>
</form>


<div class="card-footer">
&copy; <?= date('Y') ?> --------
</div>
</div>
        <!-- /.card -->
  </section>
<!--start view for end -->


<script type="text/javascript">
        // assetCode
        $(document).ready(function() {
            $("#roleId").select2({
              placeholder: "SELECT A ROLE",
               allowClear: true,
               theme: 'bootstrap4',
            });

            $("#status").select2({
              placeholder: "SELECT A STATUS",
               allowClear: true,
               theme: 'bootstrap4',
            });

            $("#id_employee").select2({
              placeholder: "SELECT A EMPLOYE",
               allowClear: true,
               theme: 'bootstrap4',
            });
        });
</script>

<script>
            $(document).ready(() => {
                $("#image").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview")
                              .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
</script>      


@endsection