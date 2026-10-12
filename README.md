# City Farmac · Instancia 1: Template y vistas

Proyecto de **Producción Web · Análisis de Sistemas** (Da Vinci). Maquetado del sitio público y del panel de administración de City Farmac, con datos de ejemplo.

- **Integrantes:** Sergio Omar Trujillo Quiroz y Marcelo Tremari
- **Repositorio:** https://github.com/Ma-Tr3/CityFarmac
- **Tecnologías:** PHP 8+, HTML5, CSS3

## Alcance

No hay base de datos: el contenido se muestra con datos de ejemplo. Los formularios no envían información, el login no es funcional y no hay control de permisos.

## Cómo abrir el proyecto

Requisitos: XAMPP (o un servidor con PHP 8 o superior). No requiere base de datos.

1. Copiar la carpeta del proyecto dentro de `htdocs` (en XAMPP para Mac: `/Applications/XAMPP/xamppfiles/htdocs`). **La carpeta debe llamarse exactamente `CityFarmac`.**
2. Iniciar **Apache** desde el panel de control de XAMPP.
3. Abrir en el navegador: `http://localhost/CityFarmac/`

`index.php` redirige al inicio del sitio público.

## Ruta base

El proyecto usa rutas relativas desde cada vista hacia las carpetas `assets/` y `views/`. Por eso la carpeta debe llamarse `CityFarmac` y estar directamente dentro de `htdocs`. Si se la renombra o se la mueve a otro lugar, los estilos y los links dejan de cargar.

## Vistas

Dirección base de los ejemplos: `http://localhost/CityFarmac/`
en caso de ser necesario renombre la carpeta dentro del htdocs y vea si no hay error alguno

### Sitio público

| Vista | URL |
|---|---|
| Home | `views/public/inicio.php` |
| Listado de productos | `views/public/catalogo.php` |
| Listado con filtros | `views/public/catalogo.php?categoria=Cuidado facial&marca=Dermacare` |
| Listado vacío | `views/public/catalogo.php?categoria=Dermocosmética&marca=Aura` |
| Detalle de producto | `views/public/detalle.php?id=1` |
| Contáctenos | `views/public/contacto.php` |
| Página 404 | `error-404.php` |

### Acceso y registro

| Vista | URL |
|---|---|
| Login | `login.php` |
| Registro | `registro.php` |

### Panel de administración

| Vista | URL |
|---|---|
| Inicio del panel | `views/admin/panel-inicio.php` |
| Productos (listado) | `views/admin/panel-productos.php` |
| Productos (alta) | `views/admin/alta-productos.php` |
| Productos (edición) | `views/admin/editar-productos.php` |
| Categorías (listado) | `views/admin/panel-categorias.php` |
| Categorías (edición) | `views/admin/editar-categorias.php` |
| Marcas (listado) | `views/admin/panel-marcas.php` |
| Marcas (edición) | `views/admin/editar-marcas.php` |
| Comentarios | `views/admin/panel-comentarios.php` |
| Usuarios (listado) | `views/admin/panel-usuarios.php` |
| Usuarios (alta) | `views/admin/alta-usuarios.php` |
| Usuarios (edición) | `views/admin/editar-usuarios.php` |
| Perfiles (listado) | `views/admin/panel-perfiles.php` |
| Perfiles (edición) | `views/admin/editar-perfiles.php` |

## Estructura de carpetas
