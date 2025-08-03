<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Pendaftaran Artopia</title>
    <link rel="stylesheet" href="{{ asset('css/artopiaregistration.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
@include('layouts.navbar')
<body>
    <div class="page-layout">
        <div class="main-content">
            <div class="container-artopia">
                <div class="header-artopia">
                    <img src="{{ asset('asset/artopia/ArtopiaTitle.png') }}" alt="Artopia Title" class="artopia-title-img" style="justify-content: center;">
                    <p>Form Pendaftaran Booth Creative Market</p>
                </div>
            </div>
        </div>
        
        <div class="form-content">
            <form id="artopiaForm">
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-number">I</span>
                        INFORMASI PESERTA
                    </h2>
                    
                    <div class="form-group">
                        <label for="namaLengkap">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="namaLengkap" name="namaLengkap" required>
                        <div class="error-message" id="namaLengkap-error"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nim">NIM <span class="required">*</span></label>
                            <input type="text" id="nim" name="nim" required>
                            <div class="error-message" id="nim-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="angkatan">Angkatan <span class="required">*</span></label>
                            <select id="angkatan" name="angkatan" required>
                                <option value="">Pilih Angkatan</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                            <div class="error-message" id="angkatan-error"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail Pribadi <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                        <div class="error-message" id="email-error"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="idLine">ID Line</label>
                            <input type="text" id="idLine" name="idLine">
                            <div class="error-message" id="idLine-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="instagram">Username Instagram</label>
                            <input type="text" id="instagram" name="instagram" placeholder="@username">
                            <div class="error-message" id="instagram-error"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="namaKelompok">Nama Kelompok (Opsional - Maksimal 4 orang)</label>
                        <input type="text" id="namaKelompok" name="namaKelompok" placeholder="Masukkan nama kelompok jika berkelompok">
                        <div class="error-message" id="namaKelompok-error"></div>
                    </div>
                    
                    <div id="anggotaSection" class="hidden">
                        <div id="anggotaContainer"></div>
                        <button type="button" id="addMemberBtn" class="add-member-btn">
                            + Tambah Anggota
                        </button>
                    </div>
                </div>

                <div class="section">
                    <h2 class="section-title">
                        <span class="section-number">II</span>
                        IDENTITAS BOOTH
                    </h2>
                    
                    <div class="form-group">
                        <label for="namaBooth">Nama Booth / Brand <span class="required">*</span></label>
                        <input type="text" id="namaBooth" name="namaBooth" required>
                        <div class="error-message" id="namaBooth-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsiBooth">Deskripsi Singkat Booth <span class="required">*</span></label>
                        <textarea id="deskripsiBooth" name="deskripsiBooth" rows="4" required 
                                    placeholder="Contoh: Booth yang menjual print art & merchandise bertema nostalgia 2000-an."></textarea>
                        <div class="error-message" id="deskripsiBooth-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tanggalBooth">Pilihan Tanggal Booth <span class="required">*</span></label>
                        <select id="tanggalBooth" name="tanggalBooth" required>
                            <option value="">Pilih Tanggal</option>
                            <option value="29-30 September 2025">29-30 September 2025</option>
                            <option value="01-02 Oktober 2025">01-02 Oktober 2025</option>
                        </select>
                        <div class="error-message" id="tanggalBooth-error"></div>
                    </div>
                </div>

                <!-- Fixed HTML section untuk file upload di artopia.blade.php -->
