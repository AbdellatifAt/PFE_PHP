<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';


if(isset($_GET['id_test'])){
    $id_test = $_GET['id_test'];
    $sql  = "select * from test where id_test = $id_test ";
    $stm =  $pdo->query($sql);
    if($stm ->rowCount() >0){
            $res = $stm ->fetch(PDO::FETCH_ASSOC);
            if($res){
                
                http_response_code(200);
                echo json_encode($res);
            }else{
                http_response_code(400);
                echo json_encode('faild to fetch');
            }
    }
    else{

        echo json_encode("select faild");
    }


}
else{
    echo json_encode("error");
}

?>