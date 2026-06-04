/**
 * Custom JavaScript Utilities for Laravel E-Commerce
 * These utilities handle front-end interactions and generic logic.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Basic tooltips initialization if Bootstrap is present
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    }

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-success, .alert-danger');
    if (alerts.length > 0) {
        setTimeout(() => {
            alerts.forEach(alert => {
                if (typeof bootstrap !== 'undefined') {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                } else {
                    alert.style.display = 'none';
                }
            });
        }, 5000);
    }
});

// Generic form validation wrapper
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    let isValid = true;
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        }
    });

    return isValid;
}

// Image preview utility
function previewImage(inputElement, previewElementId) {
    const preview = document.getElementById(previewElementId);
    if (!preview) return;

    if (inputElement.files && inputElement.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(inputElement.files[0]);
    } else {
        preview.style.display = 'none';
        preview.src = '';
    }
}

// Format currency
function formatCurrency(amount, currency = 'TRY', locale = 'tr-TR') {
    return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency: currency
    }).format(amount);
}

// Helper to copy text to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        console.log('Text copied to clipboard');
    }).catch(err => {
        console.error('Could not copy text: ', err);
    });
}
