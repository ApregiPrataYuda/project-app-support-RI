@extends('layouts.app')
@section('content')
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>{{  $title }}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Kembali</a></li>
<li class="breadcrumb-item active">{{  $title }}</li>
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
<h3 class="card-title">{{  $title }}</h3>
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


<form action="{{ route('store.user') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="text-capitalize">Employe Name - Nik*</label>
<select name="id_employee" id="id_employee"  class="form-control">
<option value="">-Pilih-</option>
@foreach ($employees as $emp)
        <option class="text-uppercase" value="{{ $emp->id_employee }}" 
        {{ old('first_name') == $emp->id_employee ? 'selected' : '' }}>
            {{ $emp->first_name }}  {{ $emp->last_name }}  {{ $emp->nik }}
        </option>
@endforeach
</select>
@error('id_employee')
            <div class="text-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-group"> 
<label class="text-capitalize">email</label>
<input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
@error('email')
            <div class="text-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label class="text-capitalize">Role*</label>
<select name="role" id="role" class="form-control">
<option value="">-Pilih-</option>
@foreach ($roles as $role)
        <option class="text-uppercase" value="{{ $role->role_id }}" 
        {{ old('role') == $role->role_id ? 'selected' : '' }}>
            {{ $role->role }} 
        </option>
@endforeach
</select>
@error('role')
            <div class="text-danger">{{ $message }}</div>
@enderror
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="text-capitalize">username*</label>
<input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
@error('username')
            <div class="text-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label class="text-capitalize">Password*</label>
<input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}">
@error('password')
            <div class="text-danger">{{ $message }}</div>
@enderror
</div>


<div class="form-group">
<label class="text-capitalize">Password Konfirmasi*</label>
<input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
@error('konfirmasi_password')
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

</div>

</div>
<div class="row mr-0">
    <button type="reset" class="btn btn-outline-warning ml-auto"> <i class="fa fa-undo"></i> Reset</button>
    <button type="submit" class="btn btn-outline-primary ml-2"> <i class="fa fa-save"></i> Save</button>
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
            $("#role").select2({
              placeholder: "SELECT A ROLE",
               allowClear: true,
               theme: 'bootstrap4',
            });

            $("#id_employee").select2({
              placeholder: "SELECT A EMPLOYE",
               allowClear: true,
               theme: 'bootstrap4',
            });

            $("#status").select2({
              placeholder: "SELECT A STATUS",
               allowClear: true,
               theme: 'bootstrap4',
            });
        });
</script>
@endsection
      