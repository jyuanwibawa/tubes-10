<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\PickupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $articles = Article::all();
            $pickupRequests = PickupRequest::all();
            $users = User::all();

            // Hitung Users
            $userCount = User::where('role', 'user')->count();
            $adminCount = User::where('role', 'admin')->count();
            $pengelolaCount = User::where('role', 'pengelola')->count();

            // Hitung Articles
            $publishedArticles = Article::where('status', 'published')->count();
            $unpublishedArticles = Article::where('status', 'draft')->count();

            // Hitung Pickup Sampah
            $jumlahSampahTPS = PickupRequest::where('jenis_sampah', 'TPS')->count();
            $jumlahSampahTPA = PickupRequest::where('jenis_sampah', 'TPA')->count();

            // Total Pickup Request (Semua Sampah)
            $totalPickupRequest = PickupRequest::count();

            // Pickup Request by Status
            $completedPickup = PickupRequest::where('status', 'completed')->count();
            $rejectedPickup = PickupRequest::where('status', 'rejected')->count();
            $acceptedPickup = PickupRequest::where('status', 'accepted')->count();
            $pendingPickup = PickupRequest::where('status', 'pending')->count();

            // Prepare data untuk grafik
            $months = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            $dataTPS = [];
            $dataTPA = [];

            foreach (range(1, 12) as $month) {
                // Jumlah pickup TPS per bulan
                $tps = PickupRequest::where('jenis_sampah', 'TPS')
                    ->whereMonth('created_at', $month)
                    ->count();

                // Jumlah pickup TPA per bulan
                $tpa = PickupRequest::where('jenis_sampah', 'TPA')
                    ->whereMonth('created_at', $month)
                    ->count();

                $dataTPS[] = $tps;
                $dataTPA[] = $tpa;
            }

            // --- NEW --- Chart Status Data per Bulan
            $statusPending = [];
            $statusAccepted = [];
            $statusRejected = [];
            $statusCompleted = [];

            foreach (range(1, 12) as $month) {
                $pending = PickupRequest::where('status', 'pending')
                    ->whereMonth('created_at', $month)
                    ->count();

                $accepted = PickupRequest::where('status', 'accepted')
                    ->whereMonth('created_at', $month)
                    ->count();

                $rejected = PickupRequest::where('status', 'rejected')
                    ->whereMonth('created_at', $month)
                    ->count();

                $completed = PickupRequest::where('status', 'completed')
                    ->whereMonth('created_at', $month)
                    ->count();

                $statusPending[] = $pending;
                $statusAccepted[] = $accepted;
                $statusRejected[] = $rejected;
                $statusCompleted[] = $completed;
            }

            return view('dashboard.index', compact(
                'articles',
                'pickupRequests',
                'users',
                'userCount',
                'adminCount',
                'pengelolaCount',
                'publishedArticles',
                'unpublishedArticles',
                'jumlahSampahTPS',
                'jumlahSampahTPA',
                'totalPickupRequest',
                'completedPickup',
                'rejectedPickup',
                'acceptedPickup',
                'pendingPickup',
                'months',
                'dataTPS',
                'dataTPA',
                'statusPending',
                'statusAccepted',
                'statusRejected',
                'statusCompleted'
            ));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Failed to load dashboard.');
        }
    }
}