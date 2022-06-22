<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_POST['cne']) && isset($_POST['id_comp'])){
    $cne = $_POST['cne'];
    $id_comp = $_POST['id_comp'];

       
        $sql ="UPDATE condidateur set valide_comp= '1' where id_comp = $id_comp and cne ='$cne' " ; 
        $res = $pdo->query($sql) ;
        if($res){
                http_response_code(200);
                echo json_encode(true);

        }else{
                http_response_code(400);
                echo json_encode(false);

        }
}else{
     http_response_code(400);
    echo json_encode("echec");
} 




 
 
?>