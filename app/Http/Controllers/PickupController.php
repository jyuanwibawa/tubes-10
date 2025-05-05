<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pickupRequests = PickupRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pickup.index', compact('pickupRequests'));
    }

    public function create()
    {
        return view('pickup.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'pickup_time' => 'nullable|date'
        ]);

        $pickupRequest = PickupRequest::create([
            'user_id' => Auth::id(),
            'address' => $validated['address'],
            'description' => $validated['description'],
            'pickup_time' => $validated['pickup_time'] ?? null,
            'status' => 'pending'
        ]);

        // Create notifications for all admin users
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'pickup_request_id' => $pickupRequest->id,
                'user_id' => $admin->id,
                'type' => 'new_pickup_request',
                'message' => 'Permintaan pickup baru dari ' . Auth::user()->name
            ]);
        }

        return redirect()->route('pickup.show', $pickupRequest->id)
            ->with('success', 'Permintaan pickup berhasil dibuat. Tim kami akan segera menghubungi Anda.');
    }

    public function show(PickupRequest $pickupRequest)
    {
        // Check if the user is authorized to view this pickup request
        if ($pickupRequest->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('pickup.show', compact('pickupRequest'));
    }
}