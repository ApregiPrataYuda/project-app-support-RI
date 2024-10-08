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
              <h3>{{$countMenu}}</h3>
              <p>Menu Management</p>
              </div>
              <div class="icon">
              <i class="fa fa-life-ring" aria-hidden="true"></i>
              </div>
              <a href="{{route('menu.view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              </div>

              <div class="col-lg-3 col-6">

              <div class="small-box bg-success">
              <div class="inner">
              <h3>{{$countSubMenu}}</h3>
              <p>SubMenu Management</p>
              </div>
              <div class="icon">
              <i class="fa fa-file" aria-hidden="true"></i>
              </div>
              <a href="{{route('submenu.view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              </div>

              <div class="col-lg-3 col-6">

              <div class="small-box bg-warning">
              <div class="inner">
              <h3>{{$countUser}}</h3>
              <p>User Management</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              </div>

              <div class="col-lg-3 col-6">

              <div class="small-box bg-danger">
              <div class="inner">
              <h3>{{$countRole}}</h3>
              <p>Role Management</p>
              </div>
              <div class="icon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </div>
              <a href="{{route('role.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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




        <section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="card">
        <div class="card-header">
        <h5 class="card-title">Monthly Recap Report</h5>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-wrench"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a href="#" class="dropdown-item">Action</a>
        <a href="#" class="dropdown-item">Another action</a>
        <a href="#" class="dropdown-item">Something else here</a>
        <a class="dropdown-divider"></a>
        <a href="#" class="dropdown-item">Separated link</a>
        </div>
        </div>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
        </div>
        </div>

        <div class="card-body">
        <div class="row">
        <div class="col-md-8">
        <p class="text-center">
        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
        </p>
        <div class="chart">

        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
        </div>

        </div>

        <div class="col-md-4">
        <p class="text-center">
        <strong>Goal Completion</strong>
        </p>
        <div class="progress-group">
        Add Products to Cart
        <span class="float-right"><b>160</b>/200</span>
        <div class="progress progress-sm">
        <div class="progress-bar bg-primary" style="width: 80%"></div>
        </div>
        </div>

        <div class="progress-group">
        Complete Purchase
        <span class="float-right"><b>310</b>/400</span>
        <div class="progress progress-sm">
        <div class="progress-bar bg-danger" style="width: 75%"></div>
        </div>
        </div>

        <div class="progress-group">
        <span class="progress-text">Visit Premium Page</span>
        <span class="float-right"><b>480</b>/800</span>
        <div class="progress progress-sm">
        <div class="progress-bar bg-success" style="width: 60%"></div>
        </div>
        </div>

        <div class="progress-group">
        Send Inquiries
        <span class="float-right"><b>250</b>/500</span>
        <div class="progress progress-sm">
        <div class="progress-bar bg-warning" style="width: 50%"></div>
        </div>
        </div>

        </div>
        </div>
        </div>

            <div class="card-footer">
            <div class="row">
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
            <h5 class="description-header">$35,210.43</h5>
            <span class="description-text">TOTAL REVENUE</span>
            </div>

            </div>

            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
            <h5 class="description-header">$10,390.90</h5>
            <span class="description-text">TOTAL COST</span>
            </div>

            </div>

            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
            <h5 class="description-header">$24,813.53</h5>
            <span class="description-text">TOTAL PROFIT</span>
            </div>

            </div>

            <div class="col-sm-3 col-6">
            <div class="description-block">
            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
            <h5 class="description-header">1200</h5>
            <span class="description-text">GOAL COMPLETIONS</span>
            </div>

            </div>
            </div>

</div>
</div>
</div>
</div>
</section>

  @endsection