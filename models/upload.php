<?php
require_once('../inc/dbConfig.php');
// Script Uploads Form Data to Database

// title and category
$title = $_POST['title'];
$category = $_POST['category'];
// filename
$file = $_FILES['file']['name'];
// temp filename
$temp_file = $_FILES['file']['tmp_name'];
// upload folder | go one level up to upload root folder
$folder = '../uploads/';
$path = $folder.$file; // uploads/file
$uploadLink = null;
if(isset($_SERVER['HTTPS'])){
    $uploadLink = 'https://'.$_SERVER['HTTP_HOST'].'/upload/uploads/'.$file;
}else{
    $uploadLink = 'http://'.$_SERVER['HTTP_HOST'].'/upload/uploads/'.$file;
}

// get JSON data from Angular data obects
//$data = json_decode(file_get_contents("php://input"));
// parameters to hold JSON data
// $title = $insert->escapeString($data->title);
// $category = $insert->escapeString($data->category);

// check for file extensions
$extensions = array('php','htaccess','repo','conf','js','css');
if(in_array(end(explode(".", $file)), $extensions)){
  echo 'File extension not allowed';
}else{
  // move file to server here
  if(move_uploaded_file($temp_file, $path)){
    echo "File {$file} uploaded";

    // insert data into Database
    $insert = new dbConfig(db_host, db_user, db_password, db_name);
    $insert->connect();

        // sql query
    $insertQuery = "INSERT INTO file VALUES (NULL, '$file' ,'$title', '$category', '$uploadLink', CURRENT_TIMESTAMP)";

    $result = $insert->getResult($insertQuery);

    if(!$result){
      echo "Error: " . $insert->getError();
    }else{
      echo "Data inserted into database";
    }

    $insert->closeConnection();
  }else{
    echo "Error Uploading File: {$file}";
  }
}
?>
