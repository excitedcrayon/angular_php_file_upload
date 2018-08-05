<?php
// Script deletes from server and database record
require_once('../inc/dbConfig.php');

//$data = json_decode(file_get_contents("php://input"));
// get the file id from post
//$file_id = $data->fileid;
// parse from string to int | for some reason the data is returned as a string
$file_id = $_POST['fileid'];
$data = array();
$delete = new dbConfig(db_host, db_user, db_password, db_name);
$delete->connect();

// get the row data first
$searchQuery = "SELECT * FROM file WHERE file_id='$file_id' LIMIT 1";
$result = $delete->getResult($searchQuery);

if(!$result){
  echo 'Error: ' . $delete->getError() . '<br>';
}else{
  while($row=$delete->fetchAssoc($result)){
    $data[] = $row;

    if(file_exists("../uploads/{$row['file_orig_name']}")){
      echo 'File Exists';
      // proceed to unlink here and delete records from database;
      // path to file
      $path = "../uploads/{$row['file_orig_name']}";
      echo $path;
      $removeFile = unlink($path);
      if(!$removeFile){
        echo 'Error Deleting File';
      }else{
        echo 'File Deleted';
        // delete record from database
        $deleteQuery = "DELETE FROM file WHERE file_id LIKE {$row['file_id']}";
        if(!$delete->query($deleteQuery)){
          echo 'Error: ' . $delete->getError();
          echo 'Could Not Delete Database Record';
        }else{
          echo 'Database Updated';
        }
      }
    }else{
      echo 'File Does Not Exist';
    }
  }
}
echo json_encode($data, JSON_NUMERIC_CHECK);
?>