<!-- Ganti bagian DOKUMEN PENDUKUNG dengan kode ini: -->

                <div class="section">
                    <h2 class="section-title">
                        <span class="section-number">III</span>
                        DOKUMEN PENDUKUNG
                    </h2>
                    
                    <div class="form-group">
                        <label for="listProduk">Upload File PDF - List Produk yang Akan Dijual <span class="required">*</span></label>
                        <div class="file-upload-container">
                            <div class="file-upload" id="fileUploadArea">
                                <!-- Fixed: Ubah input ID dan name dari 'listProduk' menjadi 'dokumenPendukung' untuk sesuai dengan controller -->
                                <input type="file" id="listProduk" name="dokumenPendukung" accept=".pdf" required onchange="handleFileUpload()">
                                <label for="listProduk" class="file-upload-label" id="fileUploadLabel">
                                    📄 Klik untuk upload file PDF<br>
                                    <small>Format: PDF, Maksimal 10MB</small>
                                </label>
                            </div>
                            <div class="file-display hidden" id="fileDisplay">
                                <div class="file-info">
                                    📄 <span class="file-name" id="fileName" onclick="openFile()"></span>
                                    <div style="font-size: 12px; opacity: 0.8; margin-top: 2px;">Klik nama file untuk membuka</div>
                                </div>
                                <div class="file-actions">
                                    <button type="button" class="change-file-btn" onclick="changeFile()">
                                        Ganti File
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="error-message" id="listProduk-error"></div>
                    </div>
                </div>

                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="agreement1" name="agreement1" required>
                        <label for="agreement1">Saya menyatakan bahwa seluruh informasi di atas benar dan produk yang dijual merupakan hasil karya orisinal. <span class="required">*</span></label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="agreement2" name="agreement2" required>
                        <label for="agreement2">Saya bersedia mengikuti seluruh rangkaian Artopia, termasuk sesi briefing dan tata tertib yang telah ditentukan panitia. <span class="required">*</span></label>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    🎨 DAFTARKAN BOOTH SAYA
                </button>
            </form>
        </div>
    </div>

   <script>
    // Fixed JavaScript untuk form artopia.blade.php

// Validation functions
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(fieldId + '-error');
    
    field.classList.add('error');
    errorDiv.textContent = message;
    errorDiv.classList.add('show');
    
    // Auto-hide error when user starts typing
    field.addEventListener('input', function() {
        clearError(fieldId);
    });
    
    field.addEventListener('change', function() {
        clearError(fieldId);
    });
}

let firstErrorField = null;

function scrollToError(fieldId) {
    const field = document.getElementById(fieldId);
    if (field) {
        const navbarOffset = 300; 
        const fieldPosition = field.getBoundingClientRect().top + window.pageYOffset;
        const scrollPosition = fieldPosition - navbarOffset;
        
        window.scrollTo({
            top: scrollPosition,
            behavior: 'smooth'
        });
        
        setTimeout(() => {
            field.focus();
        }, 500);
    }
}

function clearError(fieldId) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(fieldId + '-error');
    
    if (field && errorDiv) {
        field.classList.remove('error');
        errorDiv.classList.remove('show');
        errorDiv.textContent = '';
    }
}

function clearAllErrors() {
    const errorElements = document.querySelectorAll('.error');
    const errorMessages = document.querySelectorAll('.error-message.show');
    
    errorElements.forEach(el => el.classList.remove('error'));
    errorMessages.forEach(el => {
        el.classList.remove('show');
        el.textContent = '';
    });
    firstErrorField = null; 
}

// Global variables for file handling
let currentFile = null;
let currentFileURL = null;

