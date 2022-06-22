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
			$cin_ens = array();

            $sql = "START TRANSACTION" ; 
			$pdo->query($sql);
			$etatTransaction = true ;

			foreach($reader as $key => $row){

				$cin =$row[0];
				$nom = $row[1];
				$prenom = $row[2];
                $email = $row[3] ; 
                $password = password_hash($cin , PASSWORD_DEFAULT);
                $sql =  "INSERT into enseignant(cin , nom , prenom ,email , password,user_name) values ('$cin' ,'$nom' , '$prenom' ,'$email','$password' ,'$nom.$prenom-ENS') ";
			    $stm1 = $pdo->query($sql);
                if($stm1){
                    array_push($cin_ens , $cin) ; 
                }else{
                    $etatTransaction = false ;
                    break ; 
                }
				
			}

            if(!empty($cin_ens)){

            
            $chaine = '(' ; 
            foreach($cin_ens as $value ){
                $chaine .= "'". $value ."'," ; 
            }
            $chaine[strlen($chaine) - 1 ] = ')' ;
                $sql  ="select * from enseignant where cin in $chaine" ; 
                $stm = $pdo->query($sql);
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
                    echo json_encode("aucun etudinat insert");
                }
            }else{
                    $sql = "ROLLBACK" ; 
                    $pdo->query($sql);
                    http_response_code(400);
                    echo json_encode("aucun etudinat ajouter");
            }
		}
		else{
            $sql = "ROLLBACK" ; 
            $pdo->query($sql);
            http_response_code(400);
			echo json_encode("error");
		}
?>