<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\ArtopiaData;

class ArtopiaController extends Controller
{
    public function showForm()
    {
        return view('artopia.registration');
    }
    
    public function getNextAvailableId() {
        // Fungsi ini sudah benar, tidak perlu diubah.
        // Ia akan mencari ID terkecil yang tersedia.
        $existingIds = ArtopiaData::orderBy('id')->pluck('id')->toArray();
        $i = 1;
        foreach ($existingIds as $id) {
            if ($i < $id) {
                break; // Ditemukan celah ID
            }
            $i++;
        }
        return $i;
    }

    public function store(Request $request)
    {
        Log::info('Artopia Registration - Request Data:', $request->all());
        Log::info('Artopia Registration - Files:', $request->allFiles());

        // Validasi input dasar
        $rules = [
            'namaLengkap' => 'required|string|max:50',
            'nim' => 'required|integer|unique:artopia_data,nim',
            'angkatan' => 'required|string|max:4|in:2022,2023,2024',
            'email' => 'required|email|max:50|unique:artopia_data,email',
            'idLine' => 'required|string|max:20',
            'instagram' => 'required|string|max:15',
            'namaBooth' => 'required|string|max:20',
            'deskripsiBooth' => 'required|string|max:100',
            'tanggalBooth' => 'required|string|in:29-30 September 2025,01-02 Oktober 2025',
            'dokumenPendukung' => 'required|file|mimes:pdf|max:10240',
        ];

        $messages = [
            'namaLengkap.required' => 'Nama lengkap harus diisi',
            'nim.required' => 'NIM harus diisi',
            'nim.integer' => 'NIM harus berupa angka',
            'nim.unique' => 'NIM Anda sudah terdaftar',
            'angkatan.required' => 'Angkatan harus dipilih',
            'angkatan.in' => 'Angkatan yang dipilih tidak valid',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'idLine.required' => 'ID Line harus diisi',
            'instagram.required' => 'Username Instagram harus diisi',
            'namaBooth.required' => 'Nama booth harus diisi',
            'deskripsiBooth.required' => 'Deskripsi booth harus diisi',
            'tanggalBooth.required' => 'Tanggal booth harus dipilih',
            'tanggalBooth.in' => 'Tanggal booth yang dipilih tidak valid',
            'dokumenPendukung.required' => 'File dokumen pendukung harus diunggah',
            'dokumenPendukung.file' => 'Dokumen pendukung harus berupa file',
            'dokumenPendukung.mimes' => 'File dokumen harus berformat PDF',
            'dokumenPendukung.max' => 'Ukuran file dokumen maksimal 10MB',
        ];

        if ($request->filled('namaKelompok')) {
            $rules['namaKelompok'] = 'string|max:20';
            
            for ($i = 1; $i <= 4; $i++) {
                if ($request->filled("namaAnggota{$i}")) {
                    $rules["namaAnggota{$i}"] = 'string|max:50';
                    // --- PERBAIKAN 1: Tambahkan validasi 'unique' untuk NIM anggota ---
                    $rules["nimAnggota{$i}"] = 'required|integer|unique:artopia_data,nim';
                    
                    $messages["namaAnggota{$i}.string"] = "Nama anggota {$i} harus berupa teks";
                    $messages["namaAnggota{$i}.max"] = "Nama anggota {$i} maksimal 50 karakter";
                    $messages["nimAnggota{$i}.required"] = "NIM anggota {$i} harus diisi";
                    $messages["nimAnggota{$i}.integer"] = "NIM anggota {$i} harus berupa angka";
                    // --- PENAMBAHAN 1: Pesan error untuk validasi 'unique' ---
                    $messages["nimAnggota{$i}.unique"] = "NIM anggota {$i} sudah terdaftar";
                }
            }
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Log::warning('Artopia Registration - Validation Failed:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Log::info('Artopia Registration - Starting file upload process');

            $dokumenFile = $request->file('dokumenPendukung');
            $fileName = time() . '_' . $request->nim . '_' . $dokumenFile->getClientOriginalName();
            
            Log::info('Artopia Registration - File Info:', [
                'original_name' => $dokumenFile->getClientOriginalName(),
                'size' => $dokumenFile->getSize(),
                'mime_type' => $dokumenFile->getMimeType(),
                'generated_name' => $fileName
            ]);

            $filePath = $dokumenFile->storeAs('dokumen_artopia', $fileName, 'public');
            
            Log::info('Artopia Registration - File uploaded successfully:', ['path' => $filePath]);

            Log::info('Artopia Registration - Starting database insert');
            
            // --- PERBAIKAN 2: Logika ID diubah ---
            // Dapatkan ID untuk KETUA terlebih dahulu
            $ketuaId = $this->getNextAvailableId();
            $insertData = [
                'id' => $ketuaId, 
                'nama_kelompok' => $request->namaKelompok ?? null,
                'nama_lengkap' => $request->namaLengkap,
                'nim' => $request->nim,
                'angkatan' => $request->angkatan,
                'email' => $request->email,
                'id_line' => $request->idLine,
                'instagram' => $request->instagram,
                'nama_booth' => $request->namaBooth,
                'deskripsi_booth' => $request->deskripsiBooth,
                'tanggal_booth' => $request->tanggalBooth,
                'dokumen_pendukung' => $filePath,
                'status_seleksi' => 'pending',
            ];

            Log::info('Artopia Registration - Insert Data (Leader):', $insertData);
            $mainParticipant = ArtopiaData::create($insertData);
            Log::info('Artopia Registration - Main participant inserted successfully with ID: ' . $mainParticipant->id);

            if ($request->filled('namaKelompok')) {
                Log::info('Artopia Registration - Processing additional members');
                
                for ($i = 1; $i <= 4; $i++) {
                    if ($request->filled("namaAnggota{$i}") && $request->filled("nimAnggota{$i}")) {
                        // --- PERBAIKAN 3: Dapatkan ID BARU untuk SETIAP ANGGOTA ---
                        $memberId = $this->getNextAvailableId();
                        
                        $memberData = [
                            'id' => $memberId, // Gunakan ID baru yang unik untuk anggota
                            'nama_kelompok' => $request->namaKelompok,
                            'nama_lengkap' => $request->input("namaAnggota{$i}"),
                            'nim' => $request->input("nimAnggota{$i}"),
                            'angkatan' => $request->angkatan,
                            'email' => $request->email . "_member{$i}", // Email anggota tidak dikumpulkan, set ke null
                            'id_line' => '-',
                            'instagram' => '-',
                            'nama_booth' => $request->namaBooth,
                            'deskripsi_booth' => $request->deskripsiBooth,
                            'tanggal_booth' => $request->tanggalBooth,
                            'dokumen_pendukung' => $filePath,
                            'status_seleksi' => 'pending',
                        ];

                        Log::info("Artopia Registration - Inserting member {$i} with new ID {$memberId}:", $memberData);
                        ArtopiaData::create($memberData);
                        Log::info("Artopia Registration - Member {$i} inserted successfully");
                    }
                }
            }

            Log::info('Artopia Registration - All data inserted successfully');

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil! Terima kasih telah mendaftar untuk Artopia. Tim panitia akan menghubungi Anda segera untuk informasi lebih lanjut.'
            ]);

        } catch (\Exception $e) {
            Log::error('Artopia Registration - Error occurred:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                Log::info('Artopia Registration - Uploaded file deleted due to error');
            }

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
                'debug_message' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}