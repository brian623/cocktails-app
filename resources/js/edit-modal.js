document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('editCocktailModal');
    const form = document.getElementById('editCocktailForm');

    modal?.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const category = button.getAttribute('data-category');
        const alcoholic = button.getAttribute('data-alcoholic');

        form.action = `/cocktails/${id}`;

        document.getElementById('edit-name').value = name ?? '';
        document.getElementById('edit-category').value = category ?? '';
        document.getElementById('edit-alcoholic').value = alcoholic ?? '';
    });
});
