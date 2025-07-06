/**
 * Form Validation JavaScript
 * Untuk validasi form dengan real-time feedback dan alert yang menarik
 */

class FormValidator {
    constructor(formId, options = {}) {
        this.form = document.getElementById(formId);
        this.options = {
            autoHideAlert: options.autoHideAlert || 10000,
            scrollToAlert: options.scrollToAlert || true,
            focusOnError: options.focusOnError || true,
            realTimeValidation: options.realTimeValidation || true,
            ...options
        };
        
        this.init();
    }
    
    init() {
        if (!this.form) {
            console.error('Form tidak ditemukan!');
            return;
        }
        
        this.setupFormSubmission();
        
        if (this.options.realTimeValidation) {
            this.setupRealTimeValidation();
        }
        
        this.setupAutoHideAlert();
    }
    
    setupFormSubmission() {
        this.form.addEventListener('submit', (e) => {
            const inputs = this.form.querySelectorAll('input[required], select[required], textarea[required]');
            let errors = [];
            let hasError = false;
            
            // Reset semua styling error
            document.querySelectorAll('.form-control').forEach(input => {
                input.classList.remove('is-invalid', 'shake');
            });
            
            inputs.forEach(input => {
                const value = input.value.trim();
                const fieldName = this.getFieldDisplayName(input);
                
                if (value === '') {
                    errors.push(`${this.getFieldIcon(input.name)} ${fieldName} wajib diisi!`);
                    input.classList.add('is-invalid', 'shake');
                    hasError = true;
                }
            });
            
            if (hasError) {
                e.preventDefault();
                this.showAlert(errors);
                
                if (this.options.focusOnError) {
                    const firstError = this.form.querySelector('.is-invalid');
                    if (firstError) {
                        setTimeout(() => firstError.focus(), 500);
                    }
                }
                
                return false;
            }
            
            // Tampilkan loading pada tombol submit
            const submitBtn = this.form.querySelector('input[type="submit"], button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('btn-loading');
                submitBtn.disabled = true;
            }
        });
    }
    
    setupRealTimeValidation() {
        const inputs = this.form.querySelectorAll('input[required], select[required], textarea[required]');
        
        inputs.forEach(input => {
            const requiredText = document.getElementById(input.id + '-required');
            
            input.addEventListener('input', () => {
                const value = input.value.trim();
                
                // Reset classes
                input.classList.remove('is-invalid', 'is-valid', 'shake');
                
                if (value !== '') {
                    input.classList.add('is-valid');
                    if (requiredText) {
                        requiredText.textContent = 'Sudah diisi';
                        requiredText.style.color = '#28a745';
                        requiredText.style.opacity = '0.8';
                    }
                    this.checkAllFieldsAndRemoveAlert();
                } else {
                    input.classList.remove('is-valid');
                    if (requiredText) {
                        requiredText.textContent = requiredText.dataset.originalText || 'Harus diisi';
                        requiredText.style.color = '#dc3545';
                        requiredText.style.opacity = '1';
                    }
                }
            });
            
            input.addEventListener('blur', () => {
                const value = input.value.trim();
                if (value === '' && requiredText) {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                    requiredText.style.animation = 'blink 1s ease-in-out 3';
                    requiredText.textContent = 'Wajib diisi!';
                    requiredText.style.color = '#dc3545';
                    requiredText.style.fontWeight = 'bold';
                }
            });
            
            input.addEventListener('focus', () => {
                const value = input.value.trim();
                if (value === '' && requiredText) {
                    requiredText.style.animation = 'none';
                    requiredText.textContent = requiredText.dataset.originalText || 'Harus diisi';
                    requiredText.style.fontWeight = '600';
                }
            });
            
            // Simpan teks original untuk referensi
            if (requiredText) {
                requiredText.dataset.originalText = requiredText.textContent;
            }
        });
    }
    
