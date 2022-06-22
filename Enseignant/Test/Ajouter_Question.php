<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';


if(isset($_POST['question']) && isset($_POST['option']) && isset($_POST['values']) 
&& isset($_POST['id_test'])){
    $question = $_POST['question'] ; 
    $option = $_POST['opt'] ; 
    $values = $_POST['values'] ;
    $id_test = $_POST['id_test'] ; 

    if(!empty($option)){
        
    $sql ="INSERT INTO question(quest , id_test) VALUES('$question' , $id_test) ";
    $res = $pdo->query($sql);
    if($res){
          $sql2 =  "SELECT * from question where id_test = $id_test ORDER BY id_quest DESC LIMIT 1";
          $stm2 = $pdo->query($sql2);
          if($stm2->rowCount()>0){
                $res2 = $stm2->fetch(PDO::FETCH_ASSOC);
                $id_question = $res2['id_quest'];
                foreach ($values as $key => $value) {
                    if(in_array($key,$option)){
                        $query = "INSERT INTO choix(choix, choix_correct ,id_quest)
                        VALUES ('$value' ,1 ,$id_question)" ;
                        $res3 = $pdo->query($query);
                        
                    }
                    else{
                        $query = "INSERT INTO choix(choix, choix_correct ,id_quest)
                        VALUES ('$value' ,0 ,$id_question)" ;
                        $res3 = $pdo->query($query);

                    }
                }

                   
                   
                    
                        $sql1 = "select * from choix where id_quest = $res2[id_quest] ";
                        $stm1 = $pdo->query($sql1);
                        $res1 = $stm1->fetchAll(PDO::FETCH_ASSOC);
                        $res2['choix'] = $res1 ;
                       
                    
                    http_response_code(200);
                    echo json_encode($res2);
               
                // $sql4 = "SELECT C.id_quest , C.choix , C.id_choix , Q.quest , C.choix_correct , Q.id_test from Choix C Natural join question Q WHERE id_test= $id_test && id_quest = $id_question ";
                // $stm = $pdo->query($sql4);
                //     if($stm->rowCount()>0){
                //         $res4 =$stm->fetchAll(PDO::FETCH_ASSOC);
                //         http_response_code(200);
                //         echo json_encode($res4);
                //     }else{
                //         http_response_code(400);
                //         echo json_encode('no data found');
                //     } 


                
          }
          else{
              echo json_encode('erreur no data found');
          }


    } 
    else{
        http_response_code(400);
        echo json_encode('error');
    }
    }else{
        http_response_code(400);
        echo json_encode('cocher un option correct');
    }




    
    
}




?>