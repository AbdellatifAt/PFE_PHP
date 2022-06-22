<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin']) ){
    $cin=  $_GET['cin'];

            $sql = "SELECT CO.etat, E.cne ,E.nom ,E.prenom ,E.image , E.email ,C.id_comp ,C.nom_comp , I.score 
            from organise_competition NATURAL Join competition C Natural join condidateur CO NATURAL Join
             inscription I NATURAL join etudiant E where cin ='$cin' and etat != '-1' " ; 
            $stm = $pdo->query($sql);
            if($stm->rowCount()>0){
                $res = $stm->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
                echo json_encode($res);
            }
            else{
                http_response_code(400);
                echo json_encode(false);
            }

 }else {
    http_response_code(400);
    echo json_encode('erreur');
 }
?>