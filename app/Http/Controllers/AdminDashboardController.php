<?php
// =====================================
// AdminDashboardController (app/Http/Controllers/AdminDashboardController.php)
// =====================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtopiaData;
use App\Models\AncientData;
use App\Models\EmailLog;
use App\Models\BulkEmailBatch;
use Illuminate\Support\Facades\DB;


class AdminDashboardController extends Controller
{
    public function index()
    {
        // Artopia Statistics
        $artopiaStats = [
            'total' => ArtopiaData::count(),
            'pending' => ArtopiaData::where('status_seleksi', 'pending')->count(),
            'accepted' => ArtopiaData::where('status_seleksi', 'lolos')->count(),
            'rejected' => ArtopiaData::where('status_seleksi', 'gagal')->count(),
        ];

        $ancientStats = [
            'total' => AncientData::count(),
            'pending' => AncientData::where('status_seleksi', 'pending')->count(),
            'accepted' => AncientData::where('status_seleksi', 'lolos')->count(),
            'rejected' => AncientData::where('status_seleksi', 'gagal')->count(),
        ];

        $emailStats = [
            'total_sent' => EmailLog::where('status', 'sent')->count(),
            'total_failed' => EmailLog::where('status', 'failed')->count(),
            'sent_today' => EmailLog::where('status', 'sent')
                ->whereNotNull('sent_at')
                ->whereDate('sent_at', today())->count(),
            'failed_today' => EmailLog::where('status', 'failed')
                            ->whereDate('sent_at', today())->count(),
            'recent_batches' => BulkEmailBatch::with('admin')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
        ];

        // Recent Registrations
        $recentArtopia = ArtopiaData::orderBy('timestamp', 'desc')->limit(5)->get();
        $recentAncient = AncientData::orderBy('timestamp', 'desc')->limit(5)->get();

        // Registration Trends (Last 7 days)
        $chartData = $this->getRegistrationTrends();

        return view('admin.dashboard', compact(
            'artopiaStats',
            'ancientStats', 
            'emailStats',
            'recentArtopia',
            'recentAncient',
            'chartData' 
        ));
    }

    private function getRegistrationTrends()
    {
        $last7Days = collect();
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            
            $artopiaCount = ArtopiaData::whereDate('timestamp', $dateStr)->count();
            $ancientCount = AncientData::whereDate('timestamp', $dateStr)->count();
            
            $last7Days->push([
                'date' => $date->format('M j'),
                'artopia' => $artopiaCount,
                'ancient' => $ancientCount,
                'total' => $artopiaCount + $ancientCount,
            ]);
        }
        
        return $last7Days;
    }
}