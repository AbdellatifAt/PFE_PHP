<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cne'] )&& isset($_GET['id_comp']) ){
    $cne=  $_GET['cne'];
    $id_comp=  $_GET['id_comp'];

            $sql = "UPDATE condidateur set etat ='-1' where cne= '$cne' and id_comp = $id_comp" ; 
            $res = $pdo->query($sql);
            if($res){
                $sql2 ="SELECT * from condidateur where cne= '$cne' and id_comp = $id_comp" ; 
                $stm2 = $pdo->query($sql2) ; 
                if($stm2->rowCount()>0){
                    $res2 = $stm2->fetch(PDO::FETCH_ASSOC) ; 
                    http_response_code(200);
                    echo json_encode($res2);
                }
                else{
                    http_response_code(400);
                    echo json_encode(false);
                }
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