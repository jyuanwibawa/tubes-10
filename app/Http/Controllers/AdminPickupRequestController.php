<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use Illuminate\Http\Request;

class AdminPickupRequestController extends Controller
{
    public function index()
    {
        $pickupRequests = PickupRequest::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.pickup-requests.index', compact('pickupRequests'));
    }

    public function show(PickupRequest $pickupRequest)
    {
        return view('admin.pickup-requests.show', compact('pickupRequest'));
    }

    public function update(Request $request, PickupRequest $pickupRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected,completed',
            'admin_notes' => 'nullable|string|max:255',
        ]);

        // Ensure status is a string
        $status = (string) $validated['status'];

        $pickupRequest->update([
            'status' => $status,
            'admin_id' => auth()->id(),
            'admin_notes' => $validated['admin_notes'] ?? null,
        ]);

        return redirect()->route('admin.pickup-requests.show', $pickupRequest)
            ->with('success', 'Pickup request status updated successfully!');
    }
}