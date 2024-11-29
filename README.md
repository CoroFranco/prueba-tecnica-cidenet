# Configuración del Backend y Documentación de la API 🚀

Este proyecto contiene la configuración del backend para la aplicación. A continuación, se describen los pasos para configurar el entorno.

## 📋 Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes componentes:

- PHP
- Composer
- MySQL
- Apache

## 🛠️ Configuración del Proyecto

1. **Instala las dependencias usando Composer y npm:**

   En el directorio raíz del proyecto, ejecuta el siguiente comando:

   ```bash
   composer install
   npm install
   ```

2. **Configura el archivo de entorno .env:**

   Ejecuta el siguiente comando en el directorio raíz del proyecto:

   ```bash
   cp .env.example .env
   ```

3. **Crea una base de datos en tu servidor MySQL y configura la conexión en el archivo .env:**

   En el archivo .env, modifica las siguientes variables:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_db
   DB_USERNAME=usuario_db
   DB_PASSWORD=contraseña_db
   ```

4. **Genera la clave de la aplicación:**

   Ejecuta el siguiente comando en el directorio raíz del proyecto:

   ```bash
   php artisan key:generate
   ```

5. **Ejecuta los comandos para crear la base de datos y la tabla de employees:**

   Ejecuta el siguiente comando en el directorio raíz del proyecto:

   ```bash
   php artisan migrate
   ```

6. **Iniciar el servidor de desarrollo:**

   Ejecuta el siguiente comando en el directorio raíz del proyecto:

   ```bash
   php artisan serve
   npm run dev
   ```

7. **Ahora puedes tener registro de tus empleados**
