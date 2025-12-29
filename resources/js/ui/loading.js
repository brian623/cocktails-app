export function setLoading(form, isLoading = true) {
    const button = form.querySelector('button[type="submit"]');
    if (!button) return;

    button.disabled = isLoading;
    button.dataset.originalText ??= button.innerHTML;

    button.innerHTML = isLoading
        ? '<span class="spinner-border spinner-border-sm"></span>'
        : button.dataset.originalText;
}
