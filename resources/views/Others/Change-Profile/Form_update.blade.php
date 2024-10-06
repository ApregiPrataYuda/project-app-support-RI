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
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Kembali</a></li>
<li class="breadcrumb-item active">{{$title}}</li>
</ol>
</div>
</div>
</div>
</section>

<div class="alert alert-warning ml-2 mr-2" role="alert">
    <h4 class="alert-heading">announcement!</h4>
    <p class="mb-0">You can only change your email and profile photo.</p>
  </div>
 

<!--start view for user -->
<section class="content">
        <!-- Default box -->
<div class="card">
<div class="card-header">
<h3 class="card-title text-center">Form Change Your Profile</h3>
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
<form action="{{ route('update.profile', $iduser)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="d-flex justify-content-center">
    <div class="col-md-4">
        <div class="form-group"> 
        <label class="text-capitalize">email</label>
        <input type="text" class="form-control" name="email" id="email" value="{{($user->email)}}">
        <input type="hidden" class="form-control" value="{{$iduser}}" name="iduser" id="iduser">
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="col-md-4">
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
                        <div class="mt-2">
                        <input class="form-control" type="file" name="image" 
                        class="custom-file-input" id="image" accept="image/png, image/jpeg, image/jpg, image/gif" />
                        <input type="hidden" name="imageold" value="{{($user->image)}}" class="form-control" id="coversold">
                       </div><small class="badge badge-danger text-white text-muted font-italic">Recommended image width 100px - Hight 100px - ext(jpg or png)</small>
                       @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    <button type="reset" class="btn btn-outline-warning ml-auto"> <i class="fa fa-undo"></i> Reset</button>
    <button type="submit" class="btn btn-outline-secondary ml-2"> <i class="fa fa-save"></i> Update</button>
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
