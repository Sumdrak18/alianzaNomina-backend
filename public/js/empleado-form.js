// public/js/empleado-form.js → SOLO para create/edit de empleados
document.addEventListener('DOMContentLoaded', function () {
    const ciudades = {
        'Colombia': ['Bogotá', 'Medellín', 'Cali', 'Cartagena', 'Barranquilla', 'Bucaramanga', 'Santa Marta'],
        'México': ['CDMX', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'León', 'Querétaro'],
        'Argentina': ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata', 'Mar del Plata', 'Salta']
    };

    const paisSelect = document.getElementById('pais');
    const ciudadSelect = document.getElementById('ciudad');

    if (!paisSelect || !ciudadSelect) return;

    // Valor guardado (con old() para errores de validación)
    const ciudadGuardada = "{{ old('ciudad_nacimiento', isset($empleado) ? $empleado->ciudad_nacimiento : '') }}".trim();

    function cargarCiudades() {
        const pais = paisSelect.value;
        ciudadSelect.innerHTML = '<option value="">-- Seleccione ciudad --</option>';

        if (ciudades[pais]) {
            ciudades[pais].forEach(ciudad => {
                const option = document.createElement('option');
                option.value = ciudad;
                option.textContent = ciudad;
                if (ciudad === ciudadGuardada) option.selected = true;
                ciudadSelect.appendChild(option);
            });
        }
    }

    // Cargar al inicio
    cargarCiudades();

    // Recargar al cambiar país
    paisSelect.addEventListener('change', cargarCiudades);
});