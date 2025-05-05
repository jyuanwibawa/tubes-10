<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PickupRequestController extends BaseController
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use \Illuminate\Foundation\Validation\ValidatesRequests;
    use \Illuminate\Foundation\Bus\DispatchesJobs;

    public function __construct()
    {
        $this->middleware('auth')->except(['requestPage']);
    }

    public function index()
    {
        return redirect()->route('pickup.request-page');
    }

    public function requestPage()
    {
        return view('pickups.request-page');
    }

    public function create()
    {
        return view('pickups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'jenis_sampah' => 'nullable|string|max:100',
            'pickup_time' => 'nullable|date|after:now',
        ]);

        $pickupRequest = new PickupRequest();
        $pickupRequest->user_id = auth()->id();
        $pickupRequest->address = $validated['address'];
        $pickupRequest->description = $validated['description'];
        $pickupRequest->jenis_sampah = $validated['jenis_sampah'] ?? null;
        $pickupRequest->pickup_time = $validated['pickup_time'] ?? null;
        $pickupRequest->status = 'pending';
        $pickupRequest->save();

        return redirect()->route('pickup.show', $pickupRequest)
            ->with('success', 'Pickup request created successfully!');
    }

    public function show(PickupRequest $pickupRequest)
    {
        return view('pickups.show', compact('pickupRequest'));
    }

    public function history()
    {
        $pickupRequests = auth()->user()->pickupRequests()->latest()->paginate(10);
        return view('pickups.history', compact('pickupRequests'));
    }

    public function sampah()
    {
        // Data jumlah sampah total
        $jumlahSampahTPSd = PickupRequest::where('jenis_sampah', 'TPS')->count();
        $jumlahSampahTPAd = PickupRequest::where('jenis_sampah', 'TPA')->count();

        // Data grafik per bulan
        $jumlahSampahTPS = PickupRequest::where('jenis_sampah', 'TPS')
            ->selectRaw('COUNT(*) as count, MONTH(pickup_time) as month')
            ->whereNotNull('pickup_time')
            ->groupBy('month')
            ->pluck('count', 'month');

        $jumlahSampahTPA = PickupRequest::where('jenis_sampah', 'TPA')
            ->selectRaw('COUNT(*) as count, MONTH(pickup_time) as month')
            ->whereNotNull('pickup_time')
            ->groupBy('month')
            ->pluck('count', 'month');

        // Persiapan data bulan dan grafik
        $months = range(1, 12);
        $dataTPS = [];
        $dataTPA = [];

        foreach ($months as $month) {
            $dataTPS[] = $jumlahSampahTPS->get($month, 0);
            $dataTPA[] = $jumlahSampahTPA->get($month, 0);
        }

        // Ambil data collection point (fix error sebelumnya)
        $collectionPoints = CollectionPoint::all();

        // Kirim ke view
        return view('dashboard.sampah', compact(
            'jumlahSampahTPSd',
            'jumlahSampahTPAd',
            'jumlahSampahTPS',
            'jumlahSampahTPA',
            'dataTPS',
            'dataTPA',
            'months',
            'collectionPoints'
        ));
    }
}
