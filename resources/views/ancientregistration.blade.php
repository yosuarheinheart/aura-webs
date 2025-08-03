<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Ancient Academy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.css" integrity="sha512-6R+/aZAbKDxn6/g+k2O68ulW3bD26ELehXubrIPM1vUfIXETpTdT4+Or6v53tNJcNkcyu4zxs0Cu9kkJAit0YQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css" integrity="sha512-v8QQ0YQ3H4K6Ic3PJkym91KoeNT5S3PnDKvqnwqFD1oiqIl653crGZplPdU5KKtHjO0QKcQ2aUlQZYjHczkmGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/regishandler.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/ancientregistration.css') }}">
</head>

 @include('layouts.navbar')
 
<body>
    <div class="main-content">
        <div class="container-regis-ancient">
        <div class="header-regis-ancient">
            <img src="{{ asset('asset/ancient/TITLE.png') }}" width="300px" height="auto" alt="Artopia Title" class="ancient-title-img">
            <p style="font-family:'Altone Trial'; font-size:1.4rem">Form Pendaftaran Volunteer</p>
        </div>  

        <div class="progress-container">
            <div class="progress-steps">
                <div class="progress-line" id="progressLine"></div>
                <div class="step active" data-step="1">
                    1
                    <div class="step-label">Identitas<br>Pribadi</div>
                </div>
                <div class="step" data-step="2">
                    2
                    <div class="step-label">Dokumen</div>
                </div>
                <div class="step" data-step="3">
                    3
                    <div class="step-label">Akses Twibbon<br>& Caption</div>
                </div>
            </div>
        </div>

        <form id="registrationForm">
            <!-- Section 1: Identitas Pribadi -->
            <div class="form-section active" data-section="1">
                <h2 class="section-title">Identitas Pribadi</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="namaLengkap" class="required">Nama Lengkap</label>
                        <input type="text" id="namaLengkap" name="namaLengkap" required>
                        <div class="error-message">Nama lengkap harus diisi</div>
                    </div>
                    <div class="form-group">
                        <label for="nim" class="required">NIM</label>
                        <input type="text" id="nim" name="nim" placeholder="Contoh: 77310 (5/6 digit terakhir saja)" required>
                        <div class="error-message">NIM harus diisi</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="angkatan" class="required">Angkatan</label>
                        <select id="angkatan" name="angkatan" required>
                            <option value="">Pilih Angkatan</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                        <div class="error-message">Angkatan harus dipilih</div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="required">E-mail Pribadi</label>
                        <input type="email" id="email" name="email" required>
                        <div class="error-message">Email valid harus diisi</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="idLine" class="required">ID Line</label>
                        <input type="text" id="idLine" name="idLine" required>
                        <div class="error-message">ID Line harus diisi</div>
                    </div>
                    <div class="form-group">
                        <label for="instagram" class="required">Username Instagram</label>
                        <input type="text" id="instagram" name="instagram" required>
                        <div class="error-message">Username Instagram harus diisi</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lokasi" class="required">Pilih lokasi Ancient Academy yang ingin diikuti</label>
                    <select id="lokasi" name="lokasi" required>
                        <option value="">Pilih Lokasi</option>
                        <option value="Tangerang">Tangerang</option>
                        <option value="Sukabumi">Sukabumi</option>
                    </select>
                    <div class="error-message">Lokasi harus dipilih</div>
                </div>

                <div class="button-group">
                    <div></div>
                    <button type="button" class="btn btn-primary" onclick="nextSection()">Selanjutnya</button>
                </div>
            </div>

            <!-- Section 2: Dokumen -->
            <div class="form-section" data-section="2">
                <h2 class="section-title">Dokumen</h2>
                
                <div class="form-group">
                    <label for="esaiMotivasi" class="required">Esai Motivasi</label>
                    <div class="file-upload">
                        <input type="file" id="esaiMotivasi" name="esaiMotivasi" class="file-input" accept=".pdf,.doc,.docx" required>
                        <label for="esaiMotivasi" class="file-label" id="fileUploadLabel">
                            📄 Unggah file esai motivasi disini
                        </label>
                    </div>
                    <div class="uploaded-file-info" id="uploadedFileInfo" style="display: none;">
                        <span class="file-name-link" id="fileNameLink"></span>
                        <span class="upload-status">File berhasil diunggah! Klik nama file untuk membuka.</span>
                    </div>
                    <div class="file-info">
                        *Tuliskan esai singkat (min. 400 kata) dengan menjawab pertanyaan:<br>
                        "Mengapa kamu ingin menjadi volunteer Ancient Academy dan apa kontribusi yang ingin kamu berikan dalam kegiatan ini?"<br>
                        Format: PDF, DOC, atau DOCX
                    </div>
                    <div class="error-message">File esai motivasi harus diunggah</div>
                </div>

                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="dataBenar" name="agreements" value="dataBenar" required>
                        <label for="dataBenar">Saya menyatakan bahwa data yang saya isi adalah benar.</label>
                    </div>
                    
                    <div class="checkbox-item">
                        <input type="checkbox" id="bersediaKegiatan" name="agreements" value="bersediaKegiatan" required>
                        <label for="bersediaKegiatan">Saya bersedia mengikuti seluruh rangkaian kegiatan jika terpilih.</label>
                    </div>
                    
                    <div class="checkbox-item">
                        <input type="checkbox" id="bersediaBayar" name="agreements" value="bersediaBayar" required>
                        <label for="bersediaBayar">Saya bersedia melakukan pembayaran sebesar Rp 60.000 jika dinyatakan lolos sebagai volunteer.</label>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="prevSection()">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" onclick="nextSection()">Selanjutnya</button>
                </div>
            </div>

            <!-- Section 3: Akses Twibbon & Caption -->
            <div class="form-section" data-section="3">
                <h2 class="section-title">Akses Twibbon & Caption</h2>
                
                <div class="twibbon-section">
                    <h3 style="color: #E35434; margin-bottom: 20px;">Download Twibbon Ancient Academy</h3>
                    <p style="margin-bottom: 20px; color: #666;">
                        Klik tombol di bawah untuk mengakses dan mendownload twibbon Ancient Academy
                    </p>
                    <a href="#" class="twibbon-btn" onclick="accessTwibbon()">
                        🎨 Akses Twibbon
                    </a>
                    <p style="margin-top: 15px; font-size: 0.9rem; color: #888;">
                        Pastikan untuk menggunakan twibbon ini di media sosial Anda
                    </p>
                </div>

                <div class="button-group" id="section3Buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevSection()" id="prevBtn3">Sebelumnya</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        Submit
                    </button>
                </div>

                <div class="button-group" id="section3ButtonsCenter" style="display: none; justify-content: center;">
                    <button type="submit" class="btn btn-primary" id="submitBtnCenter">
                        Submit
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <script>
        let currentSection = 1;
        const totalSections = 3;

        // Form data storage
        let formData = {};

        function updateProgressBar() {
            const progressLine = document.getElementById('progressLine');
            const steps = document.querySelectorAll('.step');
            
            // Update progress line width
            const progressPercent = ((currentSection - 1) / (totalSections - 1)) * 100;
            progressLine.style.setProperty('--progress', progressPercent + '%');
            
            // Create dynamic style for progress line
            if (!document.getElementById('progressStyle')) {
                const style = document.createElement('style');
                style.id = 'progressStyle';
                document.head.appendChild(style);
            }
            document.getElementById('progressStyle').textContent = `
                .progress-line::after { width: ${progressPercent}%; }
            `;
            
            // Update step states
            steps.forEach((step, index) => {
                const stepNumber = index + 1;
                step.classList.remove('active', 'completed');
                
                if (stepNumber < currentSection) {
                    step.classList.add('completed');
                } else if (stepNumber === currentSection) {
                    step.classList.add('active');
                }
            });
        }

        function showSection(sectionNumber) {
            // Hide all sections
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show target section
            document.querySelector(`[data-section="${sectionNumber}"]`).classList.add('active');
            
            currentSection = sectionNumber;
            updateProgressBar();
        }

        function validateSection(sectionNumber) {
            let isValid = true;
            const section = document.querySelector(`[data-section="${sectionNumber}"]`);
            
            if (sectionNumber === 1) {
                // Validate section 1
                const requiredFields = ['namaLengkap', 'nim', 'angkatan', 'email', 'idLine', 'instagram', 'lokasi'];
                
                requiredFields.forEach(fieldName => {
                    const field = document.getElementById(fieldName);
                    const formGroup = field.closest('.form-group');
                    
                    if (!field.value.trim()) {
                        formGroup.classList.add('error');
                        isValid = false;
                    } else {
                        formGroup.classList.remove('error');
                        formData[fieldName] = field.value;
                    }
                });
                
                // Special validation for email
                const emailField = document.getElementById('email');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailField.value && !emailRegex.test(emailField.value)) {
                    emailField.closest('.form-group').classList.add('error');
                    isValid = false;
                }

                const nim = document.getElementById('nim');
                const nimRegex = /^\d+$/;
                if (nim.value.trim() && !nimRegex.test(nim.value)) {
                    showError('nim', 'NIM harus berupa angka');
                    if (!firstErrorField) {
                        firstErrorField = 'nim';
                    }
                    isValid = false;
                }

                const instagram = document.getElementById('instagram');
                if (instagram.value.trim() && !instagram.value.startsWith('@')) {
                    showError('instagram', 'Username Instagram harus dimulai dengan @');
                    if (!firstErrorField) {
                        firstErrorField = 'instagram';
                    }
                    isValid = false;
                }
                
            } else if (sectionNumber === 2) {
                // Validate section 2
                const fileInput = document.getElementById('esaiMotivasi');
                const checkboxes = document.querySelectorAll('input[name="agreements"]:checked');
                
                if (!fileInput.files.length) {
                    fileInput.closest('.form-group').classList.add('error');
                    isValid = false;
                } else {
                    fileInput.closest('.form-group').classList.remove('error');
                    formData.esaiMotivasi = fileInput.files[0].name;
                }
                
                if (checkboxes.length !== 3) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!',
                        text: 'Semua pernyataan harus disetujui untuk melanjutkan.',
                        confirmButtonColor: '#E35434'
                    });
                    isValid = false;
                } else {
                    formData.agreements = Array.from(checkboxes).map(cb => cb.value);
                }
            }
            
            return isValid;
        }

        function nextSection() {
            if (validateSection(currentSection)) {
                if (currentSection < totalSections) {
                    showSection(currentSection + 1);
                }
            }
        }

        function prevSection() {
            if (currentSection > 1) {
                showSection(currentSection - 1);
            }
        }

        function accessTwibbon() {
            // Open twibbon link in new tab
            window.open('https://www.twibbonize.com/exsco7', '_blank');
            
            // Hide previous button and center the submit button
            document.getElementById('section3Buttons').style.display = 'none';
            document.getElementById('section3ButtonsCenter').style.display = 'flex';
            
            formData.twibbonAccessed = true;
        }

        // File upload handler
        document.getElementById('esaiMotivasi').addEventListener('change', function(e) {
            const label = document.getElementById('fileUploadLabel');
            const uploadedFileInfo = document.getElementById('uploadedFileInfo');
            const fileNameLink = document.getElementById('fileNameLink');
            
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const fileURL = URL.createObjectURL(file);
                
                // Update upload label to show success
                label.innerHTML = 'File berhasil dipilih - Klik untuk mengganti file';
                label.classList.add('uploaded');
                
                // Show file info outside upload area
                fileNameLink.textContent = file.name;
                fileNameLink.onclick = function(event) {
                    event.preventDefault();
                    window.open(fileURL, '_blank');
                };
                uploadedFileInfo.style.display = 'block';
                
            } else {
                // Reset to original state
                label.innerHTML = '📄 Unggah file esai motivasi disini';
                label.classList.remove('uploaded');
                uploadedFileInfo.style.display = 'none';
            }
        });

         // Form submission dengan AJAX
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateSection(2) && formData.twibbonAccessed) {
                // Show loading state
                Swal.fire({
                    title: 'Mengirim Data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Buat FormData object
                const formDataToSend = new FormData();
                
                // Ambil semua data form
                formDataToSend.append('namaLengkap', document.getElementById('namaLengkap').value);
                formDataToSend.append('nim', document.getElementById('nim').value);
                formDataToSend.append('angkatan', document.getElementById('angkatan').value);
                formDataToSend.append('email', document.getElementById('email').value);
                formDataToSend.append('idLine', document.getElementById('idLine').value);
                formDataToSend.append('instagram', document.getElementById('instagram').value);
                formDataToSend.append('lokasi', document.getElementById('lokasi').value);
                formDataToSend.append('esaiMotivasi', document.getElementById('esaiMotivasi').files[0]);
                
                // Ambil agreements
                const agreements = Array.from(document.querySelectorAll('input[name="agreements"]:checked')).map(cb => cb.value);
                agreements.forEach(agreement => {
                    formDataToSend.append('agreements[]', agreement);
                });
                
                // Tambahkan CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    formDataToSend.append('_token', csrfToken.getAttribute('content'));
                }
                
                // Submit via AJAX
                fetch('/ancient-academy/register', {
                    method: 'POST',
                    body: formDataToSend,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(async response => {
                    if (!response.ok) {
                        const text = await response.text(); // baca isi respons walau gagal
                        throw new Error(`Server returned ${response.status}: ${text}`);
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.close();
                    
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pendaftaran Berhasil!', 
                            text: data.message,
                            confirmButtonColor: '#E35434',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Redirect ke halaman home
                            window.location.href = '/home';
                        });
                    } else {
                        let errorMessage = 'Terjadi kesalahan saat mengirim data.';
                        
                        if (data.errors) {
                            const firstError = Object.values(data.errors)[0];
                            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                        } else if (data.message) {
                            errorMessage = data.message;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMessage,
                            confirmButtonColor: '#E35434'
                        });
                    }
                })
                .catch(error => {
                    Swal.close();
                    console .error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan jaringan. Silahkan coba lagi.',
                        confirmButtonColor: '#E35434'
                    });
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Pastikan semua data telah diisi dengan benar dan twibbon sudah diakses.',
                    confirmButtonColor: '#E35434'
                });
            }
        });

        // Handle both submit buttons
        document.getElementById('submitBtnCenter').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('registrationForm').dispatchEvent(new Event('submit'));
        });

        // Step click handlers
        document.querySelectorAll('.step').forEach((step, index) => {
            step.addEventListener('click', () => {
                const targetSection = index + 1;
                
                // Only allow clicking on completed or current sections
                if (targetSection <= currentSection || step.classList.contains('completed')) {
                    showSection(targetSection);
                }
            });
        });

        // Initialize
        updateProgressBar();

        // Clear error on input
        document.querySelectorAll('input, select').forEach(field => {
            field.addEventListener('input', () => {
                field.closest('.form-group').classList.remove('error');
            });
        });
    </script>
    @include('layouts.footer')
</body>
</html>