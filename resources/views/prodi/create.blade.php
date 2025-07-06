@extends('template.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form-validation.css') }}">
    <style>
        /* Force styling untuk teks required */
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
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Prodi</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Prodi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Prodi</h3>
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

                        <form action="{{ route('prodi.store') }}" method="POST" id="prodiForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Prodi</label>
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                    <small class="required-text" id="nama-required">Nama Prodi Harus Di isi</small>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kaprodi">Kaprodi</label>
                                    <input type="text" name="kaprodi" id="kaprodi" class="form-control @error('kaprodi') is-invalid @enderror" value="{{ old('kaprodi') }}" required>
                                    <small class="required-text" id="kaprodi-required">Nama Kaprodi Harus Di isi</small>
                                    @error('kaprodi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Jurusan">Jurusan</label>
                                    <input type="text" name="Jurusan" id="Jurusan" class="form-control @error('Jurusan') is-invalid @enderror" value="{{ old('Jurusan') }}" required>
                                    <small class="required-text" id="Jurusan-required">Nama Jurusan Harus Di isi</small>
                                    @error('Jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Simpan" class="btn btn-primary">
                                <a href="{{ route('prodi.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

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
            setupValidation('nama');
            setupValidation('kaprodi');
            setupValidation('Jurusan');
            
            // Setup form submission
            document.getElementById('prodiForm').addEventListener('submit', function(e) {
                const nama = document.getElementById('nama').value.trim();
                const kaprodi = document.getElementById('kaprodi').value.trim();
                const jurusan = document.getElementById('Jurusan').value.trim();
                
                let hasError = false;
                let errors = [];
                
                // Reset styles
                document.querySelectorAll('.form-control').forEach(function(input) {
                    input.classList.remove('is-invalid', 'shake');
                });
                
                // Validate each field
                if (nama === '') {
                    document.getElementById('nama').classList.add('is-invalid', 'shake');
                    errors.push('📝 Nama Prodi wajib diisi!');
                    hasError = true;
                }
                
                if (kaprodi === '') {
                    document.getElementById('kaprodi').classList.add('is-invalid', 'shake');
                    errors.push('👨‍🏫 Kaprodi wajib diisi!');
                    hasError = true;
                }
                
                if (jurusan === '') {
                    document.getElementById('Jurusan').classList.add('is-invalid', 'shake');
                    errors.push('🏢 Jurusan wajib diisi!');
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