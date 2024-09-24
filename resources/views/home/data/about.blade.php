@extends('frontend.app')
@section('content')


  <!-- Tentang Kami Section -->
  <section class="py-5">
    <div class="container">
        <h2 class="text-center">Tentang Kami</h2>
        <p class="text-center mb-5">Kami adalah perusahaan yang menyediakan solusi teknologi terbaik untuk pelanggan kami, terus berkembang sejak tahun XXXX. Perusahaan kami telah berdiri sejak tahun XXXX dan terus mengalami pertumbuhan yang pesat dengan selalu berkomitmen memberikan solusi terbaik dan inovatif bagi pelanggan kami.</p>

        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/backend/dist/img/photo1.png') }}" class="card-img-top" alt="Tentang Kami Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Sejarah Perusahaan</h5>
                        <p class="card-text">Perusahaan kami didirikan dengan tujuan untuk memberikan layanan berkualitas tinggi di industri ini.</p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/backend/dist/img/photo2.png') }}" class="card-img-top" alt="Tentang Kami Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Komitmen Kami</h5>
                        <p class="card-text">Kami selalu berusaha untuk memberikan solusi inovatif dan memenuhi kebutuhan pelanggan secara maksimal.</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/backend/dist/img/photo3.jpg') }}" class="card-img-top" alt="Tentang Kami Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Nilai Inti</h5>
                        <p class="card-text">Kepercayaan, integritas, dan inovasi adalah nilai-nilai utama yang kami pegang dalam setiap langkah yang kami ambil.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Our Team Section -->
  <section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center">Tim Kami</h2>
        <p class="text-center mb-5">Kami memiliki tim yang terdiri dari individu-individu profesional dan berpengalaman yang berdedikasi penuh untuk kesuksesan perusahaan.</p>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/backend/dist/img/user3.jpg') }}" class="rounded-circle mb-3" alt="CEO">
                <h5>John Doe</h5>
                <p>CEO</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/backend/dist/img/user2.jpg') }}" class="rounded-circle mb-3" alt="COO">
                <h5>Jane Smith</h5>
                <p>COO</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/backend/dist/img/user1.jpg') }}" class="rounded-circle mb-3" alt="CTO">
                <h5>Michael Johnson</h5>
                <p>CTO</p>
            </div>
        </div>
    </div>
</section>


@endsection