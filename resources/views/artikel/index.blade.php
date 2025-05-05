@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Edukasi Daur Ulang</h1>
            <p class="text-lg text-gray-600">Pelajari cara mendaur ulang sampah dengan benar</p>
        </div>

        <!-- Filter Section -->
        <div class="mb-8 flex stify-center space-x-4">
            <button class="filter-btn active px-4 py-2 rounded-full bg-green-600 text-white" data-filter="all">
                Semua
            </button>
            <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300" data-filter="artikel">
                Artikel
            </button>
            <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300" data-filter="video">
                Video
            </button>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($edukasi as $item)
            <div class="bg-white rounded-xl shadow-md overflow-hidden edukasi-item" data-type="{{ $item->tipe }}">
                <!-- Image/Video Thumbnail -->
                <div class="relative h-48">
                    @if ($item->tipe === 'video')
                    <div class="absolute inset-0 flex items-center justify-center">
                        <iframe class="w-full h-full" src="{{ $item->konten }}"
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    @else
                    <img src="{{ $item->gambar ?? asset('images/default-article.jpg') }}"
                        alt="{{ $item->judul }}"
                        class="w-full h-full object-cover">
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                                {{ $item->tipe === 'artikel' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($item->tipe) }}
                        </span>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-900 mb-3">{{ $item->judul }}</h2>

                    @if ($item->tipe === 'artikel')
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $item->konten }}</p>
                    @endif

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">
                            {{ $item->created_at->format('d M Y') }}
                        </span>
                        <a href="{{ route('edukasi.show', $item->id) }}"
                            class="text-green-600 hover:text-green-700 font-medium">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($edukasi->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-newspaper fa-4x"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada konten edukasi</h3>
            <p class="text-gray-500">Konten edukasi akan segera tersedia</p>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .filter-btn.active {
        background-color: #059669;
    }

    .edukasi-item {
        transition: transform 0.2s;
    }

    .edukasi-item:hover {
        transform: translateY(-5px);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const edukasiItems = document.querySelectorAll('.edukasi-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;

                // Filter items
                edukasiItems.forEach(item => {
                    if (filter === 'all' || item.dataset.type === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection