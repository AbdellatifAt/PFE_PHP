<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_POST['cne']) && isset($_POST['id_problem'])){
    $cne = $_POST['cne'];
    $id_problem = $_POST['id_problem'];

       
        $sql ="DELETE  FROM reponse_problem  where id_problem = $id_problem and cne ='$cne'" ; 
        $res = $pdo->query($sql) ;
        if($res){
            $sql ="SELECT P.description , P.file ,C.id_comp , C.nom_comp , P.id_problem
            from competition C Natural join problem P  where P.id_problem = $id_problem" ;
            $stm = $pdo->query($sql); 
            if($stm->rowCount()>0){
                $res = $stm->fetch(PDO::FETCH_ASSOC) ; 
                $res['Reponse_problem'] = null ; 
                http_response_code(200);
                echo json_encode($res);

            }else{
                http_response_code(400);
                echo json_encode("error");

            }
        }else{
            http_response_code(400);
            echo json_encode("echec");
        } 


}else{
        http_response_code(400);
        echo json_encode("no data found ");
}

 
 
?>