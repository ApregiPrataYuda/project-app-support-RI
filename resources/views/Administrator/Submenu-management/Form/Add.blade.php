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
<li class="breadcrumb-item"><a href="{{ route('submenu.view') }}">Kembali</a></li>
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
                        <form action="{{route('store.submenu')}}" method="post" enctype="multipart/form-data">
                        @csrf

                           
                            <div class="form-group">
                                <label for="title" class="text-capitalize">Title*</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter Title">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="text-capitalize">Menu*</label>
                                <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">-Pilih-</option>
                                @foreach ($menu as $mn)
                                <option class="text-uppercase" value="{{ $mn->id }}" 
                                {{ old('menu') == $mn->id ? 'selected' : '' }}>
                                    {{ $mn->menu }}
                                </option>
                                @endforeach
                                </select>
                                @error('menu_id')
                                            <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <small id="statusHelp" class="form-text text-muted">
                                    Please select the Menu of the item.
                                </small>
                                </div>


                                <div class="form-group">
                                <label for="url" class="text-capitalize">URL*</label>
                                <input type="text" class="form-control" id="url" name="url" value="{{old('url')}}" placeholder="Enter URL">
                                @error('url')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>


                                <div class="form-group">
                                <label for="icon" class="text-capitalize">Icon*</label>
                                <input type="text" class="form-control" id="icon" name="icon" value="{{old('icon')}}" placeholder="Enter icon">
                                @error('icon')
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
                                <small id="statusHelp" class="form-text text-muted">
                                    Please select the status of the item.
                                </small>
                                </div>


                                <div class="form-group">
                                <label for="noted" class="text-capitalize">Catatan*</label>
                                <textarea name="noted" id="noted" class="form-control"></textarea>
                                @error('noted')
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
<script type="text/javascript">
        // assetCode
        $(document).ready(function() {
            $("#menu_id").select2({
              placeholder: "SELECT A MENU",
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
      