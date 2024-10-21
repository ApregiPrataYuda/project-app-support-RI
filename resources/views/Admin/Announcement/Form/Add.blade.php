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
                        <form action="{{route('store.announce')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="title" class="text-capitalize">Title Announcement*</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter title">
                                @error('title')
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
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


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

                            <div class="form-group">
                                <label for="description" class="text-capitalize">Description Announcement*</label>
                                <textarea class="form-control" name="description" id="description" cols="10" rows="3">{{old('description')}}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                                <label for="file" class="text-capitalize">Upload File (PDF)*</label>
                                <input type="file" class="form-control" id="file" name="file" value="{{old('file')}}" accept="application/pdf">
                                @error('file')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            
                            <!-- Tempat untuk menampilkan preview PDF -->
                            {{-- <label for="preview" class="text-capitalize">PDF Preview Here:</label>
                            <div id="pdf-preview" class="mt-3" style="display: none;"> --}}
                                {{-- <label for="preview" class="text-capitalize">PDF Preview:</label> --}}
                                {{-- <embed id="preview" src="" type="application/pdf" width="100%" height="500px" />
                            </div> --}}

                            <div class="form-group">
                                <label for="file" class="text-capitalize font-weight-bold">Upload File (PDF)*</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file" value="{{ old('file') }}" accept="application/pdf">
                                    <label class="custom-file-label" for="file">Choose PDF file</label>
                                </div>
                                @error('file')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Tempat untuk menampilkan preview PDF -->
                            <div id="pdf-preview" class="mt-4" style="display: none;">
                                <label for="preview" class="text-capitalize font-weight-bold">PDF Preview:</label>
                                <div class="border p-3 rounded" style="background-color: #f8f9fa;">
                                    <embed id="preview" src="" type="application/pdf" width="100%" height="500px" class="rounded" />
                                </div>
                            </div>
                            

                           
                        
                            <div class="row mt-4 justify-content-end">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button type="reset" class="btn btn-outline-warning btn-sm">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </div>
                            
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

   $(document).ready(function() {
    $('#file').on('change', function(e) {
        var file = e.target.files[0];

        // Validasi jika file yang dipilih bukan PDF
        if (file && file.type === 'application/pdf') {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Tampilkan PDF preview di elemen <embed>
                $('#preview').attr('src', e.target.result);
                $('#pdf-preview').show();
            };

            reader.readAsDataURL(file); // Membaca file sebagai URL Data
        } else {
            $('#pdf-preview').hide(); // Sembunyikan preview jika bukan PDF
            alert("Please upload a valid PDF file.");
        }
    });
});

</script>


@endsection
      