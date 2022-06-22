<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_POST['cne']) && $_POST['id_comp'] ){
    $cne = $_POST['cne'];
    $id_comp = $_POST['id_comp'];

    $sql ="INSERT INTO condidateur VALUES($id_comp , '$cne' , '0','0',-1)";
    $res = $pdo->query($sql);

    if($res){
        $sql ="SELECT DISTINCT C.id_comp , C.nom_comp ,O.date_comp , O.date_exp ,O.date_comp ,I.cne ,Con.etat  FROM condidateur CON Natural Join competition C NATURAL Join
        inscription I NATURAL join organise_competition O Where cne= '$cne' and id_comp = $id_comp  ORDER BY id_comp 
         DESC limit 1 ";
        $stm = $pdo->query($sql); 
        if($stm->rowCount()>0){
            $res= $stm->fetch(PDO::FETCH_ASSOC) ; 

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
        echo json_encode("error d'insertion ");
        
    }
}
else{
    http_response_code(400);
    echo json_encode("no data found");
}
 
?>