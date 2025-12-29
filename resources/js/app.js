import './bootstrap';

import './features/favorites';
import './features/edit-modal';
import './features/delete-cocktail';

import { initToastsFromSession } from './ui/alerts';
import Alpine from 'alpinejs';

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initToastsFromSession();
});
