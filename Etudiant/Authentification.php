<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';

 session_start();
if( isset($_POST['user_name'] )&& isset($_POST['password'])){
    $user_name = htmlspecialchars($_POST['user_name']); 
    $password = htmlspecialchars($_POST['password']) ;


    $sql = "SELECT * FROM etudiant WHERE user_name = '$user_name'  "; 
    $stm = $pdo->query($sql);
   
    $res= $stm->fetch(PDO::FETCH_ASSOC);
    

    if($res){
        if(password_verify($password , $res['password'])){
            $_SESSION['id_user'] = $res['cne'];
            $_SESSION['type'] = 'etudiant' ; 
            http_response_code(200);
            echo json_encode(array(
                "id" => $res['cne'],
                "idSession" => session_id()
             ));

        }else{
            http_response_code(400);
            echo json_encode("erreur de authentification ");
        }

    }
    else{
        http_response_code(400);
        echo json_encode("etudiant n'exist pas ");
    }

} 
else{
    echo json_encode('error');
}
