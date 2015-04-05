<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/

 // connect to the database
 include('connect-db.php');
 
 // check if the 'image_id' variable is set in URL, and check that it is valimage_id
 if (isset($_GET['image_id']) && is_numeric($_GET['image_id']))
 {
 // get image_id value
 $image_id = $_GET['image_id'];
 
 // delete the entry
 $result = mysql_query("DELETE FROM testblob WHERE image_id=$image_id")
 or die(mysql_error()); 
 
 // redirect back to the view page
 header("Location: view.php");
 }
 else
 // if image_id isn't set, or isn't valimage_id, redirect back to view page
 {
 header("Location: view.php");
 }
 
?>
