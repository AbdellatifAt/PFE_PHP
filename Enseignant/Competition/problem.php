<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
include '../../Functions/aplouad_files.php' ;

if(isset($_POST['desc']) && isset($_FILES['file']) && isset($_POST['id_comp']) ){
    $desc=  $_POST['desc'];
    $id_comp=  $_POST['id_comp'];
    $File = $_FILES['file']; 
    
    if($files['error']==0){
        $file = insert_file($File , '../../Files/') ;
        if($file != null){
            $sql ="INSERT INTO problem values (null , '$desc' ,$id_comp , '$file')" ; 
            $res = $pdo->query($sql) ; 
            if($res){
                $sql2 = "SELECT * from problem where id_comp =$id_comp order by id_problem desc limit 1 " ; 
                $stm2 = $pdo->query($sql2) ; 
                if($stm2->rowCount()>0){
                    $res2 = $stm2->fetch(PDO::FETCH_ASSOC);
                    http_response_code(200); 
                    echo json_encode($res2);

                }
                else{
                    http_response_code(400); 
                    echo json_encode('erreur de selection ');
                }
            }else{
                http_response_code(400); 
                echo json_encode("erreur de l'insertion");
            }

        }
        else{

        }

}
}

?>