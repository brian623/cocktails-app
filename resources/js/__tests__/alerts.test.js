import { toastSuccess, toastError } from '../alerts';

test('toastSuccess shows success toast', () => {
    const spy = vi.spyOn(window, 'alert').mockImplementation(() => {});
    toastSuccess('OK');
    expect(spy).toHaveBeenCalled();
});

import { confirmDelete } from '../confirmations';

test('confirmDelete returns true when confirmed', async () => {
    global.Swal = {
        fire: vi.fn().mockResolvedValue({ isConfirmed: true }),
    };

    const result = await confirmDelete({ title: 'Test' });

    expect(result).toBe(true);
});

test('submit form when confirmed', async () => {
    document.body.innerHTML = `
        <form id="f"></form>
    `;

    const form = document.getElementById('f');
    form.submit = vi.fn();

    // mock confirmDelete → true
    await handleDelete(form);

    expect(form.submit).toHaveBeenCalled();
});
