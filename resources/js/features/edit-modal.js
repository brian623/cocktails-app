document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-edit-cocktail').forEach((button) => {
        button.addEventListener('click', () => {
            const form = document.getElementById('editCocktailForm');

            form.action = `/cocktails/${button.dataset.id}`;

            document.getElementById('edit-name').value = button.dataset.name;
            document.getElementById('edit-category').value = button.dataset.category ?? '';
            document.getElementById('edit-alcoholic').value = button.dataset.alcoholic ?? '';
        });
    });
});
