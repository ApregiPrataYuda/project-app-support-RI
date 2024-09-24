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
<li class="breadcrumb-item"><a href="{{route('menu.view')}}">Kembali</a></li>
<li class="breadcrumb-item active">{{$title}}</li>
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
<div class="container mt-0">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- <div class="card"> -->
                    
                    <div class="card-body">
                        <form action="{{route('store.menu')}}" method="post" enctype="multipart/form-data">
                        @csrf

                           
                            <div class="form-group">
                                <label for="menu" class="text-capitalize">Name Menu</label>
                                <input type="text" class="form-control" id="menu" name="menu" value="{{old('menu')}}" placeholder="Enter name menu">
                                @error('menu')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-outline-warning btn-sm"><i class="fa fa-undo"></i> Reset</button>
                        </form>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>




</div>


<div class="card-footer">
&copy; <?= date('Y') ?> ---
</div>
</div>
        <!-- /.card -->
  </section>
<!--start view for end -->

@endsection
      