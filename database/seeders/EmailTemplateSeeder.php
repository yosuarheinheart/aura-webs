<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    public function run()
    {
        $templates = [
            // Artopia Templates
            [
                'program_type' => 'artopia',
                'status_type' => 'accepted',
                'subject' => 'Selamat! Anda Diterima di Program Artopia',
                'message' => 'Halo {nama},

Selamat! Kami dengan senang hati memberitahukan bahwa aplikasi Anda untuk booth "{nama_booth}" di program Artopia telah DITERIMA.

Terima kasih atas partisipasi Anda. Silakan tunggu informasi lebih lanjut mengenai tahapan selanjutnya yang akan kami kirimkan melalui email ini.

Salam hangat,
Tim Artopia',
                'is_active' => true
            ],
            [
                'program_type' => 'artopia',
                'status_type' => 'rejected',
                'subject' => 'Pemberitahuan Hasil Seleksi Program Artopia',
                'message' => 'Halo {nama},

Terima kasih atas partisipasi Anda dalam program Artopia. Setelah melalui proses seleksi yang ketat, kami mohon maaf harus memberitahukan bahwa aplikasi Anda untuk booth "{nama_booth}" belum dapat kami terima pada kesempatan kali ini.

Jangan berkecil hati! Kami menghargai semangat dan dedikasi Anda. Tetap semangat untuk kesempatan selanjutnya.

Salam hangat,
Tim Artopia',
                'is_active' => true
            ],
            [
                'program_type' => 'artopia',
                'status_type' => 'pending',
                'subject' => 'Status Aplikasi Anda di Program Artopia',
                'message' => 'Halo {nama},

Terima kasih telah mendaftar di program Artopia untuk booth "{nama_booth}". 

Kami ingin memberitahukan bahwa aplikasi Anda sedang dalam proses review oleh tim kami. Mohon bersabar menunggu informasi lebih lanjut.

Kami akan segera menghubungi Anda dengan hasil seleksi.

Salam hangat,
Tim Artopia',
                'is_active' => true
            ],

            // Ancient Templates
            [
                'program_type' => 'ancient',
                'status_type' => 'accepted',
                'subject' => 'Selamat! Anda Diterima di Program Ancient',
                'message' => 'Halo {nama},

Selamat! Kami dengan senang hati memberitahukan bahwa aplikasi Anda untuk lokasi "{lokasi_pilihan}" di program Ancient telah DITERIMA.

Terima kasih atas partisipasi Anda. Silakan tunggu informasi lebih lanjut mengenai tahapan selanjutnya yang akan kami kirimkan melalui email ini.

Salam hangat,
Tim Ancient',
                'is_active' => true
            ],
            [
                'program_type' => 'ancient',
                'status_type' => 'rejected',
                'subject' => 'Pemberitahuan Hasil Seleksi Program Ancient',
                'message' => 'Halo {nama},

Terima kasih atas partisipasi Anda dalam program Ancient. Setelah melalui proses seleksi yang ketat, kami mohon maaf harus memberitahukan bahwa aplikasi Anda untuk lokasi "{lokasi_pilihan}" belum dapat kami terima pada kesempatan kali ini.

Jangan berkecil hati! Kami menghargai semangat dan dedikasi Anda. Tetap semangat untuk kesempatan selanjutnya.

Salam hangat,
Tim Ancient',
                'is_active' => true
            ],
            [
                'program_type' => 'ancient',
                'status_type' => 'pending',
                'subject' => 'Status Aplikasi Anda di Program Ancient',
                'message' => 'Halo {nama},

Terima kasih telah mendaftar di program Ancient untuk lokasi "{lokasi_pilihan}". 

Kami ingin memberitahukan bahwa aplikasi Anda sedang dalam proses review oleh tim kami. Mohon bersabar menunggu informasi lebih lanjut.

Kami akan segera menghubungi Anda dengan hasil seleksi.

Salam hangat,
Tim Ancient',
                'is_active' => true
            ],
        ];

        foreach ($templates as $template) {
            EmailTemplate::updateOrCreate(
                [
                    'program_type' => $template['program_type'],
                    'status_type' => $template['status_type']
                ],
                $template
            );
        }
    }
}