@extends('layouts.app')
@section('content')

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>{{$title}}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item active">{{$title}}</li>
</ol>
</div>
</div>
</div>
</section>
<div id="flash" data-flash="{{ session('success') }}"></div>
<!--start view for user -->
<section class="content">
        <!-- Default box -->
<div class="card">
<div class="card-header">
<h3 class="card-title">{{$title}}</h3>
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
<form action="" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="text-capitalize">fullname</label>
<input type="text" class="form-control" value="{{($user->name)}}" name="fullname" id="fullname" disabled>
</div>

<div class="form-group"> 
<label class="text-capitalize">email</label>
<input type="text" class="form-control" name="email" id="email" value="{{($user->email)}}" disabled>
</div>

<div class="form-group">
    <label class="text-capitalize">Role Anda</label>
    <input type="text" class="form-control" value="{{($user->role)}}" name="Role" id="Role" disabled>
</div>


<div class="form-group">
         <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                        id="imgPreview"
                        src="{{ url('/avatar/' . $user->image) }}"
                         alt="prev image" 
                         alt="Avatar" 
                         class="rounded"
                         style="width: 100px;"
                        />
                      </div>
</div>
    </div> 
</div>

<div class="col-md-6">
<div class="form-group">
<label class="text-capitalize">username</label>
<input type="text" class="form-control" name="username" id="username" value="{{($user->username)}}" disabled>
</div>

<div class="form-group">
    <label class="text-capitalize">Status</label>
    <input type="text" class="form-control" name="is_active" id="is_active" value="{{(($user->is_active) == 1  ? 'Aktif' : 'NonAktif')}}" disabled>
</div>

</div>

</div>
<div class="row mr-0 mt-4 justify-content-end">
    <a href="{{ route('Change.Your.Profile')}}" class="btn btn-outline-secondary ml-2"> <i class="fa fa-arrow-right"></i> Change Profile</a>
</div>
</div>
</form>


<div class="card-footer">
    PT RINNAI Indonesia&copy; {{ format_date_indonesia_old(date('Y-m-d'))  }}
</div>
</div>
        <!-- /.card -->
  </section>
<!--start view for end -->     


@endsection