<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_GET['id_comp']) ){
    $id_comp = $_GET['id_comp'];
    $cne = $_GET['cne'];

    $resltat = [];

        $sql = "select * from problem where id_comp = $id_comp" ; 
        $stm = $pdo->query($sql) ; 
        if($stm->rowCount()>0){
            $res = $stm->fetchAll(PDO::FETCH_ASSOC) ; 
            foreach($res as $key => $value){

                $sql2 ="SELECT R.Reponse_problem , P.description , P.file ,C.id_comp , C.nom_comp , P.id_problem
                from competition C Natural join problem P Natural join reponse_problem R  
                where id_comp = $id_comp  and cne = '$cne' and id_problem =$value[id_problem] ";

                $stm2= $pdo->query($sql2);
                $res2 = $stm2->fetch(PDO::FETCH_ASSOC) ; 
                $value['rep_comp_etud'] = $res2 ;
                $resltat[$key] = $value ; 
            }
            http_response_code(200) ; 
            echo json_encode($resltat) ; 


        }else{
            http_response_code(400); 
            echo json_encode('no data found') ; 
        }

    
       

    }
    else{
        http_response_code(400);
        echo json_encode("no data found ");
        
}

 
?>