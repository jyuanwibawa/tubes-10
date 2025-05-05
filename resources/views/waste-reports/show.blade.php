@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Laporan Sampah</div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>Lokasi:</strong>
                        <p>{{ $wasteReport->location }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p>{{ $wasteReport->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Status:</strong>
                        <p>
                            <span class="badge bg-{{ $wasteReport->status === 'pending' ? 'warning' : ($wasteReport->status === 'in_progress' ? 'info' : 'success') }}">
                                {{ $wasteReport->status }}
                            </span>
                        </p>
                    </div>

                    @if($wasteReport->image_path)
                        <div class="mb-3">
                            <strong>Foto:</strong>
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $wasteReport->image_path) }}" 
                                    alt="Foto sampah" 
                                    class="img-fluid" 
                                    style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>Dilaporkan oleh:</strong>
                        <p>{{ $wasteReport->user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Tanggal Laporan:</strong>
                        <p>{{ $wasteReport->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('waste-reports.index') }}" class="btn btn-secondary">Kembali</a>
                        @if(auth()->id() === $wasteReport->user_id)
                            <a href="{{ route('waste-reports.edit', $wasteReport) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('waste-reports.destroy', $wasteReport) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 