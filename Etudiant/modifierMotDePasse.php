<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirmation_password']) && isset($_POST['cne'])){


    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirmation_password = $_POST['confirmation_password'];
    $cne = $_POST['cne'] ; 

    if($new_password === $confirmation_password) {
        $sql ="SELECT password  from etudiant where  cne ='$cne'" ; 
        $stm = $pdo->query($sql) ; 
        if($stm->rowCount()>0){
            $res =$stm->fetch(PDO::FETCH_ASSOC) ; 
            if(password_verify($old_password , $res['password'])){
                $new_pass = password_hash($new_password ,PASSWORD_DEFAULT );
                $sql = "UPDATE etudiant SET password = '$new_pass' where cne ='$cne'" ;
                $res= $pdo->query($sql);
                if($res){
                    http_response_code(200);
                    echo json_encode(true);
                }
                else{
                    http_response_code(400);
                    echo json_encode(false);
                }

            }else{
                http_response_code(400);
                echo json_encode(false);

            }
        }else{
            http_response_code(400);
            echo json_encode(false);
        }
    }else{
        http_response_code(400);
        echo json_encode(false);
    }
    
}else{
    http_response_code(400);
    echo json_encode(false);
}

 
?>