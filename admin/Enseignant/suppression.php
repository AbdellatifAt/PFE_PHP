<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin'])){

    $cin = htmlspecialchars($_GET['cin'] );

    $sql = "DELETE from enseignant where cin= '$cin'";
    $res= $pdo->query($sql);

    if($res){
        http_response_code(200);
        echo json_encode($cin);
    }
    else{
        http_response_code(400);
        echo json_encode('impossible de supprimer enseignant');
    }

}

?>