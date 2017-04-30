<?php

require __DIR__ . '/vendor/autoload.php';

$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if( $username == 'simone.moraes77@gmail.com' && $password == '123456'){
    $id = 1;
    $first_name = "Simone";
    $last_name = "Moraes";

    $jws = new \Namshi\JOSE\SimpleJWS([
        'alg' => 'HS256'
    ]);

    $jws->setPayload([
        'id' => $id,
        'first_name' => $first_name,
        'last_name' => $last_name
    ]);

    $privateKey = '678dojd8furn3exsh8yedasbdb435w6';
    $jws->sign($privateKey);
    echo json_encode(['token' => $jws->getTokenString()]);
}else{
    $jws = \Namshi\JOSE\SimpleJWS::load($_GET['token']);
    if ($jws->verify($privateKey)){
        echo "Seu token é válido!!";
    }
}