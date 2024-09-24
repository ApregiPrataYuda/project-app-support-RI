@extends('frontend.app')
@section('content')

<div class="content-wrapper">
<div class="content-header">
<div class="container">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0"> <small> {{$title}}</small></h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
{{-- <li class="breadcrumb-item active">{{$title}}</li> --}}
</ol>
</div>
</div>
</div>
</div>


<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>

<div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card mb-2">
            <div class="card-header bg-secondary text-white">
              List Announcement <i class="fa fa-volume-up" aria-hidden="true"></i>
            </div>
            <div class="card-body">
              <!-- Konten card di sini -->

              <div class="table-responsive">
                <table class="table table-bordered" id="paketTables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:6%">No</th>
                            <th>Date Release</th>
                            <th>Title</th>
                            <th>status Announce</th>
                            <th>Divisi Created Announce</th>
                            <th>User Created Announce</th>
                            <th>Description</th>
                            <th>File(pdf)</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td>1</td>
                        <td>10 May 2029 </td>
                        <td>Pengumuman Libur Panjang</td>
                        <td>Public(penting)</td>
                        <td>HRGA</td>
                        <td>Elons Mark</td>
                        <td>Please Admin share this isi information</td>
                        <td>Announce.PDF
                            <button class="btn btn-sm btn-danger">Preview <i class="fa fa-file-pdf"></i></button>
                        </td>
                       </tr>
                    </tbody>
                </table>
        </div>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  

  

@endsection