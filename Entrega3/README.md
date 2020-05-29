# Entrega 3 Proyecto grupo 12/19

## Usuarios y acceso
### Registrarse
Para poder registrarse en la aplicación se debe llenar el formulario, el cual no permite ingresar un username que ya fue creado y además si las contraseñas ingresadas en la confirmación de contraseña son distintas tampoco se podrá registrar. Una vez completado el formulario de registro el usuario quedará como que inició sesión automáticamente.

### Eliminar cuenta
Para poder eliminar la cuenta, se debe ir a "Mi perfil", botón que se encuentra en el "narvar" al momento de haber iniciado sesión. En el narvar de ventana "Mi perfil" (arriba a la derecha), podrá encontrar el botón de eliminar cuenta, el cual elimina la cuenta automáticamente. Luego de eso, la persona que eliminó su cuenta no podrá iniciar sesión, y ese username estará nuevamente disponible para poder registrarse con él.

### Información personal
En la información personal se puede encontrar 

### Login 
Para poder iniciar sesión con lo usuarios creados por el curso, se debe ingresar el username además la contraseña, la cual para cada usuario preexistente es su username + "123". Por ejemplo, para el usuario con username 'JessicaGraham' su contraseña es 'JessicaGraham123'. Para los nuevos usuarios que se registraron mediente la app, para iniciar sesión, deben ingresar su username y la contraseña puesta al momento de registrarse.

## Procedimiento almacenado


## Funcionalidad adicional
La funcionalidad adicional que implementamos es una barra de búsqueda o "search box". En esta, se pueden buscar de manera más directa artistas, obras, lugares, hoteles y viajes. El funcionamiento de esta se basa en hacer consultas del estilo "LIKE ('%%')", de tal forma de que se entreguen resultados que coincidan en al menos la palabra que se está buscando. Los resultados se entregan en forma de pestañas (una para cada categoría), facilitando la visualización de estos. Además, se añade un botón en cada resultado para poder acceder a más detalles; ya sea detalles de una obra, artista, o si el usuario se encuentra loggeado poder acceder a reservar hoteles o tickets de viajes, por ejemplo. 
Otro detalle a considerar es que en la pestaña de viajes. Por ejemplo, si yo busco "paris", me entrega resultados de vuelos existentes con "paris" como origen o como destino, y sin especificar horarios. Una vez que elija uno de los viajes, me lleva a la página correspondiente con todos los horarios disponibles para ese viaje y la posibilidad de comprar tickets si estoy loggeado, de lo contrario el botón no se muestra.

## Bonus de navegación
Se agregó un "navbar" para facilitar la navegación a lo largo de la página. En este, se puede volver a la página de inicio mediante el botón Home, ir directamente a la lista de artistas (Artistas), ir directamente a la lista de obras (Obras), a la lista de orígenes para viajes (Viajes), lista de lugares (Lugares), y lista de hoteles (Hoteles). Se agregaron también los botones de Login y Register en caso que el usuario no esté loggeado; en caso que lo esté, se muestran los botones de "Mi perfil" y "Cerrar Sesión". Dentro de "Mi Perfil", se agrega la opción de "Eliminar Cuenta", para que esta acción sea específica para el usuario y no se corra peligro de borrar la cuenta por error.
Además, al final de cada página se agrega el botón de "Menú principal" para volver con facilidad a este, y si por ejemplo entro a ver más detalles de un artista, se agrega el botón de "Volver al listado de artistas" para vovler a revisarlos de manera más directa sin tener que pasar por Home primero. Esto último se replica para otras categorías.

## Bonus de imágenes


## Otras acotaciones