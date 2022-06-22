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

			$sql = "START TRANSACTION" ; 
			$pdo->query($sql);
			$etatTransaction = true ; 
			
			foreach($reader as $key => $row){
				$nom_module =$row[0];
				$cne = $row[1];
				$date = date('Y-m-d');

				$stm = $pdo->query("SELECT id_module from module WHERE nom_module = '$nom_module' ");
				if($stm->rowCount()===0){
					$etatTransaction = false ; 
					break ; 
				}else{
					$res = $stm->fetch(PDO::FETCH_ASSOC) ; 
					$sql= "INSERT INTO inscription(id_module,cne, date_inscri,score) VALUES ($res[id_module] ,'$cne', '$date',0)";
					$res2 = $pdo->query($sql);

					if(!$res2){
						$etatTransaction = false ; 
						break ; 
					}

				}	
			}
			if($etatTransaction){
				$sql = "commit" ; 
				$pdo->query($sql);
				http_response_code(200);
				echo json_encode($etatTransaction);
		
			}else{
				$sql = "ROLLBACK" ; 
				$pdo->query($sql);
				http_response_code(400);
				echo json_encode($etatTransaction);
			}
			
		}
		else{
			http_response_code(400);
			echo json_encode("error");
		}
?>