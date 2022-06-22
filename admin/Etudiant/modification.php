<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
include '../../Functions/apload.php' ; 


if( isset($_POST['cne']) && isset($_POST['password']) && isset($_POST['user_name']) &&
 isset($_POST['email']) ){

    $cne = htmlspecialchars($_POST['cne'] ); 
    $password=password_hash(htmlspecialchars($_POST['password']),PASSWORD_DEFAULT);
    $email=htmlspecialchars($_POST['email']);
    $user_name=htmlspecialchars($_POST['user_name']);
    $files = $_FILES['image'];
    
    if(!empty(htmlspecialchars($_POST['password']))){
        if($files['error']!=0){
          
            $sql = "UPDATE etudiant SET password='$password',email ='$email' , user_name='$user_name' where cne ='$cne' " ;
            
                $res=$pdo->query($sql);
               
                if($res){
                    $query = "select * from etudiant where cne ='$cne'" ; 
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
                    echo json_encode('erreur de ajouter etudiant' );
            
                }     
          
        }
        else{
            $image = insert_images($files,'../../images/');
            if($image != null){
                $sql = "UPDATE etudiant SET password='$password',email ='$email' , user_name='$user_name', image ='$image' where cne ='$cne' " ;
                    $res=$pdo->query($sql);               
                    if($res){
                        $query = "select * from etudiant where cne ='$cne'" ; 
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
                        echo json_encode($sql );
                
                    }
                    
    
        }
    }

    }
    else{
        if($files['error']!=0){
          
            $sql = "UPDATE etudiant SET email ='$email' , user_name='$user_name' where cne ='$cne' " ;
            
                $res=$pdo->query($sql);
               
                if($res){
                    $query = "select * from etudiant where cne ='$cne'" ; 
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
                    echo json_encode('erreur de ajouter etudiant' );
            
                }     
          
        }
        else{
            $image = insert_images($files,'../../images/');
            if($image != null){
                $sql = "UPDATE etudiant SET email ='$email' , user_name='$user_name', image ='$image' where cne ='$cne' " ;
                    $res=$pdo->query($sql);               
                    if($res){
                        $query = "select * from etudiant where cne ='$cne'" ; 
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
                        echo json_encode($sql );
                
                    }
                    
    
        }
    }
    }
   
    
    
   
  

}
else{
    echo json_encode('saisir tout les inputs');
}









?>
