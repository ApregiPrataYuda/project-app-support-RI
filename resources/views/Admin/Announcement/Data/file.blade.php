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
<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
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
<a href="{{route('add.announcement')}}" class="btn btn-outline-secondary btn-sm mb-2"><i class="fa fa-plus"></i> Add Announcement <i class="fa fa-bullhorn"></i></a>
</section>
<section class="content">
    <div class="row">
      <!-- Card Kiri -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-secondary">
              <span>list of announcement that you created</span>
             
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="itemBorrowTableLeft">
              <thead>
                <tr>
                  <th style="width: 4%;">No</th>
                  <th>Date Release</th>
                  <th>Title</th>
                  <th>status Announce</th>
                  <th>Divisi Created Announce</th>
                  <th>User Created Announce</th>
                  <th>Description</th>
                  <th>File(pdf)</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Isi tabel card kiri -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
      <!-- Card Kanan -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-secondary">
            <span>list of announcements addressed to your division</span>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="itemBorrowTableRight">
              <thead>
                <tr>
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
                <!-- Isi tabel card kanan -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  

@endsection