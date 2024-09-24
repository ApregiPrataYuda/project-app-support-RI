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
  <div class="card-body">
    <div class="alert alert-danger alert-dismissible w-75 mx-auto">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-ban"></i> WELLCOME APREGI!</h5>
      Setiap hari adalah kesempatan baru untuk menciptakan keajaiban. Jangan ragu untuk mengejar impianmu, karena langkah kecil hari ini bisa membawa perubahan besar di masa depan. Semangat!
    </div>
  </div>
</section>






  

  @endsection