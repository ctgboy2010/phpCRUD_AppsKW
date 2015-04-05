<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $title, $description, $institute, $address, $year, $duration, $start, $end, $courseTitle, $detail, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 </head>
  <div class='formbox'>
    <div align="center">|<a href="index.php"> Registration </a>| <a href="view.php">List </a>|  
    </div>
</div>
<h2 align="center">Applicant Training Edit</h2> 

 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 <table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">
<tr>
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
 <p><strong>ID:</strong> <?php echo $id; ?></p>

 <tr>
        <td align='left'><strong>Training Title: *</strong></td><td><input type="text" name="title" value="<?php echo $title; ?>" /><br/></td></tr>
                    
         <tr> <td align='left'> <strong>description: *</strong> </td><td><input type="text" name="description" value="<?php echo $description; ?>" /><br/></td></tr>
         
          <tr> <td align='left'> <strong>institute: *</strong> </td><td><input type="text" name="institute" value="<?php echo $institute; ?>" /><br/></td></tr>       
         
          <tr> <td align='left'><strong>address: *</strong> </td><td><input type="text" name="address" value="<?php echo $address; ?>" /><br/></td></tr>
          
              
          <tr> <td align='left'><strong>year: *</strong> </td><td><input type="text" name="year" value="<?php echo $year; ?>" /><br/></td></tr>
               
    
          <tr> <td align='left'><strong>duration: *</strong></td><td> <input type="text" name="duration" value="<?php echo $duration; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>start: *</strong> </td><td><input type="text" name="start" value="<?php echo $start; ?>" /><br/></td></tr>
         
         <tr> <td align='left'> <strong>end: *</strong> </td><td><input type="text" name="end" value="<?php echo $end; ?>" /><br/></td></tr>   
         
                 
        
         <tr> <td align='left'> <strong>courseTitle: *</strong> </td><td><input type="text" name="courseTitle" value="<?php echo $courseTitle; ?>" /><br/></td></tr>
         <tr> <td align='left'> <strong>detail: *</strong> </td><td><input type="text" name="detail" value="<?php echo $detail; ?>" /><br/></td></tr>  
         
 <tr> <td height="68" colspan="2" align="center">
 <p>* Required</p>
 <input type="submit" name="submit" value="Update">
 </div>
 </form> 
 </td>
    </tr>
    </table>
 </body>
 </html> 
 <?php
 }



 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];

 
    $title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
    $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
	 
    $institute = mysql_real_escape_string(htmlspecialchars($_POST['institute'])); 
	$address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
	$year = mysql_real_escape_string(htmlspecialchars($_POST['year']));
	$duration = mysql_real_escape_string(htmlspecialchars($_POST['duration']));
	
	  $start = mysql_real_escape_string(htmlspecialchars($_POST['start']));
	  
	  $end = mysql_real_escape_string(htmlspecialchars($_POST['end']));
    $courseTitle = mysql_real_escape_string(htmlspecialchars($_POST['courseTitle']));
	 
	 
	   $detail = mysql_real_escape_string(htmlspecialchars($_POST['detail']));
 
 // check that result/created fields are both filled in
 if ($title == '' || $description == '' || $institute == '' || $address == ''|| $year == '' || $duration == ''|| $start == '' || $end == '' || $courseTitle == ''|| $detail == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $title, $description, $institute, $address, $year,$duration, $start, $end, $courseTitle, $detail, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE training SET title='$title', description='$description', institute='$institute', address='$address',  year='$year', duration='$duration',  start='$start', end='$end', courseTitle='$courseTitle', detail='$detail' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM training WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $title = $row['title'];
 $description = $row['description'];
 $institute = $row['institute'];
 $address = $row['address'];
 $year = $row['year'];
 $duration = $row['duration'];
 $start = $row['start'];

 $end = $row['end'];
 $courseTitle = $row['courseTitle'];
 
 $detail = $row['detail'];
 

 
 // show form
 renderForm($id, $title, $description, $institute, $address, $year, $duration, $start, $end, $courseTitle, $detail, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>
