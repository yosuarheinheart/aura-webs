<?php

namespace App\Http\Controllers;

use App\Models\AncientData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\getNextAvailableId;
// Mail dan SelectionStatusMail tidak lagi digunakan secara langsung di sini
// use Illuminate\Support\Facades\Mail;
// use App\Mail\SelectionStatusMail;

class AncientAcademyController extends Controller
{
    public function showForm()
    {
        return view('ancient.registration');
    }

    public function getNextAvailableId() {
        $existingIds = AncientData::orderBy('id')->pluck('id')->toArray();
        $i = 1;
        foreach ($existingIds as $id) {
            if ($i < $id) {
                break; // Ada lubang di ID
            }
            $i++;
        }
        return $i;
    }


    public function store(Request $request)
    {
        // Log awal proses registrasi
        Log::info('=== ANCIENT ACADEMY REGISTRATION START ===');
        Log::info('Email to register: ' . $request->email);

        // 1. Validasi input (Kode validasi tetap sama)
        $validator = Validator::make($request->all(), [
            'namaLengkap' => 'required|string|max:50',
            'nim' => 'required|integer|unique:ancient_data,nim',
            'angkatan' => 'required|string|in:2022,2023,2024',
            'email' => 'required|email|max:50|unique:ancient_data,email',
            'idLine' => 'required|string|max:20',
            'instagram' => 'required|string|max:20',
            'lokasi' => 'required|string|in:Tangerang,Sukabumi',
            'esaiMotivasi' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'agreements' => 'required|array|size:3'
        ], [
            // Pesan error validasi tetap sama
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed for email: ' . $request->email);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // 2. Handle file upload
            $esaiFile = $request->file('esaiMotivasi');
            $originalFileName = $esaiFile->getClientOriginalName();
            $fileName = $request->nim . '_' . time() . '_' . $originalFileName;
            $filePath = $esaiFile->storeAs('dokumen_esai', $fileName, 'public');

            Log::info('File uploaded successfully: ' . $fileName);

            // 3. Simpan data ke database
            // Saat baris ini dieksekusi, event 'created' di model AncientData akan otomatis berjalan
            // dan mengirimkan email.
            $newId = $this->getNextAvailableId();
            $registration = AncientData::create([
                'id' => $newId, 
                'nama_lengkap' => $request->namaLengkap,
                'nim' => $request->nim,
                'angkatan' => $request->angkatan,
                'email' => $request->email,
                'id_line' => $request->idLine,
                'instagram' => $request->instagram,
                'lokasi_pilihan' => $request->lokasi,
                'dokumen_esai' => $filePath,
                'status_seleksi' => 'pending',
            ]);

            Log::info('Registration data saved successfully with ID: ' . $registration->id . '. Email sending will be handled by the model event.');

            // 4. Langsung kembalikan response sukses.
            // Blok pengiriman email di sini DIHAPUS.
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil! Email konfirmasi akan segera dikirim ke ' . $registration->email,
                'data' => [
                    'id' => $registration->id,
                    'nama' => $registration->nama_lengkap,
                    'email' => $registration->email,
                    'timestamp' => $registration->timestamp->format('d F Y, H:i') . ' WIB'
                ]
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error during registration: ' . $e->getMessage());
            
            if ($e->errorInfo[1] === 1062) {
                return response()->json([
                    'success' => false,
                    'errors' => ['nim' => ['NIM atau Email sudah terdaftar di database.']]
                ], 422);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada database. Silahkan coba lagi.'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Unexpected error during registration: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan tidak terduga. Silahkan coba lagi atau hubungi admin.'
            ], 500);
        }
    }
}