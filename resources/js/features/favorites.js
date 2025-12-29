document.addEventListener('submit', (e) => {
    const form = e.target.closest('.js-favorite-form');
    if (!form) return;

    const button = form.querySelector('button');
    button.disabled = true;
});
