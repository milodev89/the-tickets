
<h2>The Tickets Project</h2>

<p>
Este proyecto esta realizado con el Framwork Laravel de PHP, así mismo utilicé el Framework de Javascript Vuejs, dos frameworks que trabajan de la mano para optimizar y mejorar procesos al momento de desarrollar proyectos.

PASOS A SEGUIR:

Al descargar el proyecto desde el repositorio, tendrán que hacer una serie de pasos para que funcione correctamente la app. Aqui se describen los pasos a pasos con sus respetivos comandos:

- Desde la terminal de comandos debe estar en la carpeta del proyecto para poder realizar las siguientes ejecuciones.

- Se deberá ejecutar y actualizar los paquetes que tenga por ello se sugiere ejecutar: "composer install" y "npm install"

- En el archivo .env.example debe modificarse a .env y se ejecuta "php artisan key:generate" para generar la key de Laravel.

- Cuando su proyecto esté en su local, deberá ejecutar las migraciones para la creación de la Base de Datos y de la tabla. Si desea puede ir al archivo .env para modificar el nombre de la base de datos y el usuario que tenga en su entorno local. Luego de haber echo las modificaciones deberá ejecutar las migraciones con el comando: php artisan migrate

- Despues de esto, Es probable que deba ejecutar el comando "npm run build" para que sus archivos js y css queden listos para utilizar.

- Como se está utilizando el framework Laravel, se sugiere que se ejecute el comando "php artisan serve" con ello arrancará el servidor que monta la aplicación en Laravel.

- Con estos pasos anteriores debería quedar funcionando la app.

USO DE LA APP:

- El sistema inicia con una pagina Home que mostrará todos los tickets creados. En la parte superior a la derecha, se encuentran las opciones de Login y Register las cuales son necesarias para ingresar como tal al dashboard del usuario.

- En Register se hace el registro del Usuario, y al momento de hacerlo lo redirige al Dashboard del Usuario, donde podrá ver la lista de tickets creados por él y tambien tendrá la opción de crear un nuevo Ticket con el boton "Create ticket".

- En la lista de Tickets por usuario puede hacer filtro y paginación, el filtro funciona para estados y nombre de ticket unicamente. También cada ticket tiene un par de opciones, son "Edit" y "Delete", estas funcionan para tener un CRUD completo.

- Si el usuario quiere volver al Home de la app, no solo verá los tickets suyos si no lo que los demás han creado.

</p>
