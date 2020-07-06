<?php
session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");

$data = $_POST['search'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://lovely-glacier-09476.herokuapp.com/text-search",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{
                          'desired': ['Hola']
                         }",
  CURLOPT_HTTPHEADER => array(),
));

$response = curl_exec($curl);
$err = curl_error($curl);

$response = array($response)

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  foreach ($response as $row) {
    echo "<div class='card-body'>
            <h7 class='card-title'>$row</h7>
          </div>";
  }
}


?>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>