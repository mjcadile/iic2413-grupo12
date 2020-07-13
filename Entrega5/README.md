
## Detalles generales

La aplicación se encuentra dentro de nuestra aplicación desarrollada en la E3. 
Se puede acceder a ella tras iniciar sesión. Aparecerá en la parte derecha del Header
la opción de "Messenger". Al apretar esto se abrirá un dropdown con las 5 funcionalidades pedidas.

Para acceder se puede usar los datos de cualquier usuario de la base de datos y la contraseña es el mismo nombre de usuario más 123. Por ejemplo:
Usuario: JessicaGraham
Contraseña: JessicaGraham123

## 1. Atributos de mensajes recibidos
El archivo correspondiente se encuentra en la carpeta users, "msj_recibidos.php". Se consulta por todos los mensajes de la api y se filtran aquellos donde el id de "receptant" coincide con el de usuario actualmente loggeado. En caso de que no existan mensajes recibidos, se despliega un aviso indicándolo.

## 2. Atributos de mensajes enviados
El archivo correspondiente se encuentra en la carpeta users, "msj_enviados.php". Se consulta por todos los mensajes de la api y se filtran aquellos donde el id de "sender" coincide con el de usuario actualmente loggeado. En caso de que no existan mensajes enviados, se despliega un aviso indicándolo.

## 3. Enviar mensajes

Para enviar mensajes simplemente hay que indicar el texto de este y a quien va dirigido. Los atributos se calculan internamente. Respecto a la ubicación, se dan valores por defecto sin calcularlos (lo cual es validado en las issues). Tras enviar el mensaje se envía un post a la api y luego aparece una pantalla de éxito. Si se va luego a los mensajes enviados veremos el recién creado sin problemas. 


## 4. Buscar mensajes

Para buscar mensajes hay que ingresar en cada espacio el filtro correspondiente. Para separar las frases se ocupa un punto (.) y para separar las palabras se ocupan espacios ( ). De todas maneras, está especificado en la misma página.


## 5. Visualización mapa
Para ver la ubicación del usuario mediante la ubicación de sus mensajes emitidos, se debe ingresar en el navbar al dropdown 'messenger' y seleccionar 'Mapa', en el cual se debe ingresar la fecha de inicio y la de fin entre los cuales se quiere ver la ubicacion. En caso de que la fecha de fin este antes que la de inicio, la pagina solo se recargara, volviendo a mostrar el formulario y en el caso de no haber mensajes entre las fechas, se visualizara el mapa, pero abajo saldrá un mensaje que no se envio mensaje entre las fechas seleccionadas, en caso contrario en el mapa habrá un marcador que indique el lugar en el que estuvo el usuario. 


