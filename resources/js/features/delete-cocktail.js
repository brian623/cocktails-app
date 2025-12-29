import { confirmDelete } from '../ui/confirmations';
import { setLoading } from '../ui/loading';

document.addEventListener('submit', async (e) => {
    const form = e.target.closest('.js-delete-form');
    if (!form) return;

    e.preventDefault();
    console.log(form.action);
    
    const name = form.dataset.name;

    const result = await confirmDelete(name);
    if (!result) return;
    
    setLoading(form, true);
    form.submit();
});
