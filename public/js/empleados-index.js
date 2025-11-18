// public/js/empleados-index.js → Versión que NUNCA falla
document.addEventListener('DOMContentLoaded', function () {
    // Busca el input por ID (más seguro)
    const searchInput = document.getElementById('search');
    if (!searchInput) {
        console.warn('No se encontró el input #search');
        return;
    }

    // Todos los ítems (funciona tanto en tabla como en tarjetas)
    const items = document.querySelectorAll('.empleado-item');

    searchInput.addEventListener('input', function () { // "input" es más rápido que "keyup"
        const term = this.value.toLowerCase().trim();

        items.forEach(item => {
            const texto = item.textContent.toLowerCase();
            if (texto.includes(term)) {
                item.classList.remove('hide');
            } else {
                item.classList.add('hide');
            }
        });
    });

    // Opcional: limpiar al borrar todo
    searchInput.addEventListener('search', () => {
        if (!searchInput.value) {
            items.forEach(item => item.classList.remove('hide'));
        }
    });
});