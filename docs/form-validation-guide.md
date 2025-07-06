# Form Validation - Dokumentasi Penggunaan

## Deskripsi
Sistem validasi form yang fleksibel dengan real-time feedback, alert yang menarik, dan animasi yang smooth. Terdiri dari CSS dan JavaScript yang dapat digunakan di berbagai form.

## File yang Diperlukan
1. `public/css/form-validation.css` - CSS untuk styling validasi
2. `public/js/form-validation.js` - JavaScript untuk logika validasi

## Cara Penggunaan

### 1. Include CSS dan JS di Blade Template

```php
@extends('template.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form-validation.css') }}">
@endpush

@section('content')
    <!-- Form content here -->
@endsection

@push('scripts')
    <script src="{{ asset('js/form-validation.js') }}"></script>
@endpush
```

### 2. HTML Structure yang Diperlukan

```html
<form id="yourFormId" method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="nama">Nama Field</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
            <small class="required-text" id="nama-required">Nama Harus Diisi</small>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <input type="submit" value="Simpan" class="btn btn-primary">
    </div>
</form>
```

### 3. Auto-Initialize (Otomatis)

JavaScript akan secara otomatis mendeteksi:
- Form dengan id `prodiForm`
- Form dengan class `auto-validate`

### 4. Manual Initialize

```javascript
// Inisialisasi manual
const validator = new FormValidator('yourFormId', {
    autoHideAlert: 10000,        // Auto hide alert setelah 10 detik
    scrollToAlert: true,         // Scroll ke alert saat muncul
    focusOnError: true,          // Focus ke field pertama yang error
    realTimeValidation: true     // Enable real-time validation
});

// Reset form
validator.resetForm();

// Validasi manual tanpa submit
const isValid = validator.validate();
```

## Fitur-Fitur

### ✅ Real-time Validation
- Input berubah hijau saat diisi
- Teks "Harus diisi" berubah menjadi "Sudah diisi"
- Alert otomatis hilang saat semua field terisi

### ✅ Visual Feedback
- Animasi shake pada field yang error
- Border merah/hijau untuk invalid/valid
- Teks berkedip saat focus keluar dari field kosong

### ✅ Smart Alert System
- Alert muncul dengan animasi smooth
- Auto-hide setelah waktu tertentu
- Responsive design dengan icon dan styling menarik

### ✅ Accessibility
- Proper ARIA labels
- Keyboard navigation support
- Screen reader friendly

## Kustomisasi

### CSS Variables (Opsional)
Tambahkan di file CSS untuk customization:

```css
:root {
    --danger-color: #dc3545;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
}
```

### JavaScript Options

```javascript
const options = {
    autoHideAlert: 15000,        // Alert hilang setelah 15 detik
    scrollToAlert: false,        // Tidak scroll ke alert
    focusOnError: false,         // Tidak focus ke error field
    realTimeValidation: false,   // Disable real-time validation
    customIcons: {               // Custom icon untuk field
        nama: '👤',
        email: '✉️',
        password: '🔐'
    }
};

new FormValidator('myForm', options);
```

## Contoh Implementasi di Form Lain

### Form Mahasiswa
```html
<form id="mahasiswaForm" class="auto-validate">
    <div class="form-group">
        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim" class="form-control" required>
        <small class="required-text" id="nim-required">NIM Harus Diisi</small>
    </div>
    
    <div class="form-group">
        <label for="nama">Nama Mahasiswa</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
        <small class="required-text" id="nama-required">Nama Harus Diisi</small>
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
        <small class="required-text" id="email-required">Email Harus Diisi</small>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
```

## Browser Support
- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Dependencies
- Bootstrap 5.x (untuk styling alert dan form)
- Font Awesome (untuk icon, opsional)

## Tips & Best Practices

1. **Konsistensi Naming**: Gunakan pattern `fieldname-required` untuk id required text
2. **Server-side Validation**: Tetap lakukan validasi di controller Laravel
3. **Loading State**: Form otomatis menampilkan loading pada tombol submit
4. **Error Messages**: Gunakan `@error` directive Laravel untuk server-side errors
5. **Accessibility**: Selalu gunakan label yang proper dan aria-labels

## Troubleshooting

### Alert tidak muncul
- Pastikan Bootstrap JS sudah di-load
- Cek console browser untuk error JavaScript

### Styling tidak muncul
- Pastikan path CSS sudah benar
- Cek apakah CSS sudah di-load dengan benar

### Real-time validation tidak berfungsi
- Pastikan input memiliki attribute `required`
- Pastikan ada element dengan class `required-text`

## Changelog

### v1.0.0
- Initial release
- Basic form validation
- Real-time feedback
- Alert system
- Auto-initialize feature
