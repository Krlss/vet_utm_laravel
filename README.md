# **_Sistema de control para usuarios, mascotas y reportes de la Veterinaria de la Universidad técnica de Manabí_**

## **Instalación en entorno de desarrollo**

Para este paso se necesita instalar PHP, composer, nodejs
Para proceder a la ejecución del proyecto se necesita seguir los siguientes pasos:

1. Ejecutar los comandos `composer install && npm install`
2. Crear el archivo `.env` en la raíz del proyecto
   `APP_NAME='Sistema de Gestión SINVET'`
   `APP_ENV=local`
   `APP_KEY=base64:VOTucStHAJKoMrRQMrvE5iAo5j38iIFCmKsXJVhgz4g=`
   `APP_DEBUG=true`
   `APP_URL=http://localhost`

    `LOG_CHANNEL=stack`
    `LOG_DEPRECATIONS_CHANNEL=null`
    `LOG_LEVEL=debug`

    `DB_CONNECTION=<La base de datos que utilizarás>`
    `DB_HOST=<Host de la base de datos>`
    `DB_PORT=<Puerto que utiliza tu base de datos>`
    `DB_DATABASE=<Base de datos>`
    `DB_USERNAME=<Usuario de la base de datos>`
    `DB_PASSWORD=<Contraseña de acceso del usuario>`

    `BROADCAST_DRIVER=log`
    `CACHE_DRIVER=file`
    `FILESYSTEM_DRIVER=local`
    `QUEUE_CONNECTION=sync`
    `SESSION_DRIVER=database`
    `SESSION_LIFETIME=120`

    `MEMCACHED_HOST=127.0.0.1`

    `REDIS_HOST=127.0.0.1`
    `REDIS_PASSWORD=null`
    `REDIS_PORT=6379`

    `MAIL_MAILER=smtp`
    `MAIL_HOST=smtp.googlemail.com`
    `MAIL_PORT=465`
    `MAIL_USERNAME=<Tu correo>`
    `MAIL_PASSWORD=<Tu contraseña>`
    `MAIL_ENCRYPTION=ssl`
    `MAIL_FROM_ADDRESS=<Tu correo>`
    `MAIL_FROM_NAME="${APP_NAME}"`

    `AWS_ACCESS_KEY_ID=`
    `AWS_SECRET_ACCESS_KEY=`
    `AWS_DEFAULT_REGION=us-east-1`
    `AWS_BUCKET=`
    `AWS_USE_PATH_STYLE_ENDPOINT=false`

    `PUSHER_APP_ID=`
    `PUSHER_APP_KEY=`
    `PUSHER_APP_SECRET=`
    `PUSHER_APP_CLUSTER=mt1`

    `MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"`
    `MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}" `

    `GOOGLE_TYPE_ACCOUNT=service_account`
    `GOOGLE_SCOPES="https://www.googleapis.com/auth/drive"`
    `GOOGLE_PRIVATE_KEY=`
    `GOOGLE_CLIENT_EMAIL=`
    `GOOGLE_CLIENT_ID=`
    `GOOGLE_DRIVE_FOLDER_ID=`

3. Crear la base de datos, el nombre de la base de datos tiene que ser el mismo que se coló en el .env
4. Ejecutar los comandos `php artisan migrate && php artisan db:seed`
5. Para ejecutar el proyecto ejecutar `php artisan serv`

# Para enviar correos electrónicos hacer la siguiente configuración

-   Ir a tu cuenta de google y crear una contraseña de aplicación
    ![Imagen de contraseña de aplicación](https://github.com/Krlss/vet_utm_laravel/tree/master/storage/paso_1_email.png)
-   Copiar la contraseña y ponerla en tu `.env`
    ![Imagen de la contraseña generada](https://github.com/Krlss/vet_utm_laravel/tree/master/storage/pass_email.png)

# Para utilizar tu google drive para el almacenamiento de imagenes

-   Ir a la consola de google [console google](https://console.cloud.google.com/).
    Como no tendrás una proyecto creado, ir a la parte superior y darle clic en seleccionar proyecto, se te abrirá un modal donde podrás darle a "Proyecto nuevo". Aquí solo le pondrás el nombre del nombre.
-   Una vez creado el proyecto en el buscador de la consola de google busca "Google Drive API" y dale "Habilitar"
-   Una vez habilitado Google Drive API se deberá crear unas crendenciales para el uso de la api
-   En el buscador de la consola de google busca "Apis & services". Una ves dentro iras a credenciales y le darás "Crear credenciales" y cuenta de servicio
    ![Cuenta de servicio de google](https://github.com/Krlss/vet_utm_laravel/tree/master/storage/cuenta_de_servicio_credenciales.png)
-   Dentro del formulario pondrás un nombre del servicio y ya.
-   Una ves creado la cuenta de servicio en la parte inferior le darás clic a tu cuenta
    ![Clic en la cuenta de servicio](https://github.com/Krlss/vet_utm_laravel/tree/master/storage/clic_cuenta_de_servicios.png)
-   Cuando le hayas dado clic a tu cuenta le darás clic a "KEYS" -> "ADD KEY" -> "Create new key" -> JSON
-   Se te descargará un archivo `.json` donde copiarás y pegarás cierta información en tu `.env` que son las siguientes:
    `private_key, client_email, client_id`
-   Cabe recalcar que la private_key en el `.env` va entre comillas.
-   Ahora deberás crear una carpeta en tu google drive, esta carpeta será compartida con el correo que te salió cuando creaste las credenciales y le darás permiso de editar.
    ![Clic en la cuenta de servicio](https://github.com/Krlss/vet_utm_laravel/tree/master/storage/clic_cuenta_de_servicios.png)

### Manejos de usuarios:

-   Ver lista de usuarios
-   Crear usuario
-   Editar usuario
-   Eliminar usuario

### Manejos de mascotas:

-   Ver lista de mascotas
-   Crear mascota
-   Editar mascota
-   Eliminar mascota

### Auditoria:

-   Ver lista de auditoria

### Manejos de especies:

-   Ver lista de especies
-   Crear especie
-   Editar especie
-   Eliminar especie

### Manejos de pelajes:

-   Ver lista de pelajes
-   Crear pelaje
-   Editar pelaje
-   Eliminar pelaje

### Manejos de razas:

-   Ver lista de razas
-   Crear raza
-   Editar raza
-   Eliminar raza

### Manejos de regiones

-   Ver lista de provincias/cantones/parroquias
-   Crear provincias/cantones/parroquias
-   Editar provincias/cantones/parroquias
-   Eliminar provincias/cantones/parroquias

### Manejos de roles y permisos

-   Ver lista de roles y permisos
-   Crear rol/permiso
-   Editar rol/permiso
-   Eliminar rol/permiso
