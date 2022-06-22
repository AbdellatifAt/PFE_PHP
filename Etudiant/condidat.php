<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_GET['cne']) ){
    $cne = $_GET['cne'];


    
        $sql ="SELECT DISTINCT C.id_comp ,C.nom_comp ,O.date_comp ,CON.etat ,con.valide_comp  ,
        O.date_exp , CON.note_comp FROM condidateur CON Natural Join competition C NATURAL Join
         inscription I NATURAL join organise_competition O WHERE cne ='$cne' ";
        $stm = $pdo->query($sql); 
        if($stm->rowCount()>0){
            $res= $stm->fetchAll(PDO::FETCH_ASSOC) ; 

            http_response_code(200);
            echo json_encode($res);
        }
        else{
            http_response_code(400);
            echo json_encode("aucun condidatuer selectioner");
        }

    }
    else{
        http_response_code(400);
        echo json_encode("no data found ");
        
}

 
?>