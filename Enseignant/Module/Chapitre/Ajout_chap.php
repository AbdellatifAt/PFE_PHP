<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../../connexion.php';


if( isset($_POST['nom_chap']) and isset($_POST['id_module'])){

    $nom = htmlspecialchars($_POST['nom_chap']); 
    $module = htmlspecialchars($_POST['id_module']);

    $sql =  "INSERT into Chapitre(nom_chap,id_module) values ('$nom ',$module)  ";

    $res = $pdo->query($sql);
    if($res){
        $query = "select * from Chapitre ORDER BY id_chap DESC  LIMIT 1 " ; 
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
        echo json_encode("erreur d' ajouter le chapitre");

    }


}









?>