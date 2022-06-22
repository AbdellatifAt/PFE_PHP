<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
include '../../Functions/aplouad_files.php' ;

if(isset($_POST['desc']) && isset($_POST['id_problem']) ){
    $desc=  $_POST['desc'];
    $id_problem = $_POST['id_problem'];
    $File = $_FILES['file']; 
    
    if($files['error']===0){
        $file = insert_file($File , '../../Files/') ;
        if($file != null){
            $sql ="UPDATE problem set file ='$file' , description ='$desc' where id_problem = $id_problem " ; 
            $res = $pdo->query($sql) ; 
            if($res){
                $sql2 = "SELECT * from problem where id_problem =$id_problem" ; 
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
                echo json_encode("erreur de la modification");
            }

        }
    }else{
        $sql ="UPDATE problem set description ='$desc' where id_problem = $id_problem " ; 
        $res = $pdo->query($sql) ; 
        if($res){
            $sql2 = "SELECT * from problem where id_problem =$id_problem" ; 
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
            echo json_encode("erreur de la modification");
        }
    }
}
else{
    http_response_code(400);
    echo json_encode("error");
}

?>