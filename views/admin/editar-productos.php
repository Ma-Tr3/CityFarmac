<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>
<link rel="stylesheet" href="../../assets/css/editar-productos.css">
<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <a href="/views/admin/panel-productos.php">Productos</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>
    <div class="page-heading">
        <h1>Modificar producto</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form" data-demo-form="admin">
        <div class="form-grid">
            <div class="span-all">
                <label for="nombre">Nombre</label>
                <input
                    id="nombre"
                    name="nombre"
                    required
                    maxlength="120"
                    value="Protector solar FPS 50" />
            </div>
            <div class="span-all">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required maxlength="2000">
Protección diaria de amplio espectro FPS 50. Textura ligera, de rápida absorción y acabado suave. Presentación de 50 ml.</textarea>
            </div>
            <div>
                <label for="precio">Precio ($)</label>
                <input
                    id="precio"
                    name="precio"
                    type="number"
                    required
                    min="0.01"
                    max="99999999"
                    step="0.01"
                    value="18900" />
            </div>
            <div>
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required data-form-category>
                    <option value="">Seleccioná una categoría</option>
                    <option value="1" selected>Dermocosmética</option>
                    <option value="2">Cuidado personal</option>
                    <option value="3">Perfumería</option>
                </select>
            </div>
            <div>
                <label for="subcategoria">Subcategoría</label>
                <select
                    id="subcategoria"
                    name="subcategoria"
                    required
                    data-form-subcategory>
                    <option value="">Seleccioná una subcategoría</option>
                    <option value="11" data-parent="1" selected>
                        Protección solar
                    </option>
                    <option value="12" data-parent="1">Cuidado facial</option>
                    <option value="21" data-parent="2">Cabello</option>
                    <option value="22" data-parent="2">Cuerpo</option>
                    <option value="31" data-parent="3">Fragancias</option>
                </select>
            </div>
            <div>
                <label for="marca">Marca</label>
                <select id="marca" name="marca" required>
                    <option value="">Seleccioná una marca</option>
                    <option selected>Dermacare</option>
                    <option>Hydra Lab</option>
                    <option>Botánica</option>
                    <option>Aura</option>
                </select>
            </div>
            <div>
                <label for="modelo">Modelo</label>
                <input
                    id="modelo"
                    name="modelo"
                    required
                    maxlength="100"
                    value="Solar Protect" />
            </div>
            <div>
                <label for="imagen">Imagen del producto</label>
                <input
                    id="imagen"
                    name="imagen"
                    type="file"
                    accept="image/png,image/jpeg,image/webp"
                    data-image-input
                    aria-describedby="image-help" />
                <small id="image-help" class="muted">
                    JPG, PNG o WebP. Opcional: conserva la imagen de ejemplo.
                </small>
            </div>
            <div class="span-all image-preview">
                <img
                    data-image-preview
                    src="/assets/img/products/solar.svg"
                    alt="Vista previa del producto"
                    width="90"
                    height="110" />
            </div>
            <label class="check span-all" for="destacado">
                <input id="destacado" name="destacado" type="checkbox" checked />
                Marcar como producto destacado
            </label>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="/views/admin/panel-productos.php"> Cancelar </a>
            <button class="button primary" type="submit">Guardar producto</button>
        </div>
    </form>
</main>