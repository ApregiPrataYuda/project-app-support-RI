@include('authentikasi.partials.header')
@if ($errors->any())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>error!</strong>   @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif



<form action="{{ route('login.store') }}" method="post">
@csrf

<div class="input-group mb-3">
<input type="text" class="form-control" name="username" id="username" placeholder="username">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>


<div class="input-group mb-3">
<input type="password" class="form-control" name="password" id="password" placeholder="Password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>

<div>
<button type="submit"  id="btnSave" class="btn btn-outline-primary btn-sm"><i class="fas fa-sign-in-alt"></i> Sign In</button>
</div>
<p class="mt-2">
<a href="{{'/'}}">Back To Home</a>
</p>
</div>
</form>
@include('authentikasi.partials.footer')

