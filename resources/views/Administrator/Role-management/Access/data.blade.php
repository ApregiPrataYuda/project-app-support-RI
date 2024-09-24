
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
<li class="breadcrumb-item"><a href="#">back</a></li>
<li class="breadcrumb-item active">{{$title}}</li>
</ol>
</div>
</div>
</div>
</section>

<div class="col-md-12">
<div class="alert alert-secondary" role="alert">
    <span>Alert!!!!!!!</span><br>
    If something is checked, it means the role has access to the menu, if not then there is no access
  </div>
</div>
<!--start view for user -->
<section class="content">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-secondary">
            <h3 class="card-title text-light">Data {{$title}}</h3>

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
          <table class="table table-bordered" id="MenuRoleTable">
  <thead>
    <tr>
      <th scope="col" style="width: 2%;">No</th>
      <th scope="col">Name Menu</th>
      <th scope="col" style="width: 15%;">Access Accept</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($menu as $mn)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mn->menu }}</td>
                        <td>
                      <div class="custom-control custom-switch">
                                <input class="form-check-input" type="checkbox" 
                                {{ cek_akses($roles->role_id, $mn->id) }}
                                  data-role="{{ $roles->role_id}}"
                                  data-menu="{{ $mn->id }}"/>
                                <label class="form-check-label" for="defaultCheck3">access or not access </label>
                                </div> 
                      </td>
                    </tr>
  @endforeach
  </tbody>
</table>
        </div>
        <!-- /.card -->
  </section>
<script>
$(document).ready(function() {
    // Set up CSRF token for AJAX request
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "{{ route('change.access.menu') }}",
            type: "POST",
            headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // Laravel CSRF token
                },
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                window.location.href = "{{ url('Administrator/Management-role') }}";
            }
        });
    });
});

$(document).ready(function() {
      $('#MenuRoleTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      });
</script>

@endsection

