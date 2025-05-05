@extends('layouts.history')

@section('title', 'Riwayat Permintaan Pickup - Cleansweep')

@section('hero-content')
<p class="lead mb-4">Lihat riwayat permintaan pengambilan sampah Anda.</p>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white py-3">
                    <h2 class="h4 mb-0">Riwayat Permintaan Pickup</h2>
                </div>
                <div class="card-body p-0">
                    @if($pickupRequests->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-inbox-fill text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h3 class="h5 text-muted">Belum ada permintaan pickup</h3>
                            <p class="text-muted">Anda belum membuat permintaan pengambilan sampah.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Waktu Pengambilan</th>
                                        <th>Catatan Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pickupRequests as $request)
                                        <tr>
                                            <td>{{ $request->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ Str::limit($request->address, 30) }}</td>
                                            <td>
                                                @if($request->status == 'pending')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @elseif($request->status == 'accepted')
                                                    <span class="badge bg-info">Diterima</span>
                                                @elseif($request->status == 'rejected')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @elseif($request->status == 'completed')
                                                    <span class="badge bg-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->pickup_time)
                                                    {{ \Carbon\Carbon::parse($request->pickup_time)->format('d M Y, H:i') }}
                                                @else
                                                    <span class="text-muted">Belum ditentukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->admin_notes)
                                                    <span class="text-muted">{{ Str::limit($request->admin_notes, 30) }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if($pickupRequests->hasPages())
                    <div class="card-footer bg-white">
                        {{ $pickupRequests->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 