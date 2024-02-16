document.addEventListener("DOMContentLoaded", function () {
    const categoryCheckboxes = document.querySelectorAll('.categoria-checkbox');
    const storedCategorySelections = localStorage.getItem('selectedCategories');
    
    // Restaurar las categorías seleccionadas desde el localStorage
    if (storedCategorySelections) {
        const selectedCategories = storedCategorySelections.split(',');
        selectedCategories.forEach(category => {
            const checkbox = document.querySelector(`.categoria-checkbox[value="${category}"]`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }

    // Agregar evento de clic a cada checkbox de categoría para actualizar productos
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function () {
            updateProducts();
            
            // Almacena las categorías seleccionadas en localStorage
            const selectedCategories = Array.from(categoryCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);
            
            localStorage.setItem('selectedCategories', selectedCategories.join(','));
        });
    });

    // Agregar evento de cambio a cada checkbox de producto para actualizar filtro
    const productCheckboxes = document.querySelectorAll('.form-check-input');
    productCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', actualizarFiltro);
    });

    // Actualizar productos y filtros al cargar la página
    updateProducts();
    actualizarFiltro();

    function updateProducts() {
        const selectedCategories = Array.from(categoryCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        const allProducts = document.querySelectorAll('carta col-12 col-lg-3 mb-2 productos');

        if (selectedCategories.length === 0) {
            allProducts.forEach(product => product.style.display = 'block');
        } else {
            allProducts.forEach(product => {
                const productCategory = product.getAttribute('selCategoria');
                const isVisible = selectedCategories.includes(productCategory);
                product.style.display = isVisible ? 'block' : 'none';
            });
        }
    }

    function actualizarFiltro() {
        const productos = document.querySelectorAll('.productos');
        const tiposSeleccionados = obtenerTipos();

        productos.forEach(function (producto) {
            const tipoProducto = producto.dataset.categoria;

            if (tiposSeleccionados.includes(tipoProducto) || tiposSeleccionados.length === 0) {
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        });

        function obtenerTipos() {
            const tiposSeleccionados = [];
            productCheckboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    tiposSeleccionados.push(checkbox.value);
                }
            });
            return tiposSeleccionados;
        }
    }
});

