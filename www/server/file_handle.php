<?php
// if (isset($_SESSION['prev_upload']) && $_SESSION['prev_upload']==$_FILES['name'])
require 'database_utility.php';
$conn = connect();
$id = unique_id($conn,"temp_file");
$fname = $id."_".$_FILES['file']['name'];

$fileContent = file_get_contents($_FILES['file']['tmp_name']);
// echo $_FILES['file']['tmp_name'];
// echo $fname;
file_put_contents("images/".$fname,$fileContent);
echo json_encode(array("url" => "server/images/$fname","id" => $fname));
?>