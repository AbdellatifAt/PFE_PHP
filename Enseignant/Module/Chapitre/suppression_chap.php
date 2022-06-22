<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../../connexion.php';
if(isset($_GET['id_chap'])){

    $id_chap = htmlspecialchars($_GET['id_chap']);

    $sql = "DELETE from Chapitre where id_chap= $id_chap";
    $res= $pdo->query($sql);

    if($res){
        
        http_response_code(200);
        echo json_encode($res);
    }
    else{
        http_response_code(400);
        echo json_encode('impossible de supprimer le chapitre');
    }

}

?>