# Entrega 3 Proyecto grupo 12/19

## Login

## Procedimiento almacenado

## Funcionalidad adicional
La funcionalidad adicional qe implementamos es una barra de búsqueda o "search box". En esta, se pueden buscar de manera más directa artistas, obras, lugares, hoteles y viajes. El funcionamiento de esta se basa en hacer consultas del estilo "LIKE ('%%')", de tal forma de que se entreguen resultados que coincidan en al menos la palabra que se está buscando. Los resultados se entregan en forma de pestañas (una para cada categoría), facilitando la visualización de estos. Además, se añade un botón en cada resultado para poder acceder a más detalles: ya sea detalles de una obra, artista, o si el usuario se encuentra loggeado poder acceder a reservar hoteles o tickets de viajes, por ejemplo. 
Otro detalle a considerar es que en la pestaña de viajes, por ejemplo si yo busco "paris", me entrega resultados de vuelos existentes con "paris" como origen o como destino, y sin especificar horarios. Una vez que elija uno de los viajes, me lleva a la página correspondiente con todos los horarios disponibles para ese viaje y la posibilidad de comprar tickets si estoy loggeado, de lo contrario el botón no se muestra. 

## Bonus de navegación
Se agregó un "navbar" para facilitar la navegación a lo largo de la página. En este, se puede volver a la página de inicio mediante el botón Home, ir directamente a la lista de artistas (Artistas), ir directamente a la lista de obras (Obras), a la lista de origenes para viajes (Viajes), lista de lugares (Lugares), y lista de hoteles (Hoteles). Se agregaron también los botones de Login y Register en caso de que el usuario no esté loggeado; en caso de que lo esté, se muestran los botones de Mi perfil y Cerrar Sesión. Dentro de Mi Perfil, se agrega la opción de Eliminar Cuenta, para que esta acción sea específica para el usuario y no se corra peligro de borrar la cuenta por error.
Además, al final de cada página se agrega el botón de Menú principal para volver con facilidad a este, y si por ejemplo entro a ver más detalles de un artista, se agrega el botón de "Volver al listado de artistas" para vovler a revisarlos de manera más directa sin tener que pasar por Home primero. Esto último se replica para otras categorías.

## Bonus de imágenes


## Otras acotaciones