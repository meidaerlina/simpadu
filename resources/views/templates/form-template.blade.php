{{-- Template Form dengan Validasi --}}
@extends('template.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form-validation.css') }}">
@endpush

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Judul Halaman</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Judul Halaman</li>
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
                            <h3 class="card-title">Form Title</h3>
                        </div>

                        {{-- Server-side validation errors --}}
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

                        {{-- Form dengan auto-validate class --}}
                        <form action="{{ route('your.store') }}" method="POST" id="yourForm" class="auto-validate" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                                {{-- Text Input --}}
                                <div class="form-group">
                                    <label for="field1">Field Label</label>
                                    <input type="text" name="field1" id="field1" class="form-control @error('field1') is-invalid @enderror" value="{{ old('field1') }}" required>
                                    <small class="required-text" id="field1-required">Field ini harus diisi</small>
                                    @error('field1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email Input --}}
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    <small class="required-text" id="email-required">Email harus diisi</small>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password Input --}}
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                    <small class="required-text" id="password-required">Password harus diisi</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Select Dropdown --}}
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Kategori 1</option>
                                        <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>Kategori 2</option>
                                    </select>
                                    <small class="required-text" id="category-required">Kategori harus dipilih</small>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- File Upload --}}
                                <div class="form-group">
                                    <label for="file">Upload File</label>
                                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">File gambar maksimal 2MB</small>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Textarea --}}
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                                    <small class="required-text" id="description-required">Deskripsi harus diisi</small>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Simpan" class="btn btn-primary">
                                <input type="reset" value="Reset" class="btn btn-secondary">
                                <a href="{{ route('your.index') }}" class="btn btn-warning">Kembali</a>
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
    
    {{-- Custom JavaScript jika diperlukan --}}
    <script>
        // Contoh kustomisasi validator
        document.addEventListener('DOMContentLoaded', function() {
            // Jika ingin kustomisasi lebih lanjut
            if (window.yourFormValidator) {
                // Custom logic here
            }
        });
    </script>
@endpush
