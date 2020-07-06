<?php
session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");

$data = $_POST['search'];


$client = new Client();


    $response = $client->request('POST', 'https://lovely-glacier-09476.herokuapp.com/messages', [
            'form_params' => [
                'format' => json_encode($data),
            ],
        ]);
    $response_data = json_decode($response->getBody()->getContents());
    dd($response_data);


?>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>