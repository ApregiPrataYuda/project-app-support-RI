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
<!-- <li class="breadcrumb-item"><a href="">Kembali</a></li> -->
<li class="breadcrumb-item active">{{$title}}</li>
</ol>
</div>
</div>
</div>
</section>
<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>
<!--start view for user -->
<section class="content">
        <!-- Default box -->
<div class="card">
<div class="card-header">
<h3 class="card-title">Form {{$title}}</h3>
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
                        <form action="{{ route('Change.Password.Store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group">
                                <label for="password" class="text-capitalize">New Password*</label>
                                <input type="hidden" class="form-control" id="idUser" name="idUser" value="{{ $idUser }}" readonly>
                                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="New Password">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="konfirmasi_password" class="text-capitalize">Confirmation New Password*</label>
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Confirmation New Password">
                                @error('konfirmasi_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fa fa-save"></i> Change</button>
                            <button type="reset" class="btn btn-outline-warning btn-sm"><i class="fa fa-undo"></i> Reset</button>
                        </form>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>




</div>


<div class="card-footer">
PT RINNAI Indonesia&copy; {{ format_date_indonesia_old(date('Y-m-d'))  }}
</div>
</div>
        <!-- /.card -->
  </section>
<!--start view for end -->

@endsection
      