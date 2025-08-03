<footer style="background: linear-gradient(to top, #2e0066, #6c2c74); color: white; padding: 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; font-family: 'Poppins'">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 30px; align-items: center;">
            
            {{-- Kolom Kiri - Informasi Universitas --}}
            <div style="text-align: left;">
                <h3 style="font-size: 16px; font-weight: bold; margin-top:10px;margin-bottom: 25px; line-height: 1.4;">
                    Universitas Multimedia Nusantara
                </h3>
                <p style="font-size: 14px; line-height: 1.6; margin-bottom: 70px;">
                    Jl Scientia Boulevard, Gading Serpong<br>
                    Tangerang, Banten - 15811 Indonesia
                </p>
                
                
                {{-- Social Media Icons --}}
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
                <div style="display: flex; gap: 20px;">
                    <a href="https://www.instagram.com/aura.umn/?hl=en" target="_blank">
                        <i class="bi bi-instagram" style="font-size: 30px; color: white;"></i>
                    </a>
                    <a href="mailto:auraumn@gmail.com">
                        <i class="bi bi-envelope" style="font-size: 30px; color: white;"></i>
                    </a>
                    <a href="#">
                        <i class="bi bi-globe" style="font-size: 30px; color: white;"></i>
                    </a>
                </div>
            </div>

            {{-- Kolom Tengah - Logo AURA 2025 --}}
            <div style="text-align: center;">
                <div style="display: inline-block;">
                    <img src="{{ asset('asset/logoaura2025.png') }}" 
                         alt="AURA 2025" 
                         style="width: 250px; height: 250px; object-fit: contain; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));">
                </div>
            </div>

            {{-- Kolom Kanan - Tagline dan Logo UMN --}}
            <div style="text-align: right; margin-top:10px;">
                <div style="margin-bottom: 25px;">
                    <h2 style="font-size: 24px; font-weight: bold; font-style: italic; font-family:'Rafaella';line-height: 1.3; margin: 0;">
                        Beyond The Clock,<br>
                       Creativity Unlock
                    </h2>
                </div>
                
                {{-- Logo UMN --}}
                <div style="display: flex; justify-content: flex-end; margin-top: 50px;">
                    <div style="text-align: right;">
                        <img src="{{ asset('asset/logoumn.png') }}" 
                             alt="UMN Logo" 
                             style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 8px;">
                        <img src="{{ asset('asset/logohmdkv.png') }}" 
                             alt="hmdkv Logo" 
                             style="width: 100px; height: 100px; object-fit: contain; margin-left:5px;margin-bottom: 8px;">
                    </div>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.2); text-align: center;">
            <p style="font-size: 12px; opacity: 0.8; margin: 0;">
                © {{ date('Y') }} AURA UMN. All rights reserved  
            </p>
        </div>
    </div>
</footer>

{{-- CSS --}}
<style>

/* Responsive Design */
@media (max-width: 768px) {
    footer div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
        text-align: center !important;
    }
    
    footer div[style*="text-align: left"] {
        text-align: center !important;
        justify-content: center !important;
    }
    
    footer div[style*="text-align: right"] {
        text-align: center !important;
    }
    
    footer div[style*="justify-content: flex-end"] {
        justify-content: center !important;
    }

    footer div[style*="display: flex"][style*="gap: 20px"] {
        justify-content: center !important;
    }
    
    footer h2 {
        font-size: 20px !important;
    }
    
    footer img {
        width: 100px !important;
        height: 100px !important;
    }
}

@media (max-width: 480px) {
    footer {
        padding: 30px 0 !important;
    }
    
    footer div[style*="max-width: 1200px"] {
        padding: 0 15px !important;
    }
    
     footer div[style*="display: flex"][style*="gap: 20px"] {
        justify-content: center !important;
    }
    
    footer h2 {
        font-size: 18px !important;
    }
    
    footer h3 {
        font-size: 14px !important;
    }
    
    footer img {
        width: 80px !important;
        height: 80px !important;
    }
}
</style>