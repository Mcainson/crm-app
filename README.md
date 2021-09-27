CRM APP
===
> API para gestionar empresas y a sus empleados

## Catacterísticas
API Restful

-   Laravel 8
-   PHP 8

## Instalación
-   Clonar repositorio 
-   Crear arhivo .env `cp .env.example .env`
-   Editar `.env` añadir la configuración de la base de datos
-   Ejecutar `composer install` para instalar dependencias de Laravel
-   Ejecutar `sail artisan key:generate` para generar una key de aplicación
-   Ejecutar `sail artisan migrate --seed` crear estructura base con datos

Se puede usar cualquier metodo para montar el proyecto, pero se recomanda usar Laravel Sail.
-   Ejecuta  `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail` que es un alias de Bash que le permita ejecutar los comandos de Sail más fácilmente.
- Una vez que se ha configurado el alias de Bash, puede ejecutar los comandos Sail simplemente escribiendo Sail.  `Sail up` para arrancar el proyecto.

## Configuración
#### 1. Variables de entorno
- Debe añadir:
  - Variables de entorno para la configuración base de datos
  - Variables de entorno para la configuración del correo

#### 2. Cabecera api rest
- Authorization (Para agregar el token de autorización.  Es de tipo Bearer. Obligatorio para las peticiones protegidas)
- X-localization (Opcional, el valor indica el idioma de las respuesta del API. Acepta "en" o "es".)
- Accept : application/json

#### 3. Credenciales

Se puede iniciar sesión con los siguientes credenciales
```bash
Usuario: admin@admin.com
Contraseña: password
```

**Para correr pruebas unitarias:**

```
sail artisan test
```

# Referencias

-   [Laravel](https://laravel.com/docs/8.x)
-   [Laravel Sail](https://laravel.com/docs/8.x/sail)
-   [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum)

## Adicional

### Postman

-   [Descarga](https://www.getpostman.com/downloads/)