@extends('dashboard.main')

@section('content')
<p class="font-poppins font-medium text-gray-800 text-[28px] ms-10 mb-6">Grafik Sampah</p>

<!-- Kartu untuk Sampah TPS dan TPA -->
<div class="px-10 w-full flex flex-row gap-x-8 mb-6">
    <!-- Kartu Sampah TPS -->
    <div
        class="border-s-4 border-s-primary-green px-6 flex flex-row py-8 w-full justify-between shadow-md bg-white rounded-md">
        <div class="flex flex-col">
            <p class="font-poppins font-medium text-primary-green text-[18px]">Jumlah Sampah TPS</p>
            <p class="font-poppins font-light text-black text-[16px]">{{ $jumlahSampahTPSd }}</p>
        </div>
        <svg class="w-10" xmlns="http://www.w3.org/2000/svg" fill="#198754" viewBox="0 0 24 24">
            <path
                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
            </path>
        </svg>
    </div>

    <!-- Kartu Sampah TPA -->
    <div
        class="border-s-4 border-s-primary-green px-6 flex flex-row py-8 w-full justify-between shadow-md bg-white rounded-md">
        <div class="flex flex-col">
            <p class="font-poppins font-medium text-primary-green text-[18px]">Jumlah Sampah TPA</p>
            <p class="font-poppins font-light text-black text-[16px]">{{ $jumlahSampahTPAd }}</p>
        </div>
        <svg class="w-10" xmlns="http://www.w3.org/2000/svg" fill="#198754" viewBox="0 0 24 24">
            <path
                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
            </path>
        </svg>
    </div>
</div>

<!-- Grafik Sampah TPS dan TPA -->
<div class="px-10 w-full">
    <canvas id="grafikSampah"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('grafikSampah');

        // Menyesuaikan ukuran canvas
        canvas.width = window.innerWidth - 50; // Lebar canvas disesuaikan dengan lebar layar
        canvas.height = 400; // Tinggi tetap 400px

        const ctx = canvas.getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months), // Label bulan 1 - 12
                datasets: [{
                    label: 'Sampah TPS',
                    data: @json($dataTPS), // Data jumlah sampah TPS
                    borderColor: 'rgb(255, 99, 132)', // Warna garis TPS
                    fill: false,
                }, {
                    label: 'Sampah TPA',
                    data: @json($dataTPA), // Data jumlah sampah TPA
                    borderColor: 'rgb(54, 162, 235)', // Warna garis TPA
                    fill: false,
                }]
            },
            options: {
                responsive: true, // Menyesuaikan grafik dengan ukuran layar
                maintainAspectRatio: false, // Tidak mempertahankan rasio aspek tetap
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    });
</script>
@endsection