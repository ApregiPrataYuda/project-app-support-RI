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
                                <label for="title" class="text-capitalize">Title Announcement*</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter title">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="text-capitalize">Description Announcement*</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}" placeholder="Enter description">
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="file" class="text-capitalize">Upload File (PDF)*</label>
                                <input type="file" class="form-control" id="file" name="file" value="{{old('file')}}">
                                @error('file')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                           
                            <div class="form-group">
                                <label for="status" class="text-capitalize">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">SELECT</option>
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                </select>
                            </div>

                            {{-- <div class="form-group" id="divisions-group" style="display: none;">
                                <label for="divisions">Select Divisions (Only for Private):</label>
                                <select name="divisions[]" id="divisions" class="form-control" multiple>
                                    <option value="IT">IT</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Purchasing">Purchasing</option>
                                    <option value="Accounting">Accounting</option>
                                    <!-- Tambahkan divisi lain sesuai kebutuhan -->
                                </select>
                            </div> --}}

                            <div class="form-group" id="divisions-group" style="display: none;">
                                <label for="divisions">Select Divisions (Only for Private):</label>
                                <select name="divisions[]" id="divisions" class="form-control" multiple>
                                    @foreach ($divisi as $divs)
                                    <option class="text-uppercase" value="{{ $divs->divisi_id }}" 
                                    {{ old('divisions') == $divs->divisi_id ? 'selected' : '' }}>
                                        {{ $divs->divisi_name }} 
                                    </option>
                                    @endforeach
                                    </select> 
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
<script>
    // Tampilkan pilihan divisi hanya jika status 'private'
    $('#status').on('change', function() {
        var status = $(this).val();
        var divisionsGroup = $('#divisions-group');
        if (status === 'private') {
            divisionsGroup.show();
        } else {
            divisionsGroup.hide();
        }
    });

    
          $(document).ready(function() {
    $('#divisions').select2({
               placeholder: "CHOSE MULTIPLE SELECT",
               allowClear: true,
               theme: 'bootstrap4',
            //    dropdownParent: $('#modalloan')
    });
   });
</script>


@endsection
      