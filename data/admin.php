<?php

return ['productos' => [
    ['id' => 1, 'estado' => 1, 'nombre' => 'Protector solar FPS 50', 'descripcion' => 'Descripción de ejemplo de Protector solar FPS 50.', 'modelo' => 'Presentación estándar', 'marca' => 'Dermacare', 'precio' => 18900, 'categoria' => 'Dermocosmética', 'subcategoria' => 'Protección solar', 'categoria_id' => 1, 'subcategoria_id' => 11, 'imagen' => 'solar.svg', 'destacado' => 1],
    ['id' => 2, 'estado' => 1, 'nombre' => 'Crema hidratante facial', 'descripcion' => 'Descripción de ejemplo de Crema hidratante facial.', 'modelo' => 'Presentación estándar', 'marca' => 'Hydra Lab', 'precio' => 12400, 'categoria' => 'Dermocosmética', 'subcategoria' => 'Cuidado facial', 'categoria_id' => 1, 'subcategoria_id' => 12, 'imagen' => 'crema.svg', 'destacado' => 1],
    ['id' => 3, 'estado' => 1, 'nombre' => 'Gel de limpieza suave', 'descripcion' => 'Descripción de ejemplo de Gel de limpieza suave.', 'modelo' => 'Presentación estándar', 'marca' => 'Dermacare', 'precio' => 9800, 'categoria' => 'Dermocosmética', 'subcategoria' => 'Cuidado facial', 'categoria_id' => 1, 'subcategoria_id' => 12, 'imagen' => 'gel.svg', 'destacado' => 1],
    ['id' => 4, 'estado' => 1, 'nombre' => 'Shampoo reparación', 'descripcion' => 'Descripción de ejemplo de Shampoo reparación.', 'modelo' => 'Presentación estándar', 'marca' => 'Botánica', 'precio' => 7600, 'categoria' => 'Cuidado personal', 'subcategoria' => 'Cabello', 'categoria_id' => 2, 'subcategoria_id' => 21, 'imagen' => 'shampoo.svg', 'destacado' => 1],
    ['id' => 5, 'estado' => 1, 'nombre' => 'Perfume floral 50 ml', 'descripcion' => 'Descripción de ejemplo de Perfume floral 50 ml.', 'modelo' => 'Presentación estándar', 'marca' => 'Aura', 'precio' => 32500, 'categoria' => 'Perfumería', 'subcategoria' => 'Fragancias', 'categoria_id' => 3, 'subcategoria_id' => 31, 'imagen' => 'perfume.svg', 'destacado' => 1],
    ['id' => 6, 'estado' => 1, 'nombre' => 'Loción corporal', 'descripcion' => 'Descripción de ejemplo de Loción corporal.', 'modelo' => 'Presentación estándar', 'marca' => 'Hydra Lab', 'precio' => 11200, 'categoria' => 'Cuidado personal', 'subcategoria' => 'Cuerpo', 'categoria_id' => 2, 'subcategoria_id' => 22, 'imagen' => 'locion.svg', 'destacado' => 1],
    ['id' => 7, 'estado' => 0, 'nombre' => 'Acondicionador nutritivo', 'descripcion' => 'Descripción de ejemplo de Acondicionador nutritivo.', 'modelo' => 'Presentación estándar', 'marca' => 'Botánica', 'precio' => 8100, 'categoria' => 'Cuidado personal', 'subcategoria' => 'Cabello', 'categoria_id' => 2, 'subcategoria_id' => 21, 'imagen' => 'shampoo.svg', 'destacado' => 0]
], 'categorias' => [
    ['id' => 1, 'estado' => 1, 'nombre' => 'Dermocosmética', 'padre' => 'Principal'],
    ['id' => 2, 'estado' => 1, 'nombre' => 'Cuidado personal', 'padre' => 'Principal'],
    ['id' => 3, 'estado' => 1, 'nombre' => 'Perfumería', 'padre' => 'Principal']
,
['id' => 11, 'estado' => 1, 'nombre' => 'Protección solar', 'padre' => 'Dermocosmética', 'padre_id' => 1],
['id' => 12, 'estado' => 1, 'nombre' => 'Cuidado facial', 'padre' => 'Dermocosmética', 'padre_id' => 1],
['id' => 21, 'estado' => 1, 'nombre' => 'Cabello', 'padre' => 'Cuidado personal', 'padre_id' => 2],
['id' => 22, 'estado' => 1, 'nombre' => 'Cuerpo', 'padre' => 'Cuidado personal', 'padre_id' => 2],
['id' => 31, 'estado' => 1, 'nombre' => 'Fragancias', 'padre' => 'Perfumería', 'padre_id' => 3]
], 'marcas' => [
    ['id' => 1, 'estado' => 1, 'nombre' => 'Dermacare'],
    ['id' => 2, 'estado' => 1, 'nombre' => 'Hydra Lab'],
    ['id' => 3, 'estado' => 1, 'nombre' => 'Botánica'],
    ['id' => 4, 'estado' => 1, 'nombre' => 'Aura']
], 'usuarios' => [
    ['id' => 1, 'estado' => 1, 'nombre' => 'Marcelo Tremari', 'email' => 'marcelo@ejemplo.com', 'perfil' => 'Administrador'],
    ['id' => 2, 'estado' => 1, 'nombre' => 'Lucía Pérez', 'email' => 'lucia@ejemplo.com', 'perfil' => 'Editor'],
    ['id' => 3, 'estado' => 0, 'nombre' => 'Martín Rojas', 'email' => 'martin@ejemplo.com', 'perfil' => 'Moderador']
], 'perfiles' => [
    ['id' => 1, 'estado' => 1, 'nombre' => 'Administrador', 'secciones' => 'Productos, Categorías, Marcas, Comentarios, Usuarios, Perfiles'],
    ['id' => 2, 'estado' => 1, 'nombre' => 'Editor', 'secciones' => 'Productos, Categorías, Marcas'],
    ['id' => 3, 'estado' => 1, 'nombre' => 'Moderador', 'secciones' => 'Comentarios']
], 'comentarios' => [
    ['id' => 1, 'estado' => 1, 'comentario' => 'Muy buena textura. Lo incorporé a mi rutina diaria.', 'email' => 'lucia@ejemplo.com', 'ranking' => 5, 'fecha' => '03/10/2026', 'producto_id' => 1, 'producto' => 'Protector solar FPS 50'],
    ['id' => 2, 'estado' => 1, 'comentario' => 'Buen producto, cumple con lo esperado.', 'email' => 'martin@ejemplo.com', 'ranking' => 5, 'fecha' => '04/10/2026', 'producto_id' => 1, 'producto' => 'Protector solar FPS 50'],
    ['id' => 3, 'estado' => 1, 'comentario' => 'Es suave y se absorbe rápido.', 'email' => 'ana@ejemplo.com', 'ranking' => 4, 'fecha' => '04/10/2026', 'producto_id' => 2, 'producto' => 'Crema hidratante facial'],
    ['id' => 4, 'estado' => 0, 'comentario' => 'Me gustó el aroma, lo volvería a elegir.', 'email' => 'pedro@ejemplo.com', 'ranking' => 5, 'fecha' => '05/10/2026', 'producto_id' => 5, 'producto' => 'Perfume floral 50 ml']
]];
