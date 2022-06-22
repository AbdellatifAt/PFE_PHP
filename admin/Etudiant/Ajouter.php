<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
include '../../Functions/apload.php' ; 


if(isset($_POST['cne']) && isset($_POST['nom']) && isset($_POST['prenom']) &&
isset($_POST['email']) ){

    $cne = htmlspecialchars($_POST['cne'] ); 
    $nom=str_replace(' ' ,'' ,htmlspecialchars($_POST['nom']));
    $email=htmlspecialchars($_POST['email']);
    $prenom=str_replace(' ' ,'' ,htmlspecialchars($_POST['prenom']));
    $password = password_hash($cne , PASSWORD_DEFAULT);
    
    $files = $_FILES['image'];
    
    if($files['error']!=0){
          
        $sql =  "INSERT into etudiant(cne , nom , prenom ,email , password,user_name) values ('$cne' ,'$nom' ,'$prenom' ,'$email','$password' ,'$nom.$prenom-ETU') ";
        
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
            $sql =  "INSERT into etudiant(cne , nom , prenom ,email , password,user_name, image) values ('$cne' , '$nom' , '$prenom' ,'$email','$password' ,
            '$nom.$prenom-ETU', '$image') ";
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
    echo json_encode('saisir tout les inputs');
}









?>