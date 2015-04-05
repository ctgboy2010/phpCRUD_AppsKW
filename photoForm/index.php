<?php
include('connect-db.php');
if (isset($_FILES['myfile']) && isset($_GET['id'])) 
{
    $filename = $_FILES['myfile']['name'];
    $filetype = $_FILES['myfile']['type'];
    $filesize = $_FILES['myfile']['size'];
    $filetmp = $_FILES['myfile']['tmp_name'];
    $fileerror = $_FILES['myfile']['error'];
    $id = $_GET['id'];

if ( $fileerror > 0){
die("Error Uploading File Code $fileerror.");
}
else
{
move_uploaded_file($filetmp,"F:/xampp/htdocs/PHP/crud01/images/".$filename);
echo "Upload Complete!";
}

$sqlvisit="INSERT INTO shot (VISIT_ID, PATIENT_ID, IMG_FILENAME, SHRUNK_IMG_FILENAME, SUBDIR, SUBSUBDIR, IMG_FILE_FORMAT, EYE) SELECT (SELECT max(ID) from visit where visit.patient_id =" . $id ."), " . $id . ", (SELECT CASE blah blah), (SELECT CASE blah blah), '9', '1', '124', '0' FROM SHOT WHERE shot.patient_id = " . $id . "";
mysql_query($sqlvisit);
}
?>

<form id="form3" action="" method="post" enctype="multipart/form-data" style="display:none;width:300px;background-color: #FFFFFF;"> 
Upload Image(s)..<input type="file" name="myfile"><br />
<input type="submit">
</form>