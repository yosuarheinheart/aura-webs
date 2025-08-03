<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtopiaData;
use App\Models\AncientData;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        $artopiaCount = ArtopiaData::count();
        $ancientCount = AncientData::count();
        
        $artopiaStats = [
            'pending' => ArtopiaData::where('status_seleksi', 'pending')->count(),
            'lolos' => ArtopiaData::where('status_seleksi', 'lolos')->count(),
            'gagal' => ArtopiaData::where('status_seleksi', 'gagal')->count(),
        ];
        
        $ancientStats = [
            'pending' => AncientData::where('status_seleksi', 'pending')->count(),
            'lolos' => AncientData::where('status_seleksi', 'lolos')->count(),
            'gagal' => AncientData::where('status_seleksi', 'gagal')->count(),
        ];

        return view('admin.dashboard', compact('artopiaCount', 'ancientCount', 'artopiaStats', 'ancientStats'));
    }

    public function artopia()
    {
        $registrations = ArtopiaData::orderBy('timestamp', 'desc')->paginate(20);
        return view('admin.artopia', compact('registrations'));
    }

    public function ancient()
    {
        $registrations = AncientData::orderBy('timestamp', 'desc')->paginate(20);
        return view('admin.ancient', compact('registrations'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'event_type' => 'required|in:artopia,ancient',
                'id' => 'required|integer',
                'status' => 'required|in:pending,lolos,gagal',
                'catatan_admin' => 'nullable|string'
            ]);

            $participant = $this->findParticipant($request->event_type, $request->id);
            
            if (!$participant) {
                return response()->json(['success' => false, 'message' => 'Peserta tidak ditemukan']);
            }

            $participant->status_seleksi = $request->status;
            $participant->catatan_admin = $request->catatan_admin;
            $participant->save();

            return response()->json([
                'success' => true, 
                'message' => 'Status berhasil diperbarui',
                'participant' => $participant
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getParticipant(Request $request)
    {
        try {
            $request->validate([
                'event_type' => 'required|in:artopia,ancient',
                'id' => 'required|integer'
            ]);

            $participant = $this->findParticipant($request->event_type, $request->id);
            
            if (!$participant) {
                return response()->json(['success' => false, 'message' => 'Peserta tidak ditemukan']);
            }

            return response()->json(['success' => true, 'participant' => $participant]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Helper method untuk mencari participant berdasarkan event type dan id
    private function findParticipant($eventType, $id)
    {
        switch ($eventType) {
            case 'artopia':
                return ArtopiaData::find($id);
            case 'ancient':
                return AncientData::find($id);
            default:
                return null;
        }
    }

    // Helper method untuk mendapatkan nama event
    private function getEventName($eventType)
    {
        switch ($eventType) {
            case 'artopia':
                return 'Artopia';
            case 'ancient':
                return 'Ancient';
            default:
                return 'Unknown Event';
        }
    }
}