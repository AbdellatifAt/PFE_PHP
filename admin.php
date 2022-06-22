<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include './connexion.php';

  $password = password_hash("1234", PASSWORD_DEFAULT);
  $username = 'admin@gmail.com' ; 
	$sql ="INSERT INTO admin(user_name,password) values ('$username', '$password')" ;
    $res = $pdo->query($sql);
    if($res){
        echo  "secces";
    }else{
        echo "echec" ;
    }
            
?>