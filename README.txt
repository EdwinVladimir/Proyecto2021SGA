GESTACADEMIC

PASOS PARA INSTALAR EL SISTEMA EN SU AMBIENTE DE TRABAJO LOCAL

REQUISITOS:

1.- Descargar Node JS : https://nodejs.org/es/download/
2.- Descargar Composer para Windows : https://getcomposer.org/download/
3.*- Descargar XAMPP para Windows : https://www.apachefriends.org/download.html

Luego debe instalarlos, se deben hacer los siguientes pasos:

1.- Abrir la consola de Windows (cmd) o PowerShell, e irse a la carpeta donde colocara su proyecto.
     Preferibemente dentro de la carpeta c:\xampp\htdocs (solo recomendación).

2.- Descargar el repositorio : git clone https://github.com/CaapIvanMurillo/gestacademic.git
    NOTA: Es importante destacar que si el repositorio es privado, debe propocionar el token, 
    aparte se ebe revisar las credencias en Windows si existen y eliminarla, para evitar errores.

3.- Entrar a la carpeta gestacademic del proyecto y abrir Visual Studio Code en Consola: "code ."

4.- Abrir el terminal en Visual Studio Code e instalar laravel: "composer global require laravel/installer"

5.- Despues instalar el Gestor de Paquete de Node JS "nom install"

6.- Finalmente instalar materilize Vuetify lo suguiente: "npm install vuetify" y "npm install sass sass-loader deepmerge -D"

7.- Se debe abrir XAMPP y iniciar el servicio de MYSQL y crear la base de datos "gestacademic", esto se hace en el navegador web.

8.- Crear las migraciones (BASE E DATOS) con : "php artisan migrate:fresh –-seed"

9.- Ejecutar en ese terminal el servidor de laravel "laravel artisan serve"

10.- Abrir otra terminal y ejecutar el compilador de node "node run watch"//www.apachefriends.org/download.html


LISTO PARA USAR.

