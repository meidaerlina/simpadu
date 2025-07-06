@extends('template.main')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form-validation.css') }}">
    <style>
        .required-text {
            color: #dc3545 !important;
            font-weight: bold !important;
            font-size: 12px !important;
            margin-top: 5px !important;
            display: block !important;
        }
        
        .required-text.valid {
            color: #28a745 !important;
        }
        
        .form-control.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .form-control.is-valid {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
        }
        
        .shake {
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
        
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.3; }
            100% { opacity: 1; }
        }
    </style>
@endpush
@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Data Mahasiswa</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Mahasiswa</h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <form action="{{ url('mahasiswa') }}" method="POST" id="mahasiswaForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Nim" class="form-label">Nim</label>
                                    <input type="text" name="Nim" id="Nim" class="form-control" required>
                                    <small class="required-text" id="Nim-required">Nim Harus Di isi</small>
                                    @error('Nim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <small class="required-text" id="password-required">Password Harus Di isi</small>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Nama" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="Nama" id="Nama" class="form-control" required>
                                    <small class="required-text" id="Nama-required">Nama Harus Di isi</small>
                                    @error('Nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Tanggallahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="Tanggallahir" id="Tanggallahir" class="form-control" required>
                                    <small class="required-text" id="Tanggallahir-required">Tanggal Lahir Harus Di isi</small>
                                    @error('Tanggallahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Telp" class="form-label">Telpon</label>
                                    <input type="text" name="Telp" id="Telp" class="form-control" required>
                                    <small class="required-text" id="Telp-required">Telpon Harus Di isi</small>
                                    @error('Telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" name="Email" id="Email" class="form-control" required>
                                    <small class="required-text" id="Email-required">Email Harus Di isi</small>
                                    @error('Email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id" class="form-label">Prodi</label>
                                    <select class="form-select" name="id" id="id">
                                        @foreach ($prodi as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="foto">Upload Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*"/>
                                    <small class="required-text" id="foto-required">Foto Harus Di isi</small>
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Simpan" class="btn btn-primary">
                                <input type="reset" value="Batal" class="btn btn-danger">
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                        <!-- /.card-body -->

                        <!-- /.card -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row (main row) -->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
</main>
@endsection()
@push('scripts')
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan teks required berwarna merah saat load
            document.querySelectorAll('.required-text').forEach(function(el) {
                el.style.color = '#dc3545';
                el.style.fontWeight = 'bold';
                el.style.fontSize = '12px';
                el.style.marginTop = '5px';
                el.style.display = 'block';
            });
            
            // Setup event listeners untuk setiap input
            setupValidation('Nim');
            setupValidation('password');
            setupValidation('Nama');
            setupValidation('Tanggallahir');
            setupValidation('Telp');
            setupValidation('Email');
            setupValidation('Prodi');
            setupValidation('foto');
            
            // Setup form submission
            document.getElementById('mahasiswaForm').addEventListener('submit', function(e) {
                const Nim = document.getElementById('Nim').value.trim();
                const password = document.getElementById('password').value.trim();
                const Nama = document.getElementById('Nama').value.trim();
                const Tanggallahir = document.getElementById('Tanggallahir').value.trim();
                const Telp = document.getElementById('Telp').value.trim();
                const Email = document.getElementById('Email').value.trim();
                const Prodi = document.getElementById('Prodi').value.trim();
                const foto = document.getElementById('foto').value.trim();
                
                let hasError = false;
                let errors = [];
                
                // Reset styles
                document.querySelectorAll('.form-control').forEach(function(input) {
                    input.classList.remove('is-invalid', 'shake');
                });
                
                // Validate each field
                if (Nim === '') {
                    document.getElementById('Nim').classList.add('is-invalid', 'shake');
                    errors.push('Nim Prodi wajib diisi!');
                    hasError = true;
                }
                
                if (password === '') {
                    document.getElementById('password').classList.add('is-invalid', 'shake');
                    errors.push('Password wajib diisi!');
                    hasError = true;
                }
                
                if (Nama === '') {
                    document.getElementById('Nama').classList.add('is-invalid', 'shake');
                    errors.push('Nama wajib diisi!');
                    hasError = true;
                }
                if (Tanggallahir === '') {
                    document.getElementById('Tanggallahir').classList.add('is-invalid', 'shake');
                    errors.push('Tanggal lahir Prodi wajib diisi!');
                    hasError = true;
                }
                
                if (Telp === '') {
                    document.getElementById('Telp').classList.add('is-invalid', 'shake');
                    errors.push('No Telpon wajib diisi!');
                    hasError = true;
                }

                if (Email === '') {
                    document.getElementById('Email').classList.add('is-invalid', 'shake');
                    errors.push('Email wajib diisi!');
                    hasError = true;
                }
                
                if (Prodi === '') {
                    document.getElementById('naProdima').classList.add('is-invalid', 'shake');
                    errors.push('📝 Prodi wajib diisi!');
                    hasError = true;
                }
                
                if (hasError) {
                    e.preventDefault();
                    showAlert(errors);
                    return false;
                }
            });
        });
        
        function setupValidation(fieldId) {
            const input = document.getElementById(fieldId);
            const requiredText = document.getElementById(fieldId + '-required');
            
            if (!input || !requiredText) return;
            
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                    requiredText.textContent = '✓ Sudah terisi';
                    requiredText.style.color = '#28a745';
                } else {
                    this.classList.remove('is-valid');
                    requiredText.textContent = requiredText.getAttribute('data-original') || 'Harus diisi';
                    requiredText.style.color = '#dc3545';
                }
            });
            
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                    requiredText.style.animation = 'blink 1s ease-in-out 3';
                    requiredText.textContent = 'Wajib diisi!';
                    requiredText.style.color = '#dc3545';
                    requiredText.style.fontWeight = 'bold';
                }
            });
            
            input.addEventListener('focus', function() {
                if (this.value.trim() === '') {
                    requiredText.style.animation = 'none';
                    requiredText.textContent = requiredText.getAttribute('data-original') || 'Harus diisi';
                    requiredText.style.fontWeight = 'bold';
                }
            });
            
            // Store original text
            if (!requiredText.getAttribute('data-original')) {
                requiredText.setAttribute('data-original', requiredText.textContent);
            }
        }
        
        function showAlert(errors) {
            // Remove existing alert
            const existingAlert = document.querySelector('.custom-alert');
            if (existingAlert) {
                existingAlert.remove();
            }
            
            // Create new alert
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger custom-alert alert-dismissible fade show';
            alertDiv.style.marginBottom = '20px';
            alertDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <div style="margin-right: 15px;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 24px; color: #dc3545;"></i>
                    </div>
                    <div>
                        <h5 style="margin-bottom: 8px; color: #721c24;"><strong>⚠️ Ups! Ada yang belum diisi nih!</strong></h5>
                        <p style="margin-bottom: 5px;">Mohon lengkapi field berikut ini:</p>
                        <ul style="margin-bottom: 0; margin-top: 8px;">
                            ${errors.map(error => `<li>${error}</li>`).join('')}
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            // Insert alert
            const cardHeader = document.querySelector('.card-header');
            cardHeader.parentNode.insertBefore(alertDiv, cardHeader.nextSibling);
            
            // Scroll to alert
            alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Auto-hide after 10 seconds
            setTimeout(function() {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 10000);
        }
    </script>
@endpush