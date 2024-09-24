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
<div class="card-header" style="background-color:RGB(40, 178, 170);">
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
                        <form action="{{route('store.paket')}}" method="post" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name(Pemilik Paket)</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="text-capitalize">Kurir*</label>
                                <select name="kurir" id="kurir" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="JNE Express" {{ old('kurir') == 'JNE Express' ? 'selected' : '' }}>JNE Express</option>
                                <option value="J&T Express" {{ old('kurir') == 'J&T Express' ? 'selected' : '' }}>J&T Express</option>
                                <option value="Pos Indonesia" {{ old('kurir') == 'Pos Indonesia' ? 'selected' : '' }}>Pos Indonesia</option>
                                <option value="TIKI" {{ old('kurir') == 'TIKI' ? 'selected' : '' }}>TIKI</option>
                                <option value="Sicepat" {{ old('kurir') == 'Sicepat' ? 'selected' : '' }}>Sicepat</option>
                                <option value="Ninja Xpress" {{ old('kurir') == 'Ninja Xpress' ? 'selected' : '' }}>Ninja Xpress</option>
                                <option value="Go-Send" {{ old('kurir') == 'Go-Send' ? 'selected' : '' }}>Go-Send</option>
                                <option value="Grab Express" {{ old('kurir') == 'Grab Express' ? 'selected' : '' }}>Grab Express</option>
                                <option value="Others" {{ old('kurir') == 'Others' ? 'selected' : '' }}>Others</option>
                                </select>
                                @error('kurir')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>

    

                            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-outline-warning btn-sm"><i class="fa fa-undo"></i> Reset</button>
                        </form>
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
    // assetCode
    $(document).ready(function() {
        $("#kurir").select2({
           placeholder: "SELECT A KURIR",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });
</script>

@endsection
      