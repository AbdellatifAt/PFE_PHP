<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../../connexion.php";



if( $_GET['cin']){
    $cin =  $_GET['cin'];
    $sql = "SELECT * FROM module where cin = '$cin'";
    $stm = $pdo->query($sql);
    $res = $stm->fetchAll(PDO::FETCH_ASSOC);
    if($res){
        http_response_code(200);
        echo json_encode($res);

    }
    else{
        http_response_code(400);
        echo json_encode("no data found");
    }
}
else{
    http_response_code(400);
    echo json_encode("erreur");
}

?>