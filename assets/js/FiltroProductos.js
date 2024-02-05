document.addEventListener("DOMContentLoaded", function () {
    let checkbox = document.querySelectorAll('.form-check-input');

    checkbox.forEach(function (checkbox) {
        checkbox.addEventListener('change', actualizarfiltro);
    });

    function actualizarfiltro() {
        let productos = document.querySelectorAll('.productos');

        let tipos = obtenerTipos();

        productos.forEach(function (producto) {
            let tipoProducto = producto.dataset.categoria;

            if (tipos.includes(tipoProducto) || tipos.length === 0) {
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        });
        function obtenerTipos() {
            let tiposSeleccionados = [];
            checkbox.forEach(function (checkbox) {
                if (checkbox.checked) {
                    tiposSeleccionados.push(checkbox.value);
                }
            });
            return tiposSeleccionados;
        }
    }
});

