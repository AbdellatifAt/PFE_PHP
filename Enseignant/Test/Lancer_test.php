<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if( isset($_POST['date_exp']) && isset($_POST['id_test']) ){
    $date_exp = $_POST['date_exp'];
    $id_test = $_POST['id_test'];

    $currentDate = new DateTime();
    $date_cur = $currentDate->format('Y-m-d H:i:s');
    if($date_exp> $date_cur){
        $sql = "UPDATE test SET date_exp = '$date_exp' , date_debut =NOW() where id_test = $id_test ";
        $res = $pdo->query($sql);
    
        if($res){
            //
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
                http_response_code(400);
                echo json_encode("select faild");
            }
            //
        }
        else{
            http_response_code(400);
            echo json_encode(false);
        }

    }
    else{
        http_response_code(400);
        echo json_encode('imposseble');
    }
    
   

}



?>