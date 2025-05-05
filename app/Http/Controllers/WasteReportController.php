<?php

namespace App\Http\Controllers;

use App\Models\WasteReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WasteReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = WasteReport::with('user')->latest()->get();
        return view('waste-reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('waste-reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('waste-reports', 'public');
        }

        $report = WasteReport::create([
            'user_id' => auth()->id(),
            'location' => $validated['location'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'latitude' => $request->has('latitude') ? $validated['latitude'] : null,
            'longitude' => $request->has('longitude') ? $validated['longitude'] : null,
            'status' => 'pending'
        ]);

        return redirect()->route('waste-reports.index')
            ->with('success', 'Laporan sampah berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(WasteReport $wasteReport)
    {
        return view('waste-reports.show', compact('wasteReport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WasteReport $wasteReport)
    {
        return view('waste-reports.edit', compact('wasteReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WasteReport $wasteReport)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'location' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'sometimes|nullable|numeric',
            'longitude' => 'sometimes|nullable|numeric',
            'dispatch_date' => 'nullable|date',
            'completion_date' => 'nullable|date'
        ]);

        // Handle status and dates update
        if ($request->has('status')) {
            $updateData = ['status' => $request->status];
            
            // Clear dates when status is pending
            if ($request->status === 'pending') {
                $updateData['dispatch_date'] = null;
                $updateData['completion_date'] = null;
            }
            // Set dispatch date for in_progress if provided
            elseif ($request->status === 'in_progress') {
                if ($request->has('dispatch_date')) {
                    $updateData['dispatch_date'] = $request->dispatch_date;
                }
                $updateData['completion_date'] = null;
            }
            // Set completion date for resolved if provided
            elseif ($request->status === 'resolved') {
                if ($request->has('completion_date')) {
                    $updateData['completion_date'] = $request->completion_date;
                }
                // Keep existing dispatch_date
            }
            
            $wasteReport->update($updateData);
            return back()->with('success', 'Data berhasil diperbarui!');
        }

        // Handle only date updates without status change
        if ($request->has('dispatch_date') || $request->has('completion_date')) {
            $updateData = [];
            
            if ($request->has('dispatch_date') && $wasteReport->status !== 'pending') {
                $updateData['dispatch_date'] = $request->dispatch_date;
            }
            
            if ($request->has('completion_date') && $wasteReport->status === 'resolved') {
                $updateData['completion_date'] = $request->completion_date;
            }
            
            if (!empty($updateData)) {
                $wasteReport->update($updateData);
                return back()->with('success', 'Tanggal berhasil diperbarui!');
            }
        }

        // Handle other updates (location, description, etc.)
        if ($request->hasFile('image')) {
            if ($wasteReport->image_path) {
                Storage::disk('public')->delete($wasteReport->image_path);
            }
            $imagePath = $request->file('image')->store('waste-reports', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Pastikan latitude dan longitude ada dalam data yang akan diupdate
        if (!$request->has('latitude')) {
            $validated['latitude'] = null;
        }
        if (!$request->has('longitude')) {
            $validated['longitude'] = null;
        }

        // Hapus status dari data yang akan diupdate
        unset($validated['status']);

        $wasteReport->update($validated);

        return redirect()->route('waste-reports.index')
            ->with('success', 'Laporan sampah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WasteReport $wasteReport)
    {
        if ($wasteReport->image_path) {
            Storage::disk('public')->delete($wasteReport->image_path);
        }
        
        $wasteReport->delete();

        return redirect()->route('waste-reports.index')
            ->with('success', 'Laporan sampah berhasil dihapus!');
    }

    public function laporan()
    {
        $wasteReports = WasteReport::with('user')->latest()->get();
        return view('Report_sampah.LapSampah', compact('wasteReports'));
    }
}