<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_GET['id_chap']) && isset($_GET['cne'])){
    $id_chap = $_GET['id_chap'] ; 
    $cne = $_GET['cne'] ; 

    $sql ="SELECT id_test FROM test where id_chap =$id_chap";
    $stm = $pdo->query($sql);
    if($stm->rowCount()>0){
        $res = $stm->fetch(PDO::FETCH_ASSOC);

        $sql1 ="SELECT * FROM test_passer where id_test =$res[id_test] AND  cne ='$cne'";
        $stm1 = $pdo->query($sql1);
        if($stm1->rowCount()>0){
            $res1 = $stm1->fetch(PDO::FETCH_ASSOC);
            http_response_code(200);
            echo json_encode($res1);
        }else{
            $currentDate = new DateTime();
            $date_cur = $currentDate->format('Y-m-d H:i:s');
            $sql2="INSERT INTO test_passer(id_test , cne , date_passser_test,note) VALUES ($res[id_test] , '$cne' , '$date_cur' ,0)";
            
            $res2 = $pdo->query($sql2);
            if($res2){
                $sql3 ="SELECT * FROM test_passer where id_test =$res[id_test] && cne ='$cne'";
                $stm3 = $pdo->query($sql3);
                if($stm3->rowCount()>0){
                    $res3 = $stm3->fetch(PDO::FETCH_ASSOC); 
                    http_response_code(200);
                    echo json_encode($res3);
                }
                else{
                    http_response_code(400);
                    echo json_encode("no data found");
                    
                }

            }else{
                http_response_code(400);
                echo json_encode("echec d''inser");   
            }
        }
    }
    else{
        http_response_code(400);
        echo json_encode("no data found");
        
    }
    
}
else{
    http_response_code(400);
    echo json_encode("erreur");
}
 
?>