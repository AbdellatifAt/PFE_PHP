<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';

		if(isset($_FILES['excel'])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require './exelReader/excel_reader2.php';
			require './exelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			$cne_Etudiants = array();

            $sql = "START TRANSACTION" ; 
			$pdo->query($sql);
			$etatTransaction = true ;

			foreach($reader as $key => $row){

				$cne =$row[0];
				$nom = $row[1];
				$prenom = $row[2];
                $email = $row[3] ; 
                $password = password_hash($cne , PASSWORD_DEFAULT);
                $sql =  "INSERT into etudiant(cne , nom , prenom ,email , password,user_name) values ('$cne' ,'$nom' ,'$prenom' ,'$email','$password' ,'$nom.$prenom-ETU') ";
			    $stm1 = $pdo->query($sql);
                if($stm1){
                    array_push($cne_Etudiants , $cne)  ; 
                }else{
                    $etatTransaction = false ;
                    break ; 
                }
				
			}

            if(!empty($cne_Etudiants)){

                $chaine = '(' ; 
                foreach($cne_Etudiants as $value ){
                    $chaine .= "'". $value ."'," ; 
                }
                $chaine[strlen($chaine) - 1 ] = ')' ;
                $sql  ="select * from etudiant where cne in $chaine" ; 
                $stm = $pdo->query($sql) ;
                if($stm->rowCount()> 0 && $etatTransaction ){
                    $res = $stm->fetchAll(PDO::FETCH_ASSOC) ; 
                    $sql = "commit" ; 
                    $pdo->query($sql);
                    http_response_code(200);
                    echo json_encode($res);
                    
                } 
                else{
                    $sql = "ROLLBACK" ; 
                    $pdo->query($sql);
                    http_response_code(400);
                    echo json_encode("aucun etudiant insere");
                }
            }else{
                $sql = "ROLLBACK" ; 
                $pdo->query($sql);
                http_response_code(400);
                echo json_encode("aucun etudiant ajouter");
                
            }
                
			
		}
		else{
            $sql = "ROLLBACK" ; 
            $pdo->query($sql);
            http_response_code(400);
			echo json_encode("error");
		}
?>