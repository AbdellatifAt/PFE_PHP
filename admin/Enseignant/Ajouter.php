<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
include '../../Functions/apload.php' ; 


if(isset($_POST['cin']) && isset($_POST['nom']) && isset($_POST['prenom']) &&
isset($_POST['email']) ){

    $cin = htmlspecialchars($_POST['cin']) ; 
    $nom=str_replace(' ' ,'' ,htmlspecialchars($_POST['nom']));
    $email=htmlspecialchars($_POST['email']);
    $prenom=str_replace(' ' ,'' ,htmlspecialchars($_POST['prenom']));
    $password = password_hash($cin , PASSWORD_DEFAULT);
    
    $files = $_FILES['image'];
    
    if($files['error']!=0){
          
        $sql =  "INSERT into enseignant(cin , nom , prenom ,email , password,user_name) values ('$cin' ,'$nom' , '$prenom' ,'$email','$password' ,'$nom.$prenom-ENS') ";
        
            $res=$pdo->query($sql);
           
            if($res){
                $query = "select * from enseignant where cin ='$cin'" ; 
                $stm= $pdo->query($query) ;
                $resultat = $stm->fetch(PDO::FETCH_ASSOC);
        
                if($resultat){
                    http_response_code(200);
                    echo json_encode($resultat);
                }
                else{
                    http_response_code(400);
                    echo json_encode("erreur ");
                }
                    
            }else{
                http_response_code(400);
                echo json_encode('erreur de ajouter enseignant' );
        
            }     
      
    }
    else{
        $image = insert_images($files,'../../images/');
        if($image != null){
            $sql =  "INSERT into enseignant(cin , nom , prenom ,email , password,user_name, image) values ('$cin' , '$nom' , '$prenom' ,'$email','$password' ,
            '$nom.$prenom-ENS', '$image') ";
                $res=$pdo->query($sql);               
                if($res){
                    $query = "select * from enseignant where cin ='$cin'" ; 
                    $stm= $pdo->query($query) ;
                    $resultat = $stm->fetch(PDO::FETCH_ASSOC);
            
                    if($resultat){
                        http_response_code(200);
                        echo json_encode($resultat);
                    }
                    else{
                        http_response_code(400);
                        echo json_encode("erreur ");
                    }
                        
                }else{
                    http_response_code(400);
                    echo json_encode('erreur de ajouter enseignant' );
            
                }
                

    }
}
  

}
else{
    echo json_encode('saisir tout les inputs');
}









?>