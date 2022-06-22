<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';


if( isset($_POST['nom']) ){

    $nom = htmlspecialchars($_POST['nom']); 

    $sql =  "INSERT into semester(nom) values ('$nom')  ";

    $res = $pdo->query($sql);
    if($res){
        $query = "select * from semester ORDER BY id_semester DESC  LIMIT 1 " ; 
        $stm= $pdo->query($query) ;
        $resultat = $stm->fetch(PDO::FETCH_ASSOC);

        if($resultat){
            http_response_code(200);
            echo json_encode($resultat);
        }
        else{
            http_response_code(400);
            echo json_encode("erreur ");
        }
            
    }else{
        http_response_code(400);
        echo json_encode('erreur de ajouter semester');

    }


}









?>