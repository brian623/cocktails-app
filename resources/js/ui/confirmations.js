import Swal from 'sweetalert2';

export const confirmDelete = async (name = 'este elemento') => {
    const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: `Se eliminará ${name} de forma permanente`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        focusCancel: true,
    });
    
    return result.isConfirmed;
};
