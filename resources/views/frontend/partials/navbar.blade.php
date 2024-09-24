
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
<div class="container">
<a href="{{ url('/') }}" class="navbar-brand">
    {{-- <img src="{{ asset('assets/backend/dist/img/rinnai.png') }}" alt="AdminLTE Logo"  width="18%"> --}}
    <span class="brand-text font-weight-bold text-danger">PT RINNAI INDONESIA</span>
</a>
<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse order-3" id="navbarCollapse">

<ul class="navbar-nav">

<li class="nav-item">
<a href="{{ url('/')}}" class="nav-link">
    About Us</a>
</li>

<li class="nav-item">
    <a href="{{ route('form.visitor') }}" class="nav-link">
        Form Visitor</a>
</li>

<li class="nav-item">
    <a href="{{ route('check.paket') }}" class="nav-link">
        Check Your Paket</a>
</li>



<li class="nav-item">
    <a href="{{ route('borrow.management') }}" class="nav-link">
        Borrow Item</a>
</li>

<li class="nav-item">
    <a href="{{route('Announcement.index')}}" class="nav-link">
        Announcement</a>
</li>



<li class="nav-item dropdown">
<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Others Menu</a>
<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
<li><a href="" class="dropdown-item">Here New Menu 1</a></li>
<li><a href="" class="dropdown-item">Here New Menu 2</a></li>
<li><a href="" class="dropdown-item">Here New Menu 3</a></li>
<li><a href="{{ route('login')}}" class="dropdown-item">Login</a></li>
</ul>

<li class="nav-item">
    <a href="{{ route('login')}}" class="nav-link brand-text font-weight-bold text-danger">
        <i class="fa fa-cloud" aria-hidden="true"></i> Login</a> 
</li>
</li>

</ul>
</li>
</ul>

</div>

{{-- <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
<li class="nav-item">
 <a href="{{ route('login')}}" class="text-primary"> <i class="fa fa-cloud"></i> Login</a>
</li>
</ul> --}}
</div>
</nav>