<?php 
function insert_images(array $files , string $fichier_applode):string {

    $size=$files['size'];
    $tmp_name=$files['tmp_name'];
    $ereur=$files['error'];
    $type=$files['type'];
    $name=$files['name'];
    
    $tab=explode('.',$name);
    $extension=end($tab);
    $tab1=["jpg","jpeg","png"];
    if(in_array($extension,$tab1)){
        if($size<500000){
            $upload= $fichier_applode;
            $new_name=uniqid();
            $new_name.= ".".$extension;
            $upload.=$new_name;
            move_uploaded_file($tmp_name,$upload);
            return "/images/$new_name";
        }
        else{
            echo "La taille non appropriée";
            return null;
        }
    }else{
        echo "Modifier votre fichier";
        return null;
    }
}
?>