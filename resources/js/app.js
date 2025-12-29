import './bootstrap';

import './features/favorites';
import './features/edit-modal';
import './features/delete-cocktail';

import { initToastsFromSession } from './ui/alerts';

document.addEventListener('DOMContentLoaded', () => {
    initToastsFromSession();
});
