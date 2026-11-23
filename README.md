# City Farmac · Instancia 1: Template y vistas

Proyecto de **Producción Web · Análisis de Sistemas** (Da Vinci). Maquetado del sitio público y del panel de administración de City Farmac, con datos de ejemplo.

- **Integrantes:** Sergio Omar Trujillo Quiroz y Marcelo Tremari
- **Repositorio:** https://github.com/Ma-Tr3/CityFarmac
- **Tecnologías:** PHP 8+, HTML5, CSS3

## Alcance

No requiere una base de datos SQL. El proyecto comienza con datos de ejemplo y guarda los cambios en `upload/datos/cityfarmac.json`. El registro y el inicio de sesión funcionan; el panel controla el acceso según los permisos del perfil. Los formularios de administración permiten gestionar los registros.

## Cómo abrir el proyecto

Requisitos: XAMPP (o un servidor con PHP 8 o superior). No requiere configurar una base de datos SQL.

1. Copiar la carpeta del proyecto dentro de `htdocs` (en XAMPP para Mac: `/Applications/XAMPP/xamppfiles/htdocs`). La carpeta puede tener cualquier nombre.
2. Iniciar **Apache** desde el panel de control de XAMPP.
3. Abrir en el navegador: `http://localhost/CityFarmac/` (reemplazar `CityFarmac` por el nombre de la carpeta si es distinto).

`index.php` redirige al inicio del sitio público.

## Ruta base

El proyecto detecta automáticamente su ruta base a partir de la ubicación de la carpeta. Si cambiás su nombre, abrí el sitio usando ese nombre en la URL.

## Vistas

Dirección base de los ejemplos: `http://localhost/CityFarmac/` (ajustala al nombre de tu carpeta).

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
| Usuario Admin | `admin@cityfarmac.com` |
| Password Admin | `Admin12345!` |

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
