@extends('frontend.app')
@section('content')


  <!-- Tentang Kami Section -->
  <section class="py-5">
    <div class="container">
        <h2 class="text-center">About Us</h2>
        <p class="text-center mb-5">Pada tahun 1920 berlokasi di Nagoya, Jepang , Rinnai Japan Corporation didirikan oleh Mr. Hidejiro Naito dan Mr. Kenkichi Hayashi.
            Pada awalnya dimulai dengan memproduksi peralatan seperti kompor gas, pemanas air, kompor tanam, dan terus berkembang hingga sekarang dengan memproduksi mesin pencuci piring, pemanggang daging, penghisap asap dan beraneka ragam produk lainnya.
            Saat ini jaringan Rinnai Japan Corporation tersebar di 15 negara di seluruh dunia, yaitu di Korea, Guangzhou, Shanghai, Taiwan, Singapura, Indonesia, Thailand, Vietnam, Malaysia, Amerika Serikat, Inggris, Brazil, Italia, Selandia Baru, dan Australia.
            Di Indonesia, produk Rinnai telah hadir sejak tahun 1979, dan pabrik pertama didirikan di Cikupa, Tangerang pada tahun 1988. Seiring dengan bertambahnya kebutuhan akan produk Rinnai, pabrik kedua diresmikan pada 3 Sept 2012 di Balaraja, Tangerang.
            Rinnai di Indonesia akan terus mempertahankan posisi sebagai market leader produk gas berkualitas dan aman. Hal ini dipertegas dengan didapatkannya penghargaan seperti Indonesian Customer Satisfication Award (ICSA) 2008-2013, Indonesia Best Brand Award (IBBA) 2007 – 2018, No.1 Choice Award For Indonesian Women Survey 2012 dan 2013, Indonesia’s Most Favourite Women Brand 2012, iDea Rumah Award Reader’s Choice 2014 untuk kategori Kitchen Appliances dan Water Heater.
            Rinnai, Experience Our Innovation.</p>

        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/backend/dist/img/RI7.jpeg') }}" class="card-img-top" alt="Tentang Kami Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Company History</h5>
                        <p class="card-text">Our company was founded with the aim of providing high quality services in this industry.</p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/backend/dist/img/RI8.jpg') }}" class="card-img-top" alt="Tentang Kami Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Our Commitment</h5>
                        <p class="card-text">We always strive to provide innovative solutions and meet customer needs optimally.</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/backend/dist/img/RI9.jpg') }}" class="card-img-top" alt="Tentang Kami Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Core Values</h5>
                        <p class="card-text">Trust, integrity and innovation are the main values ​​we uphold in every step we take.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Our Team Section -->
  <section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center">Our product gallery</h2>
        <p class="text-center mb-5">Lihat berbagai produk unggulan kami yang telah dikembangkan dengan inovasi dan kualitas terbaik.</p>
        <div class="row">
            <!-- Gambar 1 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/backend/dist/img/RI1.jpg') }}" class="img-fluid mb-3" alt="Galeri 1">
            </div>
            <!-- Gambar 2 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/backend/dist/img/RI1.jpg') }}" class="img-fluid mb-3" alt="Galeri 2">
            </div>
            <!-- Gambar 3 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/backend/dist/img/RI1.jpg') }}" class="img-fluid mb-3" alt="Galeri 3">
            </div>
        </div>
    </div>
</section>



@endsection