<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Seleksi Ancient Academy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        .status-lolos {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-tidak-lolos {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .content {
            margin: 20px 0;
        }
        .info-box {
            background-color: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9em;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 style="color: #E35434; margin-bottom: 10px;">Ancient Academy</h1>
            <h2>Status Pendaftaran Volunteer</h2>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $data->nama_lengkap }}</strong>!</p>
            
            @if($data->status_seleksi === 'pending')
                <p>Terima kasih telah mendaftar sebagai volunteer Ancient Academy. Pendaftaran Anda telah kami terima dengan detail sebagai berikut:</p>
                
                <div class="info-box">
                    <strong>Detail Pendaftaran:</strong><br>
                    NIM: {{ $data->nim }}<br>
                    Angkatan: {{ $data->angkatan }}<br>
                    Email: {{ $data->email }}<br>
                    Lokasi Pilihan: {{ $data->lokasi_pilihan }}<br>
                    Waktu Pendaftaran: {{ $data->timestamp->format('d F Y, H:i') }} WIB
                </div>

                <p>Status seleksi Anda saat ini adalah:</p>
                <div class="status-badge status-pending">{{ ucfirst($data->status_seleksi) }}</div>
                
                <p>Tim kami akan meninjau detail data yang telah Anda kirimkan dan memberikan update status seleksi dalam beberapa hari ke depan. Harap pantau email Anda secara berkala.</p>
                
            @elseif($data->status_seleksi === 'lolos')
                <p>Selamat! Anda telah <strong>LOLOS</strong> seleksi volunteer Ancient Academy.</p>
                <div class="status-badge status-lolos">{{ ucfirst($data->status_seleksi) }}</div>
                
                <p>Silahkan ikuti instruksi selanjutnya yang akan dikirimkan secara terpisah mengenai:</p>
                <ul>
                    <li>Pembayaran sebesar Rp 60.000</li>
                    <li>Jadwal kegiatan</li>
                    <li>Persiapan yang diperlukan</li>
                </ul>
                
                @if($data->catatan_admin)
                    <div class="info-box">
                        <strong>Catatan:</strong><br>
                        {{ $data->catatan_admin }}
                    </div>
                @endif
                
            @elseif($data->status_seleksi === 'gagal')
                <p>Terima kasih atas partisipasi Anda dalam seleksi volunteer Ancient Academy.</p>
                <div class="status-badge status-tidak-lolos">Tidak Lolos</div>
                
                <p>Meskipun kali ini Anda belum terpilih, jangan berkecil hati. Masih banyak kesempatan lain untuk berkontribusi dalam kegiatan-kegiatan AURA UMN di masa mendatang.</p>
                
                @if($data->catatan_admin)
                    <div class="info-box">
                        <strong>Feedback:</strong><br>
                        {{ $data->catatan_admin }}
                    </div>
                @endif
            @endif
        </div>

        <div class="footer">
            <p>Jika ada pertanyaan, silakan hubungi kami melalui:</p>
            <p>Email: <a href="mailto:auraumn@gmail.com">auraumn@gmail.com</a></p>
            <p>Instagram: <a href="https://instagram.com/auraumn">@auraumn</a></p>
            <hr style="margin: 20px 0;">
            <p><strong>Aura 2025<br>Universitas Multimedia Nusantara</strong></p>
            <p style="font-size: 0.8em; color: #999;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>