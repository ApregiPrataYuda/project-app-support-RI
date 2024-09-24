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
    <li class="breadcrumb-item"><a href="{{route('user.index')}}">back</a></li>
    <li class="breadcrumb-item active">{{$title}}</li>
    </ol>
    </div>
    </div>
    </div>
    </section>

<!--start view for user -->
<section class="content">
<div class="alert alert-warning" role="alert">
            <small>(* Jika ceklis maka user tersebut mempunyai akses ke sub menu tersebut)</small>
            </div>
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
          <table class="table table-bordered" id="accessTable">
            <thead>
            <tr>
                    <th style="width: 5px;">No</th>
                        <th>Name Menu</th>
                        <th>Name Submenu Dan Action(add/edit/del)</th>
                        <th>Noted</th>
                        <th style="width: 5%;">Status Submenu</th>
                        <th style="width: 5%;">Action</th>
                      </tr>
            </thead>
         <tbody>
         @foreach ($submenu as $sub)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          @switch($sub->menu_name)
                              @case('Administrator')
                                  <span class="badge badge-pill badge-primary">Administrator</span>
                                  @break
                              @case('Admin')
                                  <span class="badge badge-pill badge-secondary">Admin</span>
                                  @break
                              @case('User')
                                  <span class="badge badge-pill badge-success">User</span>
                                  @break
                              @case('Others')
                                  <span class="badge badge-pill badge-warning">Others</span>
                                  @break
                              @default
                                  <span class="badge badge-pill badge-secondary">Other</span>
                          @endswitch
                        </td>
                        <td>{{ $sub->title }}</td>
                        <td><textarea class="form-control" cols="10" rows="2" readonly>{{ $sub->noted }}</textarea> </td>
                        <td>
                            {!! ($sub->is_active == 1 
                                ? '<span class="badge badge-pill badge-danger">Aktif</span>' 
                                : '<span class="badge badge-pill badge-secondary">NonAktif</span>'
                            ) !!}
                        </td>
                        <td>
                        <div class="custom-control custom-switch">
                       <input class="form-check-input" type="checkbox"  
                        {{ cek_akses_submenu($userID->user_id, $sub->id) }}
                        data-user="{{ $userID->user_id }}"
                        data-submenu="{{ $sub->id }}"/>
                       <label class="form-check-label" for="defaultCheck3"></label>
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
          $(document).ready(function () {
            $('#accessTable').DataTable(); 
          });

        // Menggunakan jQuery untuk menangani klik dan AJAX request
        $('.form-check-input').on('click', function() {
            const submenu = $(this).data('submenu');
            const userId = $(this).data('user');
            
            $.ajax({
                url: "{{ route('change.access') }}", // Laravel route
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // Laravel CSRF token
                },
                data: {
                    submenu: submenu,
                    userId: userId
                },
                success: function() {
                    window.location.href = "{{ url('Administrator/Management-user') }}"; // Laravel URL helper
                },
                error: function(xhr) {
                    console.error('AJAX request failed:', xhr);
                }
            });
        });

          </script>
<!--start view for end -->
@endsection