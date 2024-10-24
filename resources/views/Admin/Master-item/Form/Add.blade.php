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
<li class="breadcrumb-item"><a href="{{route('item.master')}}">Back</a></li>
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
                        <form action="{{route('store.item.master')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="name_item" class="text-capitalize">Name Item*</label>
                                <input type="text" class="form-control" id="name_item" name="name_item" value="{{old('name_item')}}" placeholder="Enter Name Item">
                                @error('name_item')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">ITEM FOR SUB-Division*</label>
                                <select name="sub_division" id="sub_division" class="form-control">
                                <option value="">-Pilih-</option>
                                @foreach ($subdivisi as $divs)
                                        <option class="text-uppercase" value="{{ $divs->id_subdivision }}" 
                                        {{ old('sub_division') == $divs->id_subdivision ? 'selected' : '' }}>
                                            {{ $divs->subdivision_name }} 
                                        </option>
                                @endforeach
                                </select>
                                @error('sub_division')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
 

                            <div class="form-group">
                                <label for="description" class="text-capitalize">Description Item</label>
                              <textarea name="description" id="description" class="form-control"></textarea>
                                @error('description')
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


<!-- <div class="card-footer">
&copy; <?= date('Y') ?> Developer BY Apregi
</div> -->
</div>
        <!-- /.card -->
  </section>
<!--start view for end -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#sub_division_id").select2({
           placeholder: "SELECT A SUB-DIVISION",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });

    $(document).ready(function() {
        $("#status").select2({
           placeholder: "SELECT A STATUS",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });
</script>


@endsection
      