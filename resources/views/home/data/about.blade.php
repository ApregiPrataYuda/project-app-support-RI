@extends('frontend.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  
   
<!-- Our Product Analytics Section (Produksi Tahun Ini dan Tingkat Reject Tahun Ini) -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center">Company Analytics</h2>
        <p class="text-center mb-5">Lihat analitik produksi dan tingkat reject produk tahun ini.</p>
        <div class="row">
            <!-- Grafik 1: Produksi Tahun Ini -->
            <div class="col-md-6">
                <h3 class="text-center">Produksi Tahun Ini</h3>
                <canvas id="productionChart"></canvas>
            </div>
            <!-- Grafik 2: Tingkat Reject Tahun Ini -->
            <div class="col-md-6">
                <h3 class="text-center">Tingkat Reject Tahun Ini</h3>
                <canvas id="rejectChart"></canvas>
            </div>
        </div>
    </div>
</section>



       
  

  <!-- Our Product Analytics Section (Grafik Produk Reject dan Kategori Produk) -->
<!-- Our Product Analytics Section (Produksi 2019-2024 dan Tingkat Penjualan Per Tahun) -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center">Company Analytics</h2>
        <p class="text-center mb-5">Lihat analitik produksi dan tingkat penjualan produk dari tahun 2019 hingga 2024.</p>
        <div class="row">
            <!-- Grafik 1: Produksi Tahun 2019-2024 -->
            <div class="col-md-6">
                <h3 class="text-center">Produksi Tahun 2019-2024</h3>
                <canvas id="production2019to2024Chart"></canvas>
            </div>
            <!-- Grafik 2: Tingkat Penjualan Per Tahun -->
            <div class="col-md-6">
                <h3 class="text-center">Tingkat Penjualan Per Tahun</h3>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</section>


<script>
    // Grafik 1: Produksi Tahun Ini (Line Chart)
    var ctx1 = document.getElementById('productionChart').getContext('2d');
    var productionChart = new Chart(ctx1, {
        type: 'line', // Menggunakan grafik garis
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'], // Bulan dalam setahun
            datasets: [{
                label: 'Produksi Bulanan',
                data: [1000, 1200, 1500, 1300, 1600, 1800, 1700, 1900, 2000, 2100, 2200, 2500], // Data produksi bulanan
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna area grafik
                borderColor: 'rgba(54, 162, 235, 1)', // Warna garis
                borderWidth: 2,
                fill: true // Mengisi area di bawah garis
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Mulai dari nol pada sumbu Y
                }
            }
        }
    });

    // Grafik 2: Tingkat Reject Tahun Ini (Bar Chart)
    var ctx2 = document.getElementById('rejectChart').getContext('2d');
    var rejectChart = new Chart(ctx2, {
        type: 'bar', // Menggunakan grafik batang
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'], // Bulan dalam setahun
            datasets: [{
                label: 'Tingkat Reject Bulanan',
                data: [50, 60, 45, 80, 70, 55, 65, 75, 85, 90, 95, 100], // Data tingkat reject bulanan
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna batang
                borderColor: 'rgba(255, 99, 132, 1)', // Warna border batang
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Mulai dari nol pada sumbu Y
                }
            }
        }
    });
</script>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Grafik 1: Produksi Tahun 2019-2024 (Bar Chart)
    var ctx1 = document.getElementById('production2019to2024Chart').getContext('2d');
    var production2019to2024Chart = new Chart(ctx1, {
        type: 'bar', // Menggunakan grafik batang
        data: {
            labels: ['2019', '2020', '2021', '2022', '2023', '2024'], // Tahun
            datasets: [{
                label: 'Produksi Tahunan',
                data: [25000, 27000, 30000, 32000, 34000, 36000], // Data produksi per tahun
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna batang
                borderColor: 'rgba(75, 192, 192, 1)', // Warna border batang
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Mulai dari nol pada sumbu Y
                }
            }
        }
    });

    // Grafik 2: Tingkat Penjualan Per Tahun (Line Chart)
    var ctx2 = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx2, {
        type: 'line', // Menggunakan grafik garis
        data: {
            labels: ['2019', '2020', '2021', '2022', '2023', '2024'], // Tahun
            datasets: [{
                label: 'Tingkat Penjualan',
                data: [30000, 32000, 35000, 37000, 39000, 41000], // Data penjualan per tahun
                backgroundColor: 'rgba(255, 159, 64, 0.2)', // Warna area grafik
                borderColor: 'rgba(255, 159, 64, 1)', // Warna garis
                borderWidth: 2,
                fill: true // Mengisi area di bawah garis
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Mulai dari nol pada sumbu Y
                }
            }
        }
    });
</script>




@endsection