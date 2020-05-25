<?php
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data.php'); 
    # Se crea la instancia de PDO
    $db_12 = new PDO("pgsql:dbname=$databaseName12;host=localhost;port=5432;user=$user12;password=$password12");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data.php'); 
    # Se crea la instancia de PDO
    $db_19 = new PDO("pgsql:dbname=$databaseName19;host=localhost;port=5432;user=$user19;password=$password19");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>
