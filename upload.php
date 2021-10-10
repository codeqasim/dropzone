<?php 

print_r($_FILES);

include "db.php";

$targetDir = "uploads/"; 
$allowTypes = array('jpg','png','jpeg','gif'); 

// image upload function
if (!empty($_FILES["file"]["name"])) {
    $file_name      = $_FILES["file"]["name"];
    $temp_name      = $_FILES["file"]["tmp_name"];
    $imgtype        = $_FILES["file"]["type"];
    $ext            = pathinfo($file_name, PATHINFO_EXTENSION);
    $img            = date("d-m-Y") . "-" . time() . "." . $ext;
    $target_path    = "uploads/".$img;
    
    // move file with rename to di
    if(move_uploaded_file($temp_name, $target_path)) {
    
    }else{ exit("Error While uploading image on the server"); } 

    // print_r($img);
    // die;

    // $insert = $db->query("INSERT INTO images (name, uploaded_on) VALUES $img"); 
       
    $date = date("yy:m:d:h:i");
    $sql = "INSERT INTO `images` (`id`, `name`, `date`) VALUES (NULL, '$img', '$date');";

    if ($db->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
    }
    
    $db->close();

}
    
