<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_POST['nom'] ) && $_POST['id_comp']){

    $nom_comp=  $_POST['nom'];
    $id_comp=  $_POST['id_comp'];

            $sql = "Update competition set nom_comp ='$nom_comp'  where id_comp= $id_comp" ; 
            $res = $pdo->query($sql);
            if($res){
                $sql = "SELECT * FROM competition where id_comp= $id_comp" ; 
                $stm = $pdo->query($sql);
                if($stm->rowCount()>0){
                    $res = $stm->fetch(PDO::FETCH_ASSOC); 
                    http_response_code(200);
                    echo json_encode($res);
                }
                else{
                    http_response_code(400);
                    echo json_encode("erreur");
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