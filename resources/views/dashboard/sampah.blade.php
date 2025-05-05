@extends('dashboard.main')

@section('content')
<p class="font-poppins font-medium text-gray-800 text-[28px] ms-10 mb-6">Grafik Sampah</p>

<!-- Kartu untuk Sampah TPS dan TPA -->
<div class="px-10 w-full flex flex-row gap-x-8 mb-10">
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

<!-- Daftar Collection Point -->
<div class="px-10 mt-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 font-poppins">Daftar Collection Point</h2>

    @if($collectionPoints->isEmpty())
    <p class="text-gray-500">Tidak ada data collection point.</p>
    @else
    <div class="overflow-x-auto bg-white rounded-md shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-primary-green text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Tipe</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Latitude</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Longitude</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Deskripsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @foreach ($collectionPoints as $point)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $point->name }}</td>
                    <td class="px-6 py-4">
                        <span
                            class="px-2 py-1 rounded-full text-white text-xs {{ $point->type === 'TPA' ? 'bg-red-500' : 'bg-blue-500' }}">
                            {{ $point->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $point->lat }}</td>
                    <td class="px-6 py-4">{{ $point->lng }}</td>
                    <td class="px-6 py-4">{{ $point->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<!-- Grafik Sampah -->
<div class="px-10 mt-10 bg-white shadow-md rounded-md p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 font-poppins">Grafik Jumlah Sampah per Bulan</h2>
    <div class="overflow-x-auto">
        <canvas id="grafikSampah" height="400"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('grafikSampah').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                    label: 'Sampah TPS',
                    data: @json($dataTPS),
                    borderColor: 'rgb(255, 99, 132)',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Sampah TPA',
                    data: @json($dataTPA),
                    borderColor: 'rgb(54, 162, 235)',
                    fill: false,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Sampah'
                    }
                }
            }
        }
    });
});
</script>
@endsection