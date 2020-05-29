# Entrega 3 Proyecto grupo 12/19

## Usuarios y acceso
#### Registrarse
Para poder registrarse en la aplicación se debe llenar el formulario, el cual no permite ingresar un username que ya fue creado y además si las contraseñas ingresadas en la confirmación de contraseña son distintas tampoco se podrá registrar. Una vez completado el formulario de registro el usuario quedará como que inició sesión automáticamente.

#### Eliminar cuenta
Para poder eliminar la cuenta, se debe ir a "Mi perfil", botón que se encuentra en el "narvar" al momento de haber iniciado sesión. En el narvar de ventana "Mi perfil" (arriba a la derecha), podrá encontrar el botón de eliminar cuenta, el cual elimina la cuenta automáticamente. Luego de eso, la persona que eliminó su cuenta no podrá iniciar sesión.

#### Información personal
Para poder ver la informacion personal, se debe ir a "Mi perfil", botón que se encuentra en el "narvar" al momento de haber iniciado sesión. En la información personal se encuentran las entradas a los museos, tambien se encuentran las reservas en hoteles y los tickets de viajes comprados por el usuario. 

#### Login 
Para poder iniciar sesión con lo usuarios creados por el curso, se debe ingresar el username además la contraseña, la cual para cada usuario preexistente es su username + "123". Por ejemplo, para el usuario con username 'JessicaGraham' su contraseña es 'JessicaGraham123'. Para los nuevos usuarios que se registraron mediente la app, para iniciar sesión, deben ingresar su username y la contraseña puesta al momento de registrarse.

## Navegación

#### Consulta por artistas

#### Página de la obra

#### Página de un lugar

#### Compra de tickets de transporte
Para comprar un ticket, un usuario en primer lugar debe escoger la ciudad de origen, al escogerla podrá ir a seleccionar la ciudad de destino, luego de esto se entregará un formulario con las horas disponibles de viaje, cualquier persona puede elegir la fecha de viaje, además se muestra el precio del ticket, pero sólo los usuarios que iniciaron sesion pueden comprar el ticket y luego de comprarlo podran verlo en su perfil.

#### Reservar hoteles
Al reservar un hotel, cualquier persona puede ver la lista de hoteles disponibles, tambien podra ir al formulario de reservas, solo que una persona que no ha iniciado sesion, no podra reservar. Para ver sus reservas, un usuario debe ir a su perfil. En el formulario no se pueden escoger fechas que ya pasaron y en el caso de que la fecha de salida sea antes que la fecha de entrada, el usuario no podrá comprar el ticket. 

## Procedimiento almacenado
El procedimiento almacenado está en el archivo ```itinerario.sql```.
La idea es buscar todos los destinos posibles desde una ciudad de origen. Luego, se filtran los resultados según las ciudades que tienen obras de los artistas seleccionados. Después, se insertan los datos de los destinos en la tabla Itinerario_final, que es la que se ocupa para mostrar todo en la página web.
Implementamos una función adicional en esta parte que es la opción de elegir un intervalo de espera máximo entre viajes para un mismo itinerario. Eligiendo 24 horas, sería la espera de 1 día, por lo que así aparecen todas las opciones de itinerario. También, ocupamos las funciones CURRENT_DATE y CURRENT_TIME para recibir la fecha actual y tiempo actual. De esta forma, se verifica que si la fecha elegida es la fecha actual, entonces no aparece en los itinerarios los viajes del mismo día a una hora que ya pasaron (estos viajes aparecen, pero a partir del día siguiente). Y, para viajes que son después de la hora actual aparecen para la misma fecha.

## Funcionalidad adicional
La funcionalidad adicional que implementamos es una barra de búsqueda o "search box". En esta, se pueden buscar de manera más directa artistas, obras, lugares, hoteles y viajes. El funcionamiento de esta se basa en hacer consultas del estilo "LIKE ('%%')", de tal forma de que se entreguen resultados que coincidan en al menos la palabra que se está buscando. Los resultados se entregan en forma de pestañas (una para cada categoría), facilitando la visualización de estos. Además, se añade un botón en cada resultado para poder acceder a más detalles; ya sea detalles de una obra, artista, o si el usuario se encuentra loggeado poder acceder a reservar hoteles o tickets de viajes, por ejemplo. 
Otro detalle a considerar es que en la pestaña de viajes. Por ejemplo, si yo busco "paris", me entrega resultados de vuelos existentes con "paris" como origen o como destino, y sin especificar horarios. Una vez que elija uno de los viajes, me lleva a la página correspondiente con todos los horarios disponibles para ese viaje y la posibilidad de comprar tickets si estoy loggeado, de lo contrario el botón no se muestra.

## Bonus de navegación
Se agregó un "navbar" para facilitar la navegación a lo largo de la página. En este, se puede volver a la página de inicio mediante el botón Home, ir directamente a la lista de artistas (Artistas), ir directamente a la lista de obras (Obras), a la lista de orígenes para viajes (Viajes), lista de lugares (Lugares), y lista de hoteles (Hoteles). Se agregaron también los botones de Login y Register en caso que el usuario no esté loggeado; en caso que lo esté, se muestran los botones de "Mi perfil" y "Cerrar Sesión". Dentro de "Mi Perfil", se agrega la opción de "Eliminar Cuenta", para que esta acción sea específica para el usuario y no se corra peligro de borrar la cuenta por error.
Además, al final de cada página se agrega el botón de "Menú principal" para volver con facilidad a este, y si por ejemplo entro a ver más detalles de un artista, se agrega el botón de "Volver al listado de artistas" para vovler a revisarlos de manera más directa sin tener que pasar por Home primero. Esto último se replica para otras categorías.

## Bonus de imágenes


## Otras acotaciones