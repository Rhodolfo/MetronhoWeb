<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>Seguridad Básica</title>
</head>



<body>

<h1>Notas sobre Seguridad y Contraseñas</h1>

<h2>Contraseñas y Funciones de Hash</h2>

<p>Normalmente al permitir que un usuario tenga
variables de sesión a un sitio, se comparan el
nombre y la contraseña provistos por el usuario
contra registros existentes en una base de datos</p>

<p>Es peligroso guardad contraseñas en forma de texto plano (sin cifrar)
dentro de una base de datos por varias razones:</p>
<ul>
<li>Si la base de datos es robada o de alguna manera comprometida,
las contraseñas de los usuarios quedan a merced de un atacante.</li>
<li>Alguna persona autorizada a acceder la base de datos puede tener
intenciones menos benignas con los datos a los que tiene acceso.</li> 
<li>Al no tener la contraseña guardada en texto plano, no es posible
transmitir la contaseña por canales inseguros, a menos de que el mismo usuario lo haga.
En este sentido, uno se protege de la ignorancia sobre seguridad de alguna persona
que tenga acceso a la base de datos.</li>
</ul>

<p>Aquí sería apropiado explicar a que me refiero con texto plano y texto cifrado.
Digamos que Alice tiene un mensaje que quiere mandar a Bob, y digamos que ese mensaje
es sencillamente "perro4". 
Digamos también Alice no quiere que un tercero sepa el contenido del mensaje,
pero que también sabe que Mallory tiene acceso al buzón de Bob. 
En este caso de dice que el canal de comunicación no es seguro (insecure)
y que Mallory podría efectuar un ataque de hombre de en medio (man in the middle attack).</p>
<p>Para protegerse, Alice puede mandar otro mensaje, el cuál sería
"qfss5" (simplemente un desplazamiento de letra o número según sea el caso). 
Alice le dice a Bob en secreto cúal es la regla para recuperar el mensaje de antemano.
A esto se le llama secreto compartido (shared secret), y puede ser compartido en un canal seguro o inseguro con otras precauciones adicionales, por ahora supondré que Alice y Bob ya comparten este secreto.
Al menjase sin modificar se la llama texto plano 
(plain text, aunque yo lo traduciría mas como texto sencillo), 
y al mensaje modificado como texto cifrado (cyphered text).</p>
<p>De esta manera, Alice puede mandar a Bob cuantos mensajes quiera 
siempre y cuando Mallory no sepa la regla de cifrado del mensaje original.</p>
<p>Alguien se podría dar cuenta que este esquema cuenta con una falla grande,
si Mallory cuenta con la regla de cifrado ella puede leer los mensajes sin obstrucción alguna.
En el caso de las contraseñas, la estrategia en este caso es usar una función de hash.</p>
<p>Una función de hash opera sobre el mensaje original y lo modifica de alguna manera
que sea prácticamente irreversible, así que el mensaje se pierde.
Sin embargo, en el caso de las contraseñas, no nos interesa la contraseña en sí,
si no que la contraseña proporcionada se igual a la contraseña en la base datos, 
así que basta comparar solamente los mensajes cifrados y ver que sean iguales.</p>
<p>Para que dicha una función de hash f sea considerada segura, debe cumplir con tres criterios:</p>
<ol>
<li>Resistencia de Preimagen: En la práctica, debe ser imposible recuperar el mensaje original con la tecnología actual.
Es decir, dado un Hash h debe ser difícil encontrar m tal que f(m) = h.</li>
<li>Segunda Resistencia de Preimagen: Dado un mensaje m_1, debe ser prácticamente imposible encontrar un mensaje m_2 tal que f(m_1) = f(m_2).</li>
<li>Resistencia a Colisiones: 
Debe ser prácticamente imposible encontrar dos mensajes tales que f(m_1) = f(m_2).</li>
<li>Dados dos mensajes similares m_1 y m_2, 
los resultados f(m_1) y f(m_2) no pueden ser similares.</li>
</ol>
<p>Nótese que no se pide que la función de hash sea uno a uno, se vale que dos mensajes distintos 
tengan el mismo hash.
Las funciones que violan el criterio 1 son vulnerables 
a que simplemente se encuentre una manera de invertir la función,
a esto se le llama ataque de preimagen. 
Ya que basta con encontrar una contraseña alternativa 
que tenga el mismo hash que la contraseña del usuario
para poder entrar al sistema con sus datos, las funciones que violan
el criterio 2 no son seguras, son vulnerables a segundos ataques de preimagen.
El criterio 3 protege al sistema de ataques del Día de Cumpleaños (birthday attacks). 
El último criterio asegura que sea difícil analizar el comportamiento de la función
de hasheado para invertirla.
</p>
<p>Incluso con estas protecciones, una función de hasheado f dada puede ser vulnerable 
a ataques con tablas precalculadas para f. Con el fin the protegerse de estos ataques,
se utilizan funciones de hash multivariables que no sólo dependen de un mensaje m,
se les añade una variable adicional s (la sal) para que sea poco probable que un atacante
cuente con tables de valores precalculados para f(m,s). 
Adicionalmente, las sal es generada aleatoriamente y se concatena al valor de
la contraseña hasheada, por ejemplo "&lt;sal&gt;&lt;hash&gt;".
</p>
<p>En PHP, existen funciones para hashear contraseñas y comparar valores 
hasheados de ellas: 
</p>
<ul>
<li><a href="http://php.net/manual/en/function.password-hash.php">password_hash()</a></li>
<li><a href="http://php.net/manual/en/function.password-verify.php">password_verify()</a></li>
<li><a href="https://en.wikipedia.org/wiki/Hash_function">Wikipedia</a></li>
</ul>
<h3>LAS CONTRASEÑAS SIEMPRE DEBEN DE SER HASHEADAS ANTES 
DE GUARDARSE EN UNA BASE DE DATOS</h3>



<h1>El Internet no es un Canal Seguro: HTTPS con TLS/SSL</h1>

<p>Ya dije que las contraseñas deben estar hasheadas
cuando se guardan en una base datos,
pero no he dicho nada de como se deben mandar y recibir los datos en primer lugar.
</p>
<p>Cuando un usuario manda información a un servidor por medio de un POST,
este mensaje pasa por varias máquinas antes de llegar a su destino,
puede ser interceptado y leído en el camino.
</p>
<p>En este caso una función de hash no es apropiada, ya que queremos
que el mensaje mandado se pueda leer por el servidor, una función
de cifrado reversible es lo que queremos. 
En este caso un esquema de seguridad como TLS es apropiado, 
pero esto es un tema más gordo y me voy a evitar la escritura.
<a href="http://www.pierobon.org/ssl/ch2/detail.htm">Aquí</a>
hay una descripción muy buena de SSL.
Cuando de usa HTTP con encriptación TLS o SSL se dice 
se esta usando HTTPS (HTTP over TLS, HTTP over SSL).
</p>
<p>El servidor web con el que un cliente se comunique
debe estar configurado para usar HTTPS,
en Apache 2 existen varios recursos:</p>
<ul>
<li>https://httpd.apache.org/docs/2.4/ssl/ssl_howto.html
</li>
<li>https://www.digitalocean.com/community/tutorials/how-to-create-a-ssl-certificate-on-apache-for-ubuntu-14-04
</li>
</ul>
<h3>NUNCA MANDES DATOS SENSIBLES POR UN CANAL NO ENCRIPTADO</h3>

</body>


</html>
