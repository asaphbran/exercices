<h1>¡Hola!</h1>
En esta documentación encontrarás una guía paso a paso sobre cómo ejecutar el ejercicio.

Hay 2 formas de ejecutar el ejercicio:

<ul>
<li>Desde la línea de comandos (Terminal).</li>
<li>Desde un navegador web.</li>
</ul>

<h3>1. Ejecutar desde la Línea de Comandos</h3>

<h5>Con PHP instalado localmente</h5>

Si tienes PHP instalado localmente en tu máquina, puedes ejecutar el proyecto de la siguiente manera:

<b>Nota: Si estás usando MAMP, WAMP o XAMPP, asegúrate de que el servidor PHP esté en ejecución. Si estás en una Mac y no tienes PHP instalado, puedes instalarlo fácilmente con Homebrew.</b>

Asegúrate de estar dentro de la carpeta del proyecto para ejecutar este comando:

<code>php exercise.php 3 10 true</code>

<h5>Con Docker (No se necesita PHP local)</h5>

Si no quieres instalar WAMP, XAMPP o MAMP, puedes usar Docker para ejecutar el proyecto en un entorno aislado.

<ol>
<li>Si no tienes Docker Desktop, descarga e instala la aplicación desde el sitio web oficial de Docker. Durante la instalación, asegúrate de habilitar la opción para usar WSL 2. Luego, ejecuta la aplicación.</li>

<li>Abre una Terminal (macOS), PowerShell (Windows) o la terminal de VS Code y navega hasta la carpeta del proyecto.</li>

<li>
Desde la terminal, ejecuta el siguiente comando para iniciar los servicios:
<code>docker compose up --build -d</code>
</li>
</ol>

Una vez que los contenedores estén en ejecución, puedes usar la terminal para correr el script:

<ul>
<li>
Para entrar al contenedor y ejecutar el script:

<code>docker compose exec php sh</code>

Una vez dentro, ejecuta el ejercicio así:

<code>php /var/www/html/exercise.php 3 10 true</code>
</li>
<li>
Para ejecutar el script directamente sin entrar al contenedor:

<code>docker compose exec php php /var/www/html/exercise.php 3 10 true</code>
</li>
</ul>

<h3>2. Ejecutar desde el Navegador Web</h3>

Para ejecutar el ejercicio en un navegador web, necesitarás un servidor local. Si no quieres instalar uno, Docker es la mejor opción.

<ol>
<li>
Si no lo has hecho ya, sigue los pasos de Docker de la sección anterior para iniciar los servicios con:
<code>docker compose up --build -d.</code>
</li>
<li>
Una vez que los contenedores estén en ejecución, puedes acceder a la aplicación desde tu navegador en la siguiente URL:

<a href="http://localhost:8080/exercise.php?start=3&rows=10&center=true">
    http://localhost:8080/exercise.php?start=3&rows=10&center=true
</a>
</li>
<br>
<b>Nota: El script usa por defecto el valor 1 como $start, 10 como $rows y true para centrar la pirámide. Si se envía false, entonces se mostrará una sola línea con todos los números. Si no envías nada, por defecto el proceso creará la pirámide porque el valor predeterminado es true. El proceso usa estos valores por defecto si no se envían otros valores.</b>
