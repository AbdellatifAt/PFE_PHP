<?php

header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';


if( isset($_POST['nom_module']) &&  isset($_POST['id_semester'])  && isset($_POST['id_enseignant']) ){

    $nom_module = htmlspecialchars($_POST['nom_module']); 
    $id_semester = htmlspecialchars($_POST['id_semester']); 
    $id_enseignant = htmlspecialchars($_POST['id_enseignant']); 

    $sql =  "INSERT into module(nom_module , id_semester , cin) Values ('$nom_module', $id_semester, '$id_enseignant' )  ";

    $res = $pdo->query($sql);
    if($res){
        $query = "SELECT S.id_semester , E.cin, M.nom_module , M.id_module , E.nom nom_ens , E.prenom , E.email , S.nom nom_semester
        from module M left join enseignant E ON M.cin = E.cin join semester S on M.id_semester = S.id_semester 
         ORDER BY id_module DESC  LIMIT 1 " ; 

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
        echo json_encode($sql );

    }


}









?>