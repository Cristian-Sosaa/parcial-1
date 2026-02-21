PROYECTO CRUD INVENTARIO – LARAVEL

Descripción del Proyecto
Este proyecto consiste en el desarrollo de un sistema CRUD utilizando Laravel y MySQL basado en el modelo entidad-relación proporcionado en el parcial.

El sistema incluye:

Migraciones con llaves primarias y foráneas

Relaciones entre tablas

Seeders con registros iniciales

API REST funcional

CRUD con interfaz web usando Blade y Bootstrap

Validaciones y manejo de errores

Requisitos del Sistema

PHP 8.2 o superior

Composer

MySQL

Laravel 12

Navegador web

Base de Datos
Crear la base de datos en MySQL:

CREATE DATABASE inventario CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

Configurar el archivo .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario
DB_USERNAME=root
DB_PASSWORD=

Tablas del Sistema
Se crearon las siguientes tablas:

marcas

categorias

proveedores

productos

Relaciones:
Un producto pertenece a una categoría, una marca y un proveedor.

Migraciones
Ejecutar el siguiente comando:

php artisan migrate

Seeders
Se crearon seeders para las tablas de catálogo:

Marcas

Categorías

Proveedores

Ejecutar:

php artisan db:seed

API REST
Endpoints disponibles:

GET /api/marcas → Listar
POST /api/marcas → Crear
PUT /api/marcas/{id} → Actualizar
DELETE /api/marcas/{id} → Eliminar

Lo mismo aplica para:

/api/categorias

/api/proveedores

Ver todas las rutas:
php artisan route:list

Interfaz Web (CRUD)

Rutas disponibles:

/marcas → Listar marcas
/marcas/create → Crear marca
/marcas/{id}/edit → Editar marca

/categorias → CRUD categorías
/proveedores → CRUD proveedores

Tecnologías usadas:

Blade

Bootstrap 5

Controladores Laravel

Validaciones Implementadas

Validación principal:
'nombre' => required | string | max:255

Conversión correcta del checkbox:
$data['estado'] = $request->has('estado');

Ejecución del Proyecto

Instalar dependencias:
composer install

Configurar archivo .env

Ejecutar migraciones:
php artisan migrate

Ejecutar seeders:
php artisan db:seed

Iniciar servidor:
php artisan serve

Abrir en el navegador:
http://127.0.0.1:8000

Funcionalidades Implementadas

Crear registros
Editar registros
Eliminar registros
Listar registros
Validaciones de formularios
Manejo de errores
API REST funcional
Interfaz Web completa
