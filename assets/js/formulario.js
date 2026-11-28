function filtrarProductos() {
    const categoria = document.querySelector('[data-filter-category]')?.value || '';
    const subcategoria = document.querySelector('[data-filter-subcategory]')?.value || '';
    const filas = Array.from(document.querySelectorAll('[data-record]'));

    filas.forEach((fila) => {
        const coincideCategoria = categoria === '' || fila.dataset.category === categoria;
        const coincideSubcategoria = subcategoria === '' || fila.dataset.subcategory === subcategoria;

        fila.hidden = !(coincideCategoria && coincideSubcategoria);
    });

    const filaVacia = document.querySelector('[data-empty-row]');
    if (filaVacia) {
        filaVacia.hidden = filas.some((fila) => !fila.hidden);
    }
}

document.querySelectorAll('[data-form-category], [data-filter-category]').forEach((categoria) => {
    const esFormulario = categoria.hasAttribute('data-form-category');
    const selector = esFormulario ? '[data-form-subcategory]' : '[data-filter-subcategory]';
    const subcategoria = document.querySelector(selector);

    if (!subcategoria) {
        return;
    }

    function actualizarSubcategorias() {
        const filtraPorPadre = esFormulario || categoria.value !== '';

        Array.from(subcategoria.options).forEach((opcion) => {
            const tienePadre = Boolean(opcion.dataset.parent);
            const coincidePadre = opcion.dataset.parent === categoria.value;

            opcion.hidden = tienePadre && filtraPorPadre && !coincidePadre;
            opcion.disabled = opcion.hidden;
        });

        if (subcategoria.selectedOptions[0]?.disabled) {
            subcategoria.value = '';
        }

        if (!esFormulario) {
            filtrarProductos();
        }
    }

    categoria.addEventListener('change', actualizarSubcategorias);
    actualizarSubcategorias();
});

document.querySelector('[data-filter-subcategory]')
    ?.addEventListener('change', filtrarProductos);

const inputImagen = document.querySelector('[data-image-input]');
const vistaPrevia = document.querySelector('[data-image-preview]');

if (inputImagen && vistaPrevia) {
    const imagenOriginal = vistaPrevia.getAttribute('src');
    let urlTemporal = null;

    inputImagen.addEventListener('change', () => {
        if (urlTemporal !== null) {
            URL.revokeObjectURL(urlTemporal);
            urlTemporal = null;
        }

        const archivo = inputImagen.files[0];

        if (archivo) {
            urlTemporal = URL.createObjectURL(archivo);
            vistaPrevia.src = urlTemporal;
        } else if (imagenOriginal) {
            vistaPrevia.src = imagenOriginal;
        }
    });
}