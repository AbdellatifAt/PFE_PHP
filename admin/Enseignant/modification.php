<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
include '../../Functions/apload.php' ; 


if(isset($_POST['cin']) && isset($_POST['password']) && isset($_POST['user_name']) &&
 isset($_POST['email']) ){
    $cin = htmlspecialchars($_POST['cin']) ; 
    $password= password_hash(htmlspecialchars($_POST['password']) , PASSWORD_DEFAULT);
    $email=htmlspecialchars($_POST['email']);
    $user_name=htmlspecialchars($_POST['user_name']);
        
    $files = $_FILES['image'];

    if(!empty(htmlspecialchars($_POST['password']))){
        if($files['error']!=0){
          
            $sql = "UPDATE enseignant SET password='$password',email ='$email' , user_name='$user_name' where cin='$cin'" ;
            
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
                $sql = "UPDATE enseignant SET password='$password',email ='$email' , user_name='$user_name', image ='$image' where cin='$cin' " ;
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

        if($files['error']!=0){
          
            $sql = "UPDATE enseignant SET email ='$email' , user_name='$user_name' where cin='$cin'" ;
            
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
                $sql = "UPDATE enseignant SET email ='$email' , user_name='$user_name', image ='$image' where cin='$cin' " ;
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
    

  

}
else{
    echo json_encode('saisir tout les inputs');
}







?>