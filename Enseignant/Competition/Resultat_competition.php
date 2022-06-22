<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';


if(isset($_GET['id_comp'])){
    $id_comp=  $_GET['id_comp'];
    $sql ="select DISTINCT (cne ) , E.nom ,E.prenom , CON.note_comp from Reponse_problem NATURAL JOIN 
    problem P NATURAL JOIN etudiant E NATURAL JOIN condidateur CON WHERE P.id_comp =$id_comp";
    $stm = $pdo->query($sql);
    $RES = [] ; 
    if($stm->rowCount()>0){
            $res = $stm->fetchAll(PDO::FETCH_ASSOC) ; 
            foreach($res as $key => $value){
                $sql2 ="select Reponse_problem from Reponse_problem RP NATURAL JOIN problem P WHERE P.id_comp =$id_comp and RP.cne='$value[cne]'";
                $stm2 = $pdo->query($sql2);
                $res2 = $stm2->fetchAll(PDO::FETCH_ASSOC) ; 
                $value['result'] = $res2 ; 
                $RES[$key] = $value ; 
            }
            http_response_code(200) ; 
            echo json_encode($RES);
    }else{
            http_response_code(400);
            echo json_encode("no data found");
    }
   
 
       

}


?>