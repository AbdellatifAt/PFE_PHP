<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if( isset($_POST['nom']) && isset($_POST['id_semester'])){

    $nom = htmlspecialchars($_POST['nom']); 
    $id_semester=htmlspecialchars($_POST['id_semester']);

    $sql =  "UPDATE semester SET nom = '$nom' where id_semester = $id_semester";
    $res = $pdo->query($sql);

    if($res){
        $arr = array(
            'nom'=> $nom ,
            'id_semester'=>$id_semester
        );
            http_response_code(200);
            echo json_encode($arr);
    }
    else{
            http_response_code(400);
            echo json_encode("erreur de modification du module");
    }
            
    


}




?>