function validateForm() {
    let isValid = true;
    clearAllErrors();

    console.log('Validating form...');
    console.log('Value of currentFile during validation:', currentFile);

    const requiredFields = [
        { id: 'namaLengkap', message: 'Nama lengkap harus diisi' },
        { id: 'nim', message: 'NIM harus diisi' },
        { id: 'angkatan', message: 'Pilih angkatan' },
        { id: 'email', message: 'Email harus diisi' },
        { id: 'idLine', message: 'ID Line harus diisi' }, // Fixed: idLine sekarang required
        { id: 'instagram', message: 'Username Instagram harus diisi' }, // Fixed: instagram sekarang required
        { id: 'namaBooth', message: 'Nama booth harus diisi' },
        { id: 'deskripsiBooth', message: 'Deskripsi booth harus diisi' },
        { id: 'tanggalBooth', message: 'Pilih tanggal booth' }
    ];

    requiredFields.forEach(field => {
        const element = document.getElementById(field.id);
        if (!element.value.trim()) {
            showError(field.id, field.message);
            if (!firstErrorField) {
                firstErrorField = field.id;
            }
            isValid = false;
        }
    });

    const email = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.value.trim() && !emailRegex.test(email.value)) {
        showError('email', 'Format email tidak valid');
        if (!firstErrorField) {
            firstErrorField = 'email';
        }
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

    // Fixed: Validasi File Upload menggunakan currentFile (bukan dari input element)
    if (!currentFile) {
        showError('listProduk', 'Upload file PDF list produk');
        if (!firstErrorField) {
            firstErrorField = 'listProduk';
        }
        isValid = false;
    } else {
        if (currentFile.type !== 'application/pdf') {
            showError('listProduk', 'File harus berformat PDF');
            if (!firstErrorField) {
                firstErrorField = 'listProduk';
            }
            isValid = false;
        }
        if (currentFile.size > 10 * 1024 * 1024) { // 10MB
            showError('listProduk', 'Ukuran file maksimal 10MB');
            if (!firstErrorField) {
                firstErrorField = 'listProduk';
            }
            isValid = false;
        }
    }

    const namaKelompok = document.getElementById('namaKelompok');
    if (namaKelompok.value.trim()) {
        for (let i = 1; i <= memberCount; i++) {
            const namaAnggota = document.getElementById(`namaAnggota${i}`);
            const nimAnggota = document.getElementById(`nimAnggota${i}`);
            
            if (namaAnggota && !namaAnggota.value.trim()) {
                showError(`namaAnggota${i}`, 'Nama anggota harus diisi');
                if (!firstErrorField) {
                    firstErrorField = `namaAnggota${i}`;
                }
                isValid = false;
            }
            
            if (nimAnggota && !nimAnggota.value.trim()) {
                showError(`nimAnggota${i}`, 'NIM anggota harus diisi');
                if (!firstErrorField) {
                    firstErrorField = `nimAnggota${i}`;
                }
                isValid = false;
            } else if (nimAnggota && nimAnggota.value.trim() && !nimRegex.test(nimAnggota.value)) {
                showError(`nimAnggota${i}`, 'NIM harus berupa angka');
                if (!firstErrorField) {
                    firstErrorField = `nimAnggota${i}`;
                }
                isValid = false;
            }
        }
    }

    const agreement1 = document.getElementById('agreement1');
    const agreement2 = document.getElementById('agreement2');
    
    if (!agreement1.checked) {
        swal({
            title: "Persetujuan Diperlukan",
            text: "Anda harus menyetujui pernyataan pertama untuk melanjutkan",
            icon: "warning",
            button: {
                text: "OK",
                className: "swal-button-center"
            },
            className: "artopia-swal",
            closeOnClickOutside: true,
            closeOnEsc: true
        });
        isValid = false;
    } else if (!agreement2.checked) { 
        swal({
            title: "Persetujuan Diperlukan",
            text: "Anda harus menyetujui pernyataan kedua untuk melanjutkan",
            icon: "warning",
            button: {
                text: "OK",
                className: "swal-button-center"
            },
            className: "artopia-swal",
            closeOnClickOutside: true,
            closeOnEsc: true
        });
        isValid = false;
    }

    if (!isValid && firstErrorField) {
        setTimeout(() => {
            scrollToError(firstErrorField);
        }, 100);
    }

    return isValid;
}

let memberCount = 0;
const maxMembers = 4;

document.getElementById('namaKelompok').addEventListener('input', function() {
    const anggotaSection = document.getElementById('anggotaSection');
    if (this.value.trim() !== '') {
        anggotaSection.classList.remove('hidden');
        if (memberCount === 0) {
            addMember();
        }
    } else {
        anggotaSection.classList.add('hidden');
        clearAllMembers();
    }
});

function addMember() {
    if (memberCount >= maxMembers) return;
    
    memberCount++;
    const container = document.getElementById('anggotaContainer');
    const memberDiv = document.createElement('div');
    memberDiv.className = 'member-group';
    memberDiv.id = `member-${memberCount}`;
    
    memberDiv.innerHTML = `
        <div class="member-header">
            <span class="member-title">Anggota ${memberCount}</span>
            ${memberCount > 0 ? `<button type="button" class="remove-member" onclick="removeMember(${memberCount})">Hapus</button>` : ''}
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="namaAnggota${memberCount}">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="namaAnggota${memberCount}" name="namaAnggota${memberCount}" required>
                <div class="error-message" id="namaAnggota${memberCount}-error"></div>
            </div>
            <div class="form-group">
                <label for="nimAnggota${memberCount}">NIM <span class="required">*</span></label>
                <input type="text" id="nimAnggota${memberCount}" name="nimAnggota${memberCount}" required>
                <div class="error-message" id="nimAnggota${memberCount}-error"></div>
            </div>
        </div>
    `;
    
    container.appendChild(memberDiv);
    updateAddMemberButton();
}

function removeMember(memberId) {
    const memberDiv = document.getElementById(`member-${memberId}`);
    if (memberDiv) {
        memberDiv.remove();
        memberCount--;
        renumberMembers();
        updateAddMemberButton();
    }
}

function renumberMembers() {
    const members = document.querySelectorAll('.member-group');
    members.forEach((member, index) => {
        const newNumber = index + 1;
        const oldId = member.id;
        const oldNumber = oldId.split('-')[1];
        
        member.id = `member-${newNumber}`;
        member.querySelector('.member-title').textContent = `Anggota ${newNumber}`;
        
        const inputs = member.querySelectorAll('input');
        inputs.forEach(input => {
            const oldName = input.name;
            const oldId = input.id;
            input.name = oldName.replace(`Anggota${oldNumber}`, `Anggota${newNumber}`); 
            input.id = oldId.replace(`Anggota${oldNumber}`, `Anggota${newNumber}`); 
        });
        
        const labels = member.querySelectorAll('label');
        labels.forEach(label => {
            const oldFor = label.getAttribute('for');
            if (oldFor) {
                label.setAttribute('for', oldFor.replace(`Anggota${oldNumber}`, `Anggota${newNumber}`)); 
            }
        });
        
        const errorDivs = member.querySelectorAll('.error-message');
        errorDivs.forEach(errorDiv => {
            const oldId = errorDiv.id;
            errorDiv.id = oldId.replace(`Anggota${oldNumber}`, `Anggota${newNumber}`); 
        });
        
        const removeBtn = member.querySelector('.remove-member');
        if (removeBtn) {
            removeBtn.setAttribute('onclick', `removeMember(${newNumber})`);
            if (members.length === 1 && newNumber === 1) {
                removeBtn.style.display = 'none'; 
            } else {
                removeBtn.style.display = ''; 
            }
        }
    });
    
    memberCount = members.length;
}

function updateAddMemberButton() {
    const addBtn = document.getElementById('addMemberBtn');
    if (memberCount >= maxMembers) {
        addBtn.disabled = true;
        addBtn.textContent = `Maksimal ${maxMembers} Anggota`;
    } else {
        addBtn.disabled = false;
        addBtn.textContent = '+ Tambah Anggota';
    }
}

function clearAllMembers() {
    const container = document.getElementById('anggotaContainer');
    container.innerHTML = '';
    memberCount = 0;
    updateAddMemberButton();
}

document.getElementById('addMemberBtn').addEventListener('click', addMember);

function handleFileUpload() {
    const fileInput = document.getElementById('listProduk');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileDisplay = document.getElementById('fileDisplay');
    const fileNameSpan = document.getElementById('fileName'); 
    
    clearError('listProduk');

    console.log('handleFileUpload triggered.');
    console.log('fileInput.files:', fileInput.files);

    if (fileInput.files && fileInput.files[0]) {
        const file = fileInput.files[0];
        
        if (file.type !== 'application/pdf') {
            showError('listProduk', 'File harus berformat PDF');
            fileInput.value = ''; 
            fileUploadArea.classList.remove('hidden');
            fileDisplay.classList.add('hidden');
            if (currentFileURL) { URL.revokeObjectURL(currentFileURL); }
            currentFile = null;
            currentFileURL = null;
            fileNameSpan.textContent = '';
            console.log('File type invalid. currentFile set to null.');
            return; 
        }
        
        if (file.size > 10 * 1024 * 1024) { // 10MB
            showError('listProduk', 'Ukuran file maksimal 10MB');
            fileInput.value = ''; 
            fileUploadArea.classList.remove('hidden');
            fileDisplay.classList.add('hidden');
            if (currentFileURL) { URL.revokeObjectURL(currentFileURL); }
            currentFile = null;
            currentFileURL = null;
            fileNameSpan.textContent = '';
            console.log('File size invalid. currentFile set to null.');
            return; 
        }
        
        currentFile = file;
        if (currentFileURL) {
            URL.revokeObjectURL(currentFileURL); 
        }
        currentFileURL = URL.createObjectURL(file); 
        
        fileNameSpan.textContent = file.name; 
        fileUploadArea.classList.add('hidden'); 
        fileDisplay.classList.remove('hidden'); 
        console.log('File successfully processed. currentFile:', currentFile.name);
    } else {
        fileUploadArea.classList.remove('hidden');
        fileDisplay.classList.add('hidden');
        if (currentFileURL) {
            URL.revokeObjectURL(currentFileURL);
        }
        currentFile = null;
        currentFileURL = null;
        fileNameSpan.textContent = '';
        console.log('No file selected or file input cleared. currentFile set to null.');
    }
}

function openFile() {
    if (currentFileURL) {
        window.open(currentFileURL, '_blank');
    } else {
        console.warn("No file URL available to open.");
    }
}

function changeFile() {
    const fileInput = document.getElementById('listProduk');
    
    fileInput.value = '';
    handleFileUpload();
    
    fileInput.click();
}

// Fixed: Form submission dengan penanganan file yang benar
document.getElementById('artopiaForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!validateForm()) {
        return;
    }
    
    // Show loading state
    const submitBtn = document.querySelector('.submit-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '⏳ Mengirim...';
    submitBtn.disabled = true;
    
    // Buat FormData object
    const formDataToSend = new FormData();
    
    // Ambil semua data form utama
    formDataToSend.append('namaLengkap', document.getElementById('namaLengkap').value);
    formDataToSend.append('nim', document.getElementById('nim').value);
    formDataToSend.append('angkatan', document.getElementById('angkatan').value);
    formDataToSend.append('email', document.getElementById('email').value);
    formDataToSend.append('idLine', document.getElementById('idLine').value);
    formDataToSend.append('instagram', document.getElementById('instagram').value);
    formDataToSend.append('namaBooth', document.getElementById('namaBooth').value);
    formDataToSend.append('deskripsiBooth', document.getElementById('deskripsiBooth').value);
    formDataToSend.append('tanggalBooth', document.getElementById('tanggalBooth').value);
    
    // Fixed: Gunakan currentFile bukan dari input element
    if (currentFile) {
        formDataToSend.append('dokumenPendukung', currentFile);
        console.log('File attached to FormData:', currentFile.name);
    } else {
        console.error('No file to attach!');
    }
    
    // Tambahkan nama kelompok jika ada
    const namaKelompok = document.getElementById('namaKelompok');
    if (namaKelompok && namaKelompok.value.trim()) {
        formDataToSend.append('namaKelompok', namaKelompok.value);
        
        // Tambahkan data anggota tambahan
        for (let i = 1; i <= memberCount; i++) {
            const namaAnggota = document.getElementById(`namaAnggota${i}`);
            const nimAnggota = document.getElementById(`nimAnggota${i}`);
            if (namaAnggota && nimAnggota && namaAnggota.value.trim() && nimAnggota.value.trim()) {
                formDataToSend.append(`namaAnggota${i}`, namaAnggota.value);
                formDataToSend.append(`nimAnggota${i}`, nimAnggota.value);
            }
        }
    }
    
    // Tambahkan CSRF token
    formDataToSend.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Submit via AJAX
    fetch('/artopia/register', {
        method: 'POST',
        body: formDataToSend,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            swal({
                title: "🎉 Pendaftaran Berhasil!",
                text: data.message,
                icon: "success",
                button: {
                    text: "OK",
                    className: "swal-button-center"
                },
                className: "artopia-swal",
                closeOnClickOutside: true,
                closeOnEsc: true
            }).then((value) => {
                window.location.href = '/home';
            });
        } else {
            let errorMessage = data.message || 'Terjadi kesalahan saat mengirim data.';
            if (data.errors && typeof data.errors === 'object') {
                errorMessage = Object.values(data.errors).flat().join('\n');
            }
            
            swal({
                title: "❌ Gagal!",
                text: errorMessage,
                icon: "error",
                button: {
                    text: "OK",
                    className: "swal-button-center"
                },
                className: "artopia-swal"
            });
        }
        
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    })
    .catch(error => {
        console.error('Error:', error);
        swal({
            title: "⚠️ Error!",
            text: "Terjadi kesalahan jaringan. Silakan coba lagi.",
            icon: "error",
            button: {
                text: "OK",
                className: "swal-button-center"
            },
            className: "artopia-swal"
        });
        
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Cleanup file URLs when page unloads
window.addEventListener('beforeunload', function() {
    if (currentFileURL) {
        URL.revokeObjectURL(currentFileURL);
    }
});
</script>
    @include('layouts.footer')
</body>
</html>