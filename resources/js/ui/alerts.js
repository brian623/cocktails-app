import Swal from 'sweetalert2';

export function toastSuccess(message) {
    Swal.fire({
        toast: true,
        icon: 'success',
        title: message,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
}

export function toastError(message) {
    Swal.fire({
        toast: true,
        icon: 'error',
        title: message,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
    });
}

export function initToastsFromSession() {
    const el = document.getElementById('app-toast');
    if (!el) return;

    const { type, message } = el.dataset;

    if (type === 'success') toastSuccess(message);
    if (type === 'error') toastError(message);
}
