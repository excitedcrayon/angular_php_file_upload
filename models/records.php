<?php
require_once('../inc/dbConfig.php');
// Script gets records from the database

$data = array();

$display = new dbConfig(db_host, db_user, db_password, db_name);
$display->connect();

$displayQuery = "SELECT file_id AS id, file_orig_name AS filename, file_name AS name, file_category AS category, file_link AS link, category.cat_name as category FROM file JOIN category WHERE file_id = category.cat_id ORDER BY file_id ASC";

$result = $display->getResult($displayQuery);

if(!$result){
    echo 'Error: ' . $display->getError() . '<br>';
}else{
    while($row=$display->fetchAssoc($result)){
        $data[] = $row;
    }
}
// check for the int values in the JSON object
echo json_encode($data, JSON_NUMERIC_CHECK);
?>