    showAlert(errors) {
        // Hapus alert sebelumnya jika ada
        const existingAlert = document.querySelector('.custom-alert-danger');
        if (existingAlert) {
            existingAlert.remove();
        }
        
        // Buat alert baru yang lebih menarik
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger custom-alert-danger alert-dismissible fade show';
        alertDiv.innerHTML = `
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                </div>
                <div>
                    <h5 class="alert-heading mb-2"><strong>⚠️ Ups! Ada yang belum diisi nih!</strong></h5>
                    <p class="mb-1">Mohon lengkapi field berikut ini:</p>
                    <ul class="mb-0 mt-2">
                        ${errors.map(error => `<li>${error}</li>`).join('')}
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        // Masukkan alert sebelum form
        const cardHeader = this.form.closest('.card').querySelector('.card-header');
        if (cardHeader) {
            cardHeader.parentNode.insertBefore(alertDiv, cardHeader.nextSibling);
        } else {
            this.form.parentNode.insertBefore(alertDiv, this.form);
        }
        
        // Scroll ke atas untuk melihat alert dengan smooth animation
        if (this.options.scrollToAlert) {
            alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
    
    checkAllFieldsAndRemoveAlert() {
        const inputs = this.form.querySelectorAll('input[required], select[required], textarea[required]');
        const allFilled = Array.from(inputs).every(input => input.value.trim() !== '');
        
        if (allFilled) {
            const alert = document.querySelector('.custom-alert-danger');
            if (alert) {
                // Fade out effect
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.remove();
                    }
                }, 500);
            }
        }
    }
    
    setupAutoHideAlert() {
        if (this.options.autoHideAlert > 0) {
            setTimeout(() => {
                const alert = document.querySelector('.custom-alert-danger');
                if (alert) {
                    const closeBtn = alert.querySelector('.btn-close');
                    if (closeBtn) {
                        closeBtn.click();
                    }
                }
            }, this.options.autoHideAlert);
        }
    }
    
    getFieldDisplayName(input) {
        // Cari label yang terkait dengan input
        const label = this.form.querySelector(`label[for="${input.id}"]`);
        if (label) {
            return label.textContent.replace('*', '').trim();
        }
        
        // Fallback ke name attribute yang diformat
        return input.name.charAt(0).toUpperCase() + input.name.slice(1);
    }
    
    getFieldIcon(fieldName) {
        const icons = {
            'nama': '📝',
            'kaprodi': '👨‍🏫',
            'jurusan': '🏢',
            'email': '📧',
            'telp': '📞',
            'password': '🔒',
            'foto': '📷',
            'default': '📋'
        };
        
        const lowerFieldName = fieldName.toLowerCase();
        return icons[lowerFieldName] || icons.default;
    }
    
    // Method untuk reset form
    resetForm() {
        this.form.reset();
        
        // Reset semua styling
        this.form.querySelectorAll('.form-control').forEach(input => {
            input.classList.remove('is-invalid', 'is-valid', 'shake');
        });
        
        // Reset required text
        this.form.querySelectorAll('.required-text').forEach(text => {
            text.textContent = text.dataset.originalText || 'Harus diisi';
            text.style.color = '#dc3545';
            text.style.opacity = '1';
            text.style.animation = 'none';
        });
        
        // Hapus alert jika ada
        const alert = document.querySelector('.custom-alert-danger');
        if (alert) {
            alert.remove();
        }
    }
    
    // Method untuk validasi manual
    validate() {
        const inputs = this.form.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (input.value.trim() === '') {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });
        
        return isValid;
    }
}

// Auto-initialize untuk form dengan id 'prodiForm' jika ada
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('prodiForm')) {
        window.prodiValidator = new FormValidator('prodiForm');
    }
    
    // Auto-initialize untuk form dengan class 'auto-validate'
    document.querySelectorAll('.auto-validate').forEach(form => {
        new FormValidator(form.id);
    });
});

// Export untuk digunakan di tempat lain
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FormValidator;
}
