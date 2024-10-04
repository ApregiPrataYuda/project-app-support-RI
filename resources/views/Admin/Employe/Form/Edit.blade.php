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
<li class="breadcrumb-item"><a href="{{route('Admin.paket')}}">Back</a></li>
<li class="breadcrumb-item active">{{ $title }}</li>
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
                    <form action="{{ route('update.employe', $basicid ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                           


                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name*</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $emp->name }}" placeholder="Name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">Gender*</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">-Pilih-</option>
                                    <option value="Pria" {{ old('gender', $emp->gender ?? '') == 'Pria' ? 'selected' : '' }}>Pria</option>
                                    <option value="Wanita" {{ old('gender', $emp->gender ?? '') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label class="text-capitalize">Title*</label>
                                <select name="title" id="title" class="form-control">
                                    <option value="">-Pilih-</option>
                                    <option value="EMPLOYEE" {{ old('title', $emp->title ?? '') == 'EMPLOYEE' ? 'selected' : '' }}>EMPLOYEE</option>
                                    <option value="ASS. SUPERVISOR" {{ old('title', $emp->title ?? '') == 'ASS. SUPERVISOR' ? 'selected' : '' }}>ASS. SUPERVISOR</option>
                                    <option value="SUPERVISOR" {{ old('title', $emp->title ?? '') == 'SUPERVISOR' ? 'selected' : '' }}>SUPERVISOR</option>
                                    <option value="CHIEF" {{ old('title', $emp->title ?? '') == 'CHIEF' ? 'selected' : '' }}>CHIEF</option>
                                    <option value="MANAGER" {{ old('title', $emp->title ?? '') == 'MANAGER' ? 'selected' : '' }}>MANAGER</option>
                                    <option value="ASS. MANAGER" {{ old('title', $emp->title ?? '') == 'ASS. MANAGER' ? 'selected' : '' }}>ASS. MANAGER</option>
                                    <option value="OTHER" {{ old('title', $emp->title ?? '') == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                                </select>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label class="text-capitalize">Status Employee*</label>
                                <select name="pager" id="pager" class="form-control">
                                    <option value="">-Pilih-</option>
                                    <option value="TETAP" {{ old('pager', $emp->pager ?? '') == 'TETAP' ? 'selected' : '' }}>TETAP</option>
                                    <option value="KONTRAK" {{ old('pager', $emp->pager ?? '') == 'KONTRAK' ? 'selected' : '' }}>KONTRAK</option>
                                </select>
                                @error('pager')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label class="text-capitalize">Division Street*</label>
                                <select name="street" id="street" class="form-control">
                                    <option value="">-Pilih-</option>
                                    @foreach ($divisi as $divs)
                                        <option class="text-uppercase" value="{{ $divs->divisi_name }}" 
                                            {{ old('street', $emp->street ?? '') == $divs->divisi_name ? 'selected' : '' }}>
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
                                <option value="1" {{ old('status', $emp->status ?? '') == '1' ? 'selected' : '' }}>AKTIF</option>
                                <option value="0" {{ old('status', $emp->status ?? '') == '0' ? 'selected' : '' }}>NONAKTIF</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                            <button type="submit"  id="update" class="btn btn-outline-secondary btn-sm"><i class="fa fa-save"></i> update</button>
                            <button type="reset" class="btn btn-outline-warning btn-sm"><i class="fa fa-undo"></i> Reset</button>
                    </div>
                    </form>
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
        $("#pager").select2({
           placeholder: "SELECT A STATUS EMPLOYE",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });

    $(document).ready(function() {
        $("#street").select2({
           placeholder: "SELECT A DIVISION STREET",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });


</script>

@endsection
      