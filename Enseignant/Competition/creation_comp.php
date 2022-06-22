<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

 

if( isset($_POST['nom'] ) && isset($_POST['semester'] ) && isset($_POST['module'] ) && isset($_POST['cin'] ) 
     && isset($_POST['date_exp'])  && isset($_POST['date_debut']) ){
    $nom = htmlspecialchars($_POST['nom']); 
    $id_semester = htmlspecialchars($_POST['semester']); 
    $module = $_POST['module']; 
    $cin=htmlspecialchars($_POST['cin'] );
    $date_exp = $_POST['date_exp'] ;
    $date_debut = $_POST['date_debut'] ;

    $sql = "START TRANSACTION"; 
    $res = $pdo->query($sql);
    if($res){
        $sql1 = "INSERT into competition(nom_comp) values('$nom') "; 
        $res1 = $pdo->query($sql1);
        if($res1){
            $sql2 = " SELECT id_comp FROM  competition order by id_comp desc limit 1"; 
            $stm2 = $pdo->query($sql2);
            if($stm2->rowCount()>0){
            $res2= $stm2->fetch(PDO::FETCH_ASSOC);
             
            $sql9 = "select id_module from module where id_semester =$id_semester and cin ='$cin'";
            $stm9= $pdo->query($sql9);
            if($stm9->rowCount()>0){
                $res9 = $stm9->fetch(PDO::FETCH_ASSOC) ;
                if(!in_array($res9['id_module'] , $module)){
                    array_push($module , $res9['id_module']);
                }
            }
            
            $currentDate = new DateTime();
            $date_cur = $currentDate->format('Y-m-d H:i:s');

            if($date_exp > $date_cur && $date_debut > $date_cur && $date_exp > $date_debut){
                foreach($module as $val){
                    $sql4 = " SELECT cin FROM module where id_module = $val";
                    $stm4 = $pdo->query($sql4);
                    $res4= $stm4->fetch(PDO::FETCH_ASSOC);
                    $sql5= " INSERT INTO organise_competition values($res2[id_comp],'$res4[cin]','$date_debut','$date_exp',$val)"; 
                    $stm5 = $pdo->query($sql5);
                 }

                 $sql3 = "Commit"; 
                 $res3 = $pdo->query($sql3);
                 $sql6 = "SELECT * from competition NATURAL JOIN organise_competition where cin ='$cin' and  id_comp = $res2[id_comp] ";
                     $stm6 = $pdo->query($sql6);
                     if($stm6->rowCount()>0){
                         $res6=$stm6->fetch(PDO::FETCH_ASSOC);
                         http_response_code(200);
                         echo json_encode($res6);
                     }else{
                         $sql3 = "ROLLBACK  "; 
                         $res3 = $pdo->query($sql3);
                         http_response_code(400);
                         echo json_encode('aucune competition injectée');
                     }

            }else{
                $sql3 = "ROLLBACK  "; 
                $res3 = $pdo->query($sql3);
                http_response_code(400);
                echo json_encode('la date non valide');
            }
             
         
              

            }else{
                $sql3 = "ROLLBACK  "; 
                $res3 = $pdo->query($sql3);
                http_response_code(400);
                echo json_encode('Competition non trouvée');

            }

        }else{
            $sql3 = "ROLLBACK  "; 
            $res3 = $pdo->query($sql3);
            http_response_code(400);
            echo json_encode('competition non insérée');
        }
   
        
    }else{
        http_response_code(400);
        echo json_encode('erreur');    
    }
        
}
else{
    http_response_code(400);
    echo json_encode('error');
}    
?>