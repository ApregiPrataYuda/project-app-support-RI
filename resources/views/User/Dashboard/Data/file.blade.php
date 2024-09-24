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
<li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
<li class="breadcrumb-item active">{{$title}}</li>
</ol>
</div>
</div>
</div>
</section>


<section class="content">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
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
          <div class="row">
              <div class="col-lg-3 col-6">

              <div class="small-box bg-info">
              <div class="inner">
              <h3>20</h3>
              <p class="text-uppercase">Total Data visitor 1 day</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              </div>

              <div class="col-lg-3 col-6">

              <div class="small-box bg-success">
              <div class="inner">
              <h3>100</h3>
              <p class="text-uppercase">Total Data visitor 7 day</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              </div>

              <div class="col-lg-3 col-6">

              <div class="small-box bg-warning">
              <div class="inner">
              <h3>400</h3>
              <p class="text-uppercase">Total Data visitor 1 Month</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              </div>

              <div class="col-lg-3 col-6">

              <div class="small-box bg-danger">
              <div class="inner">
              <h3>Data Not Found</h3>
              <p class="text-uppercase">Total Data visitor 1 Year</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              </div>

              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        </section>




  

  @endsection