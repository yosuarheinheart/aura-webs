<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

let currentSection = 1;
        const totalSections = 3;

        // Form data storage
        let formData = {};

        function updateProgressBar() {
            const progressLine = document.getElementById('progressLine');
            const steps = document.querySelectorAll('.step');
            
            // Update progress line width
            const progressPercent = ((currentSection - 1) / (totalSections - 1)) * 100;
            progressLine.style.width = progressPercent + '%';
            
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
                    swal("Oops!", "Semua pernyataan harus disetujui untuk melanjutkan.", "warning");
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
            window.open('https://www.canva.com/design/twibbon-ancient-academy', '_blank');
            
            // Hide previous button and center the submit button
            document.getElementById('section3Buttons').style.display = 'none';
            document.getElementById('section3ButtonsCenter').style.display = 'flex';
            
            formData.twibbonAccessed = true;
        }

        // File upload handler
        document.getElementById('esaiMotivasi').addEventListener('change', function(e) {
            const label = document.querySelector('label[for="esaiMotivasi"]');
            const uploadedFile = document.getElementById('uploadedFile');
            const fileName = document.getElementById('fileName');
            const filePreview = document.getElementById('filePreview');
            
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const fileURL = URL.createObjectURL(file);
                
                // Update label
                label.innerHTML = `📄 File berhasil dipilih: ${file.name}`;
                label.style.background = '#E35434';
                label.style.color = 'white';
                
                // Show file preview link
                fileName.textContent = file.name;
                filePreview.href = fileURL;
                uploadedFile.style.display = 'block';
            } else {
                label.innerHTML = '📄 Unggah file esai motivasi disini';
                label.style.background = '#FFEFC0';
                label.style.color = '#E35434';
                uploadedFile.style.display = 'none';
            }
        });

        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateSection(2) && formData.twibbonAccessed) {
                // Simulate form submission
                swal({
                    title: "Pendaftaran Berhasil!",
                    text: "Terima kasih telah mendaftar sebagai volunteer Ancient Academy. Silakan tunggu pemberitahuan selanjutnya melalui email yang telah Anda daftarkan.",
                    icon: "success",
                    button: "OK",
                }).then(() => {
                    // Redirect to home page
                    window.location.href = "{{ route('home.view') }}";
                });
            } else {
                swal("Oops!", "Pastikan semua data telah diisi dengan benar dan twibbon telah diakses.", "warning");
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