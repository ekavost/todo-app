## Gestor de Tareas

Este es un proyecto desarrollado con **Laravel 10** integrado con **Vue 3** y **Vuetify 3** para crear un sistema completo de gestión de tareas. La aplicación permite funcionalidades de crear, leer, actualizar y eliminar tareas (CRUD). También incluye un diseño simple para listar tareas pendientes y completadas, además de integración con una API externa para mostrar citas o mensajes aleatorios.

### Pasos de instalación del entorno

- Clonar el Repositorio
  ~~~
  git clone https://github.com/ekavost/todo-app.git
  cd todo-app/
  ~~~
- Instalar Dependencias de PHP.
  
  Utilizar composer para instalar las dependencias necesarias para Laravel:
  ~~~
  composer install
  ~~~
- Instalar Dependencias de JavaScript
  ~~~
  npm install
  ~~~
### Configuración de la base de datos.
- Configurar el Archivo .env
  
  Copiar el archivo de configuración de ejemplo
  ~~~
  cp .env.example .env
  ~~~
- Crear el archivo de la base de datos SQLite
  
  En la carpeta database del proyecto crear un archivo vacío database.sqlite
  ~~~
  cd database/
  touch database.sqlite
  ~~~
- Generar la clave APP_KEY
  
  Laravel necesita una clave única para operaciones de encriptación. Si esta clave está vacía, aparecerá el      error *"No application encryption key has been specified"*.
  ~~~
  cd ..
  php artisan key:generate
  ~~~
    Laravel intentará escribir la clave directamente en el archivo .env.: `APP_KEY=base64:XXX…=`
- Ejecutar las Migraciones
  ~~~
  php artisan migrate
  ~~~
### Iniciar la Aplicación
- Iniciar el Servidor de Laravel
  ~~~
  php artisan serve
  ~~~
  El servidor backend estará disponible por defecto en http://127.0.0.1:8000.
- Inicia el Servidor de Vue
  ~~~
  npm run dev
  ~~~
  El servidor frontend estará disponible por defecto en http://localhost:5173.

## Integración con la API Externa
Este proyecto consume una API externa para obtener una cita o broma aleatoria y mostrarla en el encabezado de la aplicación. La API utilizada es [JokeAPI](https://v2.jokeapi.dev/).

La integración con la API se encuentra en el archivo App.vue:
- Método: fetchRandomQuote()
- Endpoint API: https://v2.jokeapi.dev/joke/Any?type=single
