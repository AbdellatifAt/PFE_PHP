<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';


if(isset($_GET['cne'])){

    $cne = htmlspecialchars($_GET['cne']);

    $sql = "DELETE from etudiant where cne= '$cne'";
    $res= $pdo->query($sql);

    if($res){
        http_response_code(200);
        echo json_encode($cne);
    }
    else{
        http_response_code(400);
        echo json_encode('impossible de supprimer');
    }

}
else{
    http_response_code(400);
    echo json_encode($_GET['cne']);

}

?>