<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
session_start();


    $sql =  "SELECT * from etudiant  ";

$stm = $pdo->query($sql);

$res = $stm->fetchAll(PDO::FETCH_ASSOC);

if($res){
    http_response_code(200);
    echo json_encode($res);
}
else{
    http_response_code(400);
    echo json_encode("erreur ");
}







?>