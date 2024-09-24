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
<li class="breadcrumb-item"><a href="{{route('Admin.paket')}}">Kembali</a></li>
<li class="breadcrumb-item active"><?= $title ?></li>
</ol>
</div>
</div>
</div>
</section>

<!--start view for user -->
<section class="content">
        <!-- Default box -->
<div class="card">
<div class="card-header" style="background-color:RGB(40, 178, 170);">
<h3 class="card-title"><?= $title ?></h3>
<div class="card-tools">
<button type="button" class="btn btn-tool" data-card-widget="collapse">
<i class="fas fa-minus"></i>
</button>
<button type="button" class="btn btn-tool" data-card-widget="remove">
<i class="fas fa-times"></i>
</button>
</div>
</div>


<div class="card-body">
<div class="container mt-0">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- <div class="card"> -->
                    
                    <div class="card-body">
                        <form action="{{route('store.paket')}}" method="post" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group">
                                <label for="name_visitor" class="text-capitalize">NAME (Visitor)</label>
                                <input type="text" class="form-control" id="name_visitor" name="name_visitor" value="{{old('name_visitor')}}" placeholder="Enter visitor">
                                @error('name_visitor')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nohp">NUMBER HANDPHONE**</label>
                                <input type="text" class="form-control" name="nohp" value="{{old('nohp')}}" id="nohp" placeholder="">
                                @error('nohp')
                                    <div class="text-danger">{{ $message }}</div>
                                 @enderror
                              </div>

                              <div class="form-group">
                                <label for="company">COMPANY**</label>
                                <input type="text" class="form-control" name="company" value="{{old('company')}}" id="company" placeholder="">
                                @error('company')
                                    <div class="text-danger">{{ $message }}</div>
                                 @enderror
                              </div>
                        
                        
                              <div class="form-group">
                                <label for="selector" class="text-uppercase">your vehicle</label>
                                    <select id="selector" class="form-control">
                                        <option value="select">PILIH KENDARAAN</option>
                                        <option value="kendaraanMobil">MOBIL</option>
                                        <option value="kendaraanMotor">MOTOR</option>
                                        <option value="kendaraanLainya">LAINYA</option>
                                    </select>
                                @error('selector')
                                    <div class="text-danger">{{ $message }}</div>
                                 @enderror
                              </div>
                        
                              <div id="mobil" class="form-group" style="display: none;">
                                    <label for="mobilInput" class="text-uppercase">Nomor Plat Mobil</label> 
                                    <input type="text" id="mobilInput" name="numberVehicles[mobil]"  class="form-control" />
                                </div>
                                <div id="motor" class="form-group" style="display: none;">
                                    <label for="motorInput" class="text-uppercase">Nomor Plat Motor</label> 
                                    <input type="text" id="motorInput" name="numberVehicles[motor]" class="form-control" />
                                </div>
                                <div id="lainya" class="form-group" style="display: none;">
                                    <label for="lainyaInput" class="text-uppercase">Nomor Plat Kendaraan Lainya</label> 
                                    <input type="text" id="lainyaInput" name="numberVehicles[lainya]" class="form-control" />
                                </div>
                        
                        
                        
                        
                              <div class="form-group">
                                <label for="needs">NEEDS**</label>
                                <textarea name="needs" id="needs" name="needs" value="{{old('needs')}}" class="form-control"></textarea>
                                @error('needs')
                                    <div class="text-danger">{{ $message }}</div>
                                 @enderror
                              </div>
                        
                              <div class="form-row">
                        
                              <div class="form-group col-md-6">
                                  <label for="meet_with">MEET WITH**</label>
                                  <input type="text" class="form-control" name="meet_with" value="{{old('meet_with')}}" id="meet_with">
                                  @error('meet_with')
                                    <div class="text-danger">{{ $message }}</div>
                                 @enderror
                                </div>
                        
                        
                                <div class="form-group col-md-6">
                                  <label for="appointment">APPOINTMENTS**</label>
                                  <select class="custom-select mr-sm-2" name="appointment"  id="appointment">
                                    <option selected value="">Choose...</option>
                                    <option value="1" {{ old('appointment') == '1' ? 'selected' : '' }}>YES</option>
                                    <option value="2" {{ old('appointment') == '2' ? 'selected' : '' }}>NO</option>
                                  </select>
                                  @error('appointment')
                                    <div class="text-danger">{{ $message }}</div>
                                 @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="room">ROOM**</label>
                                    <select class="custom-select mr-sm-2" name="room" id="room">
                                      <option selected value="">Choose...</option>
                                      <option value="ROOM 1"  {{ old('room') == 'ROOM 1' ? 'selected' : '' }}>ROOM 1</option>
                                      <option value="ROOM 2" {{ old('room') == 'ROOM 2' ? 'selected' : '' }}>ROOM 2</option>
                                      <option value="NO ROOM" {{ old('room') == 'NO ROOM' ? 'selected' : '' }}>NO ROOM</option>
                                    </select>
                                    @error('room')
                                      <div class="text-danger">{{ $message }}</div>
                                   @enderror
                                  </div>
                          
                          
                                  <div class="form-group col-md-4">
                                    <label for="meet_hour_start">MEET HOUR START*</label>
                                    <input type="text" class="form-control" name="meet_hour_start" id="inputTime" value="{{old('meet_hour_start')}}" placeholder="09:00" pattern="[0-9]{2}:[0-9]{2}" title="Format: HH:MM">
                                    {{-- <span class="text-danger">ex:10:00</span> --}}
                                    @error('meet_hour_start')
                                      <div class="text-danger">{{ $message }}</div>
                                   @enderror
                                  </div>
                          
                                  <div class="form-group col-md-4">
                                    <label for="meet_hour_end">MEET HOUR END</label>
                                    <input type="text" class="form-control" id="inputTime" name="meet_hour_end" value="{{old('meet_hour_end')}}"  placeholder="10:00" pattern="[0-9]{2}:[0-9]{2}" title="Format: HH:MM">
                                    {{-- <span class="text-danger">ex:10:00</span> --}}
                                    @error('meet_hour_end')
                                      <div class="text-danger">{{ $message }}</div>
                                   @enderror
                                  </div>
                              </div>

                            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-outline-warning btn-sm"><i class="fa fa-undo"></i> Reset</button>
                        </form>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>


<div class="card-footer">
&copy; <?= date('Y') ?> Developer BY Apregi
</div>
</div>
        <!-- /.card -->
  </section>
<!--start view for end -->

<script type="text/javascript">
    // assetCode
    $(document).ready(function() {
        $("#kurir").select2({
           placeholder: "SELECT A KURIR",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#selector').change(function() {
            var value = $(this).val();
            // Hide all sections first
            $('#mobil, #motor, #lainya').hide();
            // Show the relevant section based on the selected value
            if (value === 'kendaraanMobil') {
                $('#mobil').show();
            } else if (value === 'kendaraanMotor') {
                $('#motor').show();
            } else if (value === 'kendaraanLainya') {
                $('#lainya').show();
            }
            // Disable the select element after an option is chosen
           $(this).prop('disabled', true);
        });
    });
</script>
<script>
function formatHour(input) {
let value = input.value;
// Ensure only hour is considered
let hour = value.split(':')[0];
input.value = `${hour}:00`;
}
</script>
@endsection
      