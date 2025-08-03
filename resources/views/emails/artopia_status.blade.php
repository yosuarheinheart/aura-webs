<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran Artopia Creative Market</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #3289B5 0%, #6EDFDC 50%, #DDF135 100%);
            background-attachment: fixed;
            min-height: 100vh;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(50, 137, 181, 0.3);
            border: 1px solid rgba(110, 223, 220, 0.3);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px 0;
            background: linear-gradient(135deg, #3289B5 0%, #6EDFDC 50%, #DDF135 100%);
            border-radius: 12px;
            margin: -15px -15px 30px -15px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        .header > * {
            position: relative;
            z-index: 1;
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: white;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .status-badge {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 14px;
            margin: 15px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .status-pending {
            background: linear-gradient(135deg, #6EDFDC, #DDF135);
            color: #2c5234;
            border: 2px solid #6EDFDC;
        }
        .status-lolos {
            background: linear-gradient(135deg, #DDF135, #6EDFDC);
            color: #2c5234;
            border: 2px solid #DDF135;
        }
        .status-tidak-lolos {
            background: linear-gradient(135deg, #3289B5, #6EDFDC);
            color: white;
            border: 2px solid #3289B5;
        }
        .content {
            margin: 20px 0;
        }
        .detail-box {
            background: linear-gradient(135deg, rgba(50, 137, 181, 0.05) 0%, rgba(110, 223, 220, 0.1) 50%, rgba(221, 241, 53, 0.05) 100%);
            border-left: 5px solid #3289B5;
            border-right: 5px solid #6EDFDC;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(50, 137, 181, 0.1);
        }
        .detail-box h3 {
            background: linear-gradient(135deg, #3289B5, #6EDFDC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .detail-row {
            display: flex;
            margin: 12px 0;
            padding: 8px 0;
            border-bottom: 1px solid rgba(110, 223, 220, 0.2);
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            min-width: 140px;
            color: #3289B5;
        }
        .detail-value {
            flex: 1;
            color: #333;
            font-weight: 500;
        }
        .next-steps {
            background: linear-gradient(135deg, rgba(110, 223, 220, 0.1) 0%, rgba(221, 241, 53, 0.1) 100%);
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
            border: 2px solid rgba(110, 223, 220, 0.3);
            box-shadow: 0 4px 15px rgba(110, 223, 220, 0.2);
        }
        .next-steps h3 {
            background: linear-gradient(135deg, #3289B5, #6EDFDC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-top: 0;
        }
        .next-steps ul li {
            margin: 10px 0;
            color: #2c5234;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 25px 20px 20px;
            background: linear-gradient(135deg, rgba(50, 137, 181, 0.05) 0%, rgba(110, 223, 220, 0.05) 100%);
            border-radius: 12px;
            border-top: 3px solid #6EDFDC;
            color: #3289B5;
            font-size: 14px;
        }
        .contact-info {
            margin: 15px 0;
            font-size: 14px;
            color: #3289B5;
        }
        .contact-info strong {
            color: #2c5234;
        }
        h2 {
            background: linear-gradient(135deg, #3289B5, #6EDFDC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .email-container {
                padding: 20px;
            }
            .detail-row {
                flex-direction: column;
            }
            .detail-label {
                min-width: auto;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">🎨 ARTOPIA CREATIVE MARKET</div>
            <p style="margin: 0; color: #666;">Universitas Multimedia Nusantara</p>
        </div>

        <div class="content">
            @if($registration->status_seleksi == 'pending')
                <h2 style="margin-bottom: 10px;">✅ Pendaftaran Berhasil Diterima!</h2>
                <div class="status-badge status-pending">PENDING REVIEW</div>
                
                <p>Halo <strong>{{ $registration->nama_lengkap }}</strong>,</p>
                
                <p>Terima kasih telah mendaftar untuk <strong>Artopia Creative Market</strong>! Kami telah menerima pendaftaran booth Anda dan sedang dalam tahap review.</p>

                <div class="detail-box">
                    <h3 style="margin-top: 0;">📋 Detail Pendaftaran Anda:</h3>
                    
                    <div class="detail-row">
                        <span class="detail-label">Nama Booth:</span>
                        <span class="detail-value">{{ $registration->nama_booth }}</span>
                    </div>
                    
                    @if($registration->nama_kelompok)
                    <div class="detail-row">
                        <span class="detail-label">Nama Kelompok:</span>
                        <span class="detail-value">{{ $registration->nama_kelompok }}</span>
                    </div>
                    @endif
                    
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Booth:</span>
                        <span class="detail-value">{{ $registration->tanggal_booth }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Waktu Daftar:</span>
                        <span class="detail-value">{{ $registration->timestamp->format('d F Y, H:i') }} WIB</span>
                    </div>
                </div>

                <div class="next-steps">
                    <h3 style="margin-top: 0;">🔄 Langkah Selanjutnya:</h3>
                    <ul style="margin: 10px 0; padding-left: 20px;">
                        <li>Tim panitia akan melakukan review terhadap pendaftaran dan dokumen yang Anda kirimkan</li>
                        <li>Proses review memakan waktu 3-5 hari kerja</li>
                        <li>Hasil seleksi akan dikirimkan melalui email ini</li>
                        <li>Pastikan untuk mengecek email secara berkala (termasuk folder spam)</li>
                    </ul>
                </div>

            @elseif($registration->status_seleksi == 'lolos')
                <h2 style="margin-bottom: 10px;">🎉 Selamat! Anda Lolos Seleksi!</h2>
                <div class="status-badge status-lolos">LOLOS SELEKSI</div>
                
                <p>Selamat <strong>{{ $registration->nama_lengkap }}</strong>!</p>
                
                <p>Kami dengan senang hati mengumumkan bahwa booth "<strong>{{ $registration->nama_booth }}</strong>" Anda telah <strong>lolos seleksi</strong> untuk mengikuti Artopia Creative Market!</p>

                <div class="detail-box">
                    <h3 style="margin-top: 0;">✅ Informasi Booth Anda:</h3>
                    
                    <div class="detail-row">
                        <span class="detail-label">Nama Booth:</span>
                        <span class="detail-value">{{ $registration->nama_booth }}</span>
                    </div>
                    
                    @if($registration->nama_kelompok)
                    <div class="detail-row">
                        <span class="detail-label">Nama Kelompok:</span>
                        <span class="detail-value">{{ $registration->nama_kelompok }}</span>
                    </div>
                    @endif
                    
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Booth:</span>
                        <span class="detail-value">{{ $registration->tanggal_booth }}</span>
                    </div>
                </div>

                <div class="next-steps">
                    <h3 style="margin-top: 0;">📌 Langkah Selanjutnya:</h3>
                    <ul style="margin: 10px 0; padding-left: 20px;">
                        <li><strong>Briefing Wajib:</strong> Hadir pada sesi briefing yang akan dijadwalkan terpisah</li>
                        <li><strong>Persiapan Booth:</strong> Siapkan produk dan dekorasi booth sesuai dengan yang telah didaftarkan</li>
                        <li><strong>Persyaratan Teknis:</strong> Ikuti semua ketentuan teknis yang akan disampaikan saat briefing</li>
                        <li><strong>Komunikasi:</strong> Bergabung dengan grup WhatsApp peserta yang linknya akan dikirimkan terpisah</li>
                    </ul>
                </div>

                @if($registration->catatan_admin)
                <div style="background: linear-gradient(135deg, rgba(221, 241, 53, 0.1) 0%, rgba(110, 223, 220, 0.1) 100%); padding: 20px; border-radius: 10px; border: 2px solid rgba(221, 241, 53, 0.4); margin: 20px 0; box-shadow: 0 4px 15px rgba(221, 241, 53, 0.2);">
                    <h4 style="margin-top: 0; color: #2c5234;">📝 Catatan dari Panitia:</h4>
                    <p style="margin-bottom: 0; color: #2c5234; font-weight: 500;">{{ $registration->catatan_admin }}</p>
                </div>
                @endif

            @elseif($registration->status_seleksi == 'gagal')
                <h2 style="margin-bottom: 10px;">Hasil Seleksi Artopia Creative Market</h2>
                <div class="status-badge status-tidak-lolos">TIDAK LOLOS SELEKSI</div>
                
                <p>Halo <strong>{{ $registration->nama_lengkap }}</strong>,</p>
                
                <p>Terima kasih atas partisipasi Anda dalam pendaftaran Artopia Creative Market. Setelah melalui proses seleksi yang ketat, kami dengan berat hati harus mengumumkan bahwa booth "<strong>{{ $registration->nama_booth }}</strong>" belum dapat kami terima pada kesempatan kali ini.</p>

                <div class="detail-box">
                    <h3 style="margin-top: 0;">📋 Detail Pendaftaran:</h3>
                    
                    <div class="detail-row">
                        <span class="detail-label">Nama Booth:</span>
                        <span class="detail-value">{{ $registration->nama_booth }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Daftar:</span>
                        <span class="detail-value">{{ $registration->timestamp->format('d F Y') }}</span>
                    </div>
                </div>

                @if($registration->catatan_admin)
                <div style="background: linear-gradient(135deg, rgba(221, 241, 53, 0.1) 0%, rgba(110, 223, 220, 0.1) 100%); padding: 20px; border-radius: 10px; border: 2px solid rgba(221, 241, 53, 0.4); margin: 20px 0; box-shadow: 0 4px 15px rgba(221, 241, 53, 0.2);">
                    <h4 style="margin-top: 0; color: #2c5234;">📝 Catatan dari Panitia:</h4>
                    <p style="margin-bottom: 0; color: #2c5234; font-weight: 500;">{{ $registration->catatan_admin }}</p>
                </div>
                @endif

                <div class="next-steps">
                    <h3 style="margin-top: 0;">💡 Saran untuk Ke Depan:</h3>
                    <ul style="margin: 10px 0; padding-left: 20px;">
                        <li>Terus kembangkan konsep dan kualitas produk Anda</li>
                        <li>Nantikan event-event kreatif lainnya di Aura UMN</li>
                        <li>Bergabunglah dengan komunitas kreatif untuk terus belajar dan berkembang</li>
                        <li>Jangan menyerah dan terus berkarya!</li>
                    </ul>
                </div>
            @endif
        </div>

        <div class="footer">
            <div class="contact-info">
                <strong>📞 Kontak Panitia Artopia:</strong><br>
                Email: auraumn@gmail.com<br>
                Instagram: @auraumn<br>
            </div>
            
            <hr style="margin: 20px 0; border: none; border-top: 2px solid rgba(110, 223, 220, 0.3);">
            
            <p style="margin: 5px 0; color: #3289B5; font-size: 12px;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.<br>
                Jika ada pertanyaan, silakan hubungi kontak panitia di atas.
            </p>
            
            <p style="margin: 10px 0 0 0; color: #3289B5; font-size: 13px; font-weight: 600;">
                <strong>🎨 AURA UMN 2025</strong><br>
                Universitas Multimedia Nusantara<br>
                Tangerang, Indonesia
            </p>
        </div>
    </div>
</body>
</html>