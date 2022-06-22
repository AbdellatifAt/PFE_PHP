<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

$sql =  "SELECT cin , nom , prenom from enseignant ";

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