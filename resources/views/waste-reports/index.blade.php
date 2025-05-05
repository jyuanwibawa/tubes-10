@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Daftar Laporan Sampah</span>
                    <a href="{{ route('waste-reports.create') }}" class="btn btn-primary">Buat Laporan Baru</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reports as $report)
                                    <tr>
                                        <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $report->location }}</td>
                                        <td>{{ Str::limit($report->description, 50) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $report->status === 'pending' ? 'warning' : ($report->status === 'in_progress' ? 'info' : 'success') }}">
                                                {{ $report->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($report->image_path)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $report->id }}">
                                                    <img src="{{ asset('storage/' . $report->image_path) }}" 
                                                        alt="Foto sampah" 
                                                        style="max-width: 50px; max-height: 50px; cursor: pointer;">
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('waste-reports.show', $report) }}" 
                                                class="btn btn-sm btn-info">Detail</a>
                                            @if(auth()->id() === $report->user_id)
                                                <a href="{{ route('waste-reports.edit', $report) }}" 
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('waste-reports.destroy', $report) }}" 
                                                    method="POST" 
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada laporan sampah</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals untuk melihat foto -->
@foreach($reports as $report)
    @if($report->image_path)
    <div class="modal fade" id="imageModal{{ $report->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $report->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel{{ $report->id }}">Foto Laporan Sampah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('storage/' . $report->image_path) }}" 
                        alt="Foto sampah" 
                        class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach
@endsection 