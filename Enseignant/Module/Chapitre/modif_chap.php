<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../../connexion.php';

if( isset($_POST['nom_chap']) && isset($_POST['id_chap']) && isset($_POST['id_module']) ){

    $nom = htmlspecialchars($_POST['nom_chap']); 
    $id_chap=htmlspecialchars($_POST['id_chap']);
    $id_module=htmlspecialchars($_POST['id_module']);

    $sql =  "UPDATE Chapitre SET nom_chap = '$nom' where id_chap = $id_chap";
    $res = $pdo->query($sql);

    if($res){
        $arr = array(
            'nom_chap'=> $nom ,
            'id_chap'=>$id_chap,
            'id_module'=>$id_module
        );
            http_response_code(200);
            echo json_encode($arr);
    }
    else{
            http_response_code(400);
            echo json_encode($sql);
    }
            
    


}




?>