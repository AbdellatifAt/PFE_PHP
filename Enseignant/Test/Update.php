<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_POST['question']) && isset($_POST['option']) && isset($_POST['values']) 
&& isset($_POST['id_test']) && isset($_POST['id_quest']) ){

    $question = $_POST['question'] ; 
    $option = $_POST['opt'] ; 
    $values = $_POST['values'] ;
    $id_test = $_POST['id_test'] ; 
    $id_quest = $_POST['id_quest'];

    $sql = "UPDATE question set quest = '$question' WHERE id_quest = $id_quest" ; 
    $res = $pdo->query($sql) ; 
    if($res){
        $sql1 = "DELETE FROM choix WHERE id_quest = $id_quest";
        $res1 = $pdo->query($sql1) ;
        if($res1){

            foreach ($values as $key => $value) {
                if(in_array($key,$option)){
                    $query = "INSERT INTO choix(choix, choix_correct ,id_quest)
                    VALUES ('$value' ,1 ,$id_quest)" ;
                    $res3 = $pdo->query($query);
                    
                }
                else{
                    $query = "INSERT INTO choix(choix, choix_correct ,id_quest)
                    VALUES ('$value' ,0 ,$id_quest)" ;
                    $res3 = $pdo->query($query);

                }
            }

            $sql4 = "select * from question where id_quest = $id_quest";
            $stm4 = $pdo->query($sql4);
            if($stm4 ->rowCount()>0){
                $res4 = $stm4->fetch(PDO::FETCH_ASSOC);
                $sql2= "select * from choix where id_quest = $res4[id_quest] ";
                $stm1 = $pdo->query($sql2);
                $res2 = $stm1->fetchAll(PDO::FETCH_ASSOC);
                $res4['choix'] = $res2 ;
                http_response_code(200) ; 
                echo json_encode($res4);

            }
            else{
                http_response_code(400) ; 
                echo json_encode('echec');
            }


            


        }
        else{
            http_response_code(400) ; 
            echo json_encode('echec in delete table choix');
        }

    }
    else{
        http_response_code(400) ; 
        echo json_encode('update echec');
    }

}
?>