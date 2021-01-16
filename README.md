# Sistema contable

Sistema contable desarrollado para la materia Sistemas Contables.

## Instalacion

Clonar el repositorio

```bash
git clone https://github.com/marlon56115/sistema_contable.git
```

## Ejecutar
requisitos para correr:
- **Composer**
- **Laravel 8.x**
- **MariaDB**
- **Node js**

Editar el archivo .env y cambiar las credenciales de MariaDB, luego ejecutar:
```bash
npm install #instalamos las dependencias de npm
composer update #instalamos las dependencias de php
php artisan migrate --seed #creara la base de datos 
php artisan serve #ejecutamos en el servidor
npm run watch #para compilar js en tiempo real
```
