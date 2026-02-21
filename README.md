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

REQUISITOS DEL SISTEMA

PHP 8.2 o superior

Composer

MySQL

Laravel 12

Navegador web

BASE DE DATOS
Crear la base de datos en MySQL:

CREATE DATABASE inventario CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

Configurar el archivo .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario
DB_USERNAME=root
DB_PASSWORD=

TABLAS DEL SISTEMA

marcas

categorias

proveedores

productos

Relaciones:
Un producto pertenece a una categoría, una marca y un proveedor.

MIGRACIONES
Ejecutar:

php artisan migrate

SEEDERS
Ejecutar:

php artisan db:seed

EJECUCIÓN DEL PROYECTO

Instalar dependencias
composer install

Ejecutar migraciones
php artisan migrate

Ejecutar seeders
php artisan db:seed

Iniciar servidor
php artisan serve

Abrir en el navegador:
http://127.0.0.1:8000

RUTAS WEB DEL SISTEMA (INTERFAZ)

Página principal:
http://127.0.0.1:8000/

CRUD Marcas:
http://127.0.0.1:8000/marcas

http://127.0.0.1:8000/marcas/create

http://127.0.0.1:8000/marcas/{id}/edit

CRUD Categorías:
http://127.0.0.1:8000/categorias

http://127.0.0.1:8000/categorias/create

http://127.0.0.1:8000/categorias/{id}/edit

CRUD Proveedores:
http://127.0.0.1:8000/proveedores

http://127.0.0.1:8000/proveedores/create

http://127.0.0.1:8000/proveedores/{id}/edit

RUTAS API REST

Marcas:
GET http://127.0.0.1:8000/api/marcas

POST http://127.0.0.1:8000/api/marcas

PUT http://127.0.0.1:8000/api/marcas/{id}

DELETE http://127.0.0.1:8000/api/marcas/{id}

Categorías:
GET http://127.0.0.1:8000/api/categorias

POST http://127.0.0.1:8000/api/categorias

PUT http://127.0.0.1:8000/api/categorias/{id}

DELETE http://127.0.0.1:8000/api/categorias/{id}

Proveedores:
GET http://127.0.0.1:8000/api/proveedores

POST http://127.0.0.1:8000/api/proveedores

PUT http://127.0.0.1:8000/api/proveedores/{id}

DELETE http://127.0.0.1:8000/api/proveedores/{id}

VALIDACIONES IMPLEMENTADAS

nombre → required | string | max:255

Conversión del checkbox:
$data['estado'] = $request->has('estado');

FUNCIONALIDADES IMPLEMENTADAS

Crear registros
Editar registros
Eliminar registros
Listar registros
Validaciones
Manejo de errores
API REST funcional
Interfaz Web completa
