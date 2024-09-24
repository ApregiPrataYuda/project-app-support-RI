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
<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
<li class="breadcrumb-item active"><?= $title ?></li>
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
          <div class="card-header" style="background-color:RGB(40, 178, 170);">
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
          


            <section class="content">
                <div class="container">
                    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh; margin-top: 5px;">
                        <!-- Default box -->
                        <div class="card" style="width: 80%; max-width: 800px;">
                           
                            <div class="card-body">
                                <!-- Content goes here -->
                            
                                <div class="container">
                                    <div class="row">
                                        <!-- Card 1 -->
                                        <div class="col-md-5">
                                            <div class="card card-danger card-outline card-outline">
                                                
                                                <div class="card-body box-profile">

                                                    <h5 class="text-center text-danger font-weight-bold">ID CARD VISITOR </h5>
                                                    {{-- <span class="text-center text-danger font-weight-bold">ID CARD VISITOR : </span> --}}
                                                    <ul class="list-group list-group-unbordered mb-3">
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold text-muted text-left text-uppercase text-secondary">DATE : {{format_date_indonesia($row->date_visitor)}}</span><br>
                                                            <span class="font-weight-bold text-muted text-left text-uppercase text-secondary">NAME : {{ $row->name_visitor}}</span><br>
                                                            <span class="font-weight-bold text-muted text-left text-uppercase text-secondary">COMPANY : {{ $row->company}}</span><br>
                                                            <span class="font-weight-bold text-muted text-left text-uppercase text-secondary">APPOINTMENT : {{ ($row->appointment == 1 ? 'YES' : 'NO')}}</span><br>
                                                            <span class="font-weight-bold text-muted text-left text-uppercase text-secondary">MEET WITH : {{ $row->meet_with}}</span><br>
                                                            <span class="font-weight-bold text-muted text-left text-uppercase text-secondary">Room : {{$row->room}}</span><br>
                                                            <span class="font-weight-bold text-muted text-left text-uppercase text-secondary">Hours : {{ $row->meet_hour_start}} - {{ $row->meet_hour_end}}</span><br>
                                                        </li>
                                                    </ul>
                                                   
                                                    <div class="d-flex justify-content-center">
                                                    <div class="card" style="width: 10rem;">
                                                        <div class="card-body">
                                                            <img src="{{$dataqr}}" alt="QR-CODE" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <p class="text-center text-danger font-weight-bold">PT RINNAI INDONESIA</p>
                                                  
                                                </div>
                                            </div>
                                        </div>
            
                                        <!-- Card 2 -->
                                        <div class="col-md-5">
                                             <a href="{{route('idcard.visitor.print',$row->identity_visitor)}}" class="btn btn-outline-danger btn-block"> <i class="fa fa-print"></i></a>
                                             <p class="text-center text-danger font-weight-bold">PRINT ID CARD VISITOR</p>
                                        </div>
                                    </div>
                                    
                                </div>

             
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>






        </div>
        <!-- /.card -->
  </section>
<!--start view for end -->

@endsection