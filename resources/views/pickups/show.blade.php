@extends('usermain')

@section('title', 'Detail Permintaan Pickup - Clean Homes')

@section('hero-content')
<p class="lead mb-4">Detail permintaan pengambilan sampah Anda.</p>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">Detail Permintaan Pickup</h2>
                    <a href="{{ route('pickup.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3 class="h6 text-success">Status Permintaan</h3>
                            <div class="mb-3">
                                @if($pickupRequest->status == 'pending')
                                    <span class="badge bg-warning p-2">Menunggu</span>
                                @elseif($pickupRequest->status == 'accepted')
                                    <span class="badge bg-info p-2">Diterima</span>
                                @elseif($pickupRequest->status == 'rejected')
                                    <span class="badge bg-danger p-2">Ditolak</span>
                                @elseif($pickupRequest->status == 'completed')
                                    <span class="badge bg-success p-2">Selesai</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h6 text-success">Tanggal Permintaan</h3>
                            <p>{{ $pickupRequest->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h3 class="h6 text-success">Alamat Pengambilan</h3>
                        <p class="mb-0">{{ $pickupRequest->address }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="h6 text-success">Deskripsi Sampah</h3>
                        <p class="mb-0">{{ $pickupRequest->description }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="h6 text-success">Waktu Pengambilan</h3>
                        @if($pickupRequest->pickup_time)
                            <p class="mb-0">{{ \Carbon\Carbon::parse($pickupRequest->pickup_time)->format('d M Y, H:i') }}</p>
                        @else
                            <p class="mb-0 text-muted">Belum ditentukan</p>
                        @endif
                    </div>

                    @if($pickupRequest->admin)
                    <div class="mb-4">
                        <h3 class="h6 text-success">Ditangani Oleh</h3>
                        <p class="mb-0">{{ $pickupRequest->admin->name }}</p>
                    </div>
                    @endif

                    @if($pickupRequest->status == 'pending')
                    <div class="alert alert-warning">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Permintaan Anda sedang diproses. Tim kami akan segera menghubungi Anda.
                    </div>
                    @elseif($pickupRequest->status == 'accepted')
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Permintaan Anda telah diterima. Petugas akan menghubungi Anda untuk konfirmasi.
                    </div>
                    @elseif($pickupRequest->status == 'rejected')
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Maaf, permintaan Anda tidak dapat diproses. Silakan hubungi admin untuk informasi lebih lanjut.
                    </div>
                    @elseif($pickupRequest->status == 'completed')
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Pengambilan sampah telah selesai dilakukan. Terima kasih telah menggunakan layanan kami.
                    </div>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light py-3">
                    <h3 class="h5 mb-0">Butuh Bantuan?</h3>
                </div>
                <div class="card-body">
                    <p>Jika Anda memiliki pertanyaan tentang permintaan pickup ini, silakan hubungi tim kami:</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i>0812-3456-7890</p>
                            <p class="mb-1"><i class="bi bi-envelope-fill me-2"></i>pickup@cleansweep.com</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><i class="bi bi-clock-fill me-2"></i>Layanan 24/7</p>
                            <p class="mb-0"><i class="bi bi-chat-fill me-2"></i>Live Chat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 