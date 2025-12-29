import './bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import './edit-modal';

import Alpine from 'alpinejs';
import { toastSuccess, toastError } from './ui/alerts';
import { confirmDelete } from './ui/confirmations';

window.Alpine = Alpine;

Alpine.start();



document.addEventListener('DOMContentLoaded', () => {
    const toastElement = document.getElementById('app-toast');

    if (!toastElement) return;

    const type = toastElement.dataset.type;
    const message = toastElement.dataset.message;

    if (type === 'success') {
        toastSuccess(message);
    }

    if (type === 'error') {
        toastError(message);
    }
});

document.addEventListener('submit', async (event) => {
    const form = event.target;

    if (!form.classList.contains('js-delete-form')) return;

    event.preventDefault();

    const button = form.querySelector('button[data-name]');
    const name = button?.dataset.name ?? 'este elemento';

    const confirmed = await confirmDelete(name);

    if (confirmed) {
        form.submit();
    }
});
