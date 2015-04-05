<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $name, $business, $address, $designation, $department, $fromdate, $todate, $duration, $responsibility, $error)
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
<h2 align="center">Applicant Contact Edit</h2> 

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

 
  <tr> <td align='left'><strong>Name: *</strong> </td><td><input type="text" name="name" value="<?php echo $name; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>Business: *</strong> </td><td><input type="text" name="business" value="<?php echo $business; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>Address: *</strong> </td><td><input type="text" name="address" value="<?php echo $address; ?>" /><br/></td></tr> 
       
            
         <tr> <td align='left'> <strong>Designation: *</strong> </td><td><input type="text" name="designation" value="<?php echo $designation; ?>" /><br/></td></tr>
        <tr> <td align='left'>  <strong>Department: *</strong> </td><td><input type="text" name="department" value="<?php echo $department; ?>" /><br/></td></tr>
            
          <tr> <td align='left'><strong>From Date: *</strong> </td><td><input type="date" name="fromdate" value="<?php echo $fromdate; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>To Date: *</strong></td><td> <input type="date" name="todate" value="<?php echo $todate; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>Duration: *</strong> </td><td><input type="text" name="duration" value="<?php echo $duration; ?>" /><br/></td></tr>
         
         <tr> <td align='left'><strong>Responsibility: *</strong></td><td> <input type="text" name="responsibility" value="<?php echo $responsibility; ?>" /><br/></td></tr>
         
 <tr> <td height="68" colspan="2" align="center">
 <p>* Required</p>
 <input type="submit" name="submit" value="Save">
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

 
    $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
    $business = mysql_real_escape_string(htmlspecialchars($_POST['business']));
	  $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
    $designation = mysql_real_escape_string(htmlspecialchars($_POST['designation']));
	  $department = mysql_real_escape_string(htmlspecialchars($_POST['department']));
    $fromdate = mysql_real_escape_string(htmlspecialchars($_POST['fromdate']));
	  $todate = mysql_real_escape_string(htmlspecialchars($_POST['todate']));
	  $duration = mysql_real_escape_string(htmlspecialchars($_POST['duration']));
    $responsibility = mysql_real_escape_string(htmlspecialchars($_POST['responsibility']));
 
 // check that email/created fields are both filled in
 if ($name == '' || $business == '' || $address == '' || $designation == '' || $department == '' || $fromdate == '' || $todate == '' || $duration == '' || $responsibility == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $name, $business, $address, $designation, $department, $fromdate, $todate, $duration, $responsibility, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE employment SET name='$name', business='$business', address='$address', designation='$designation', department='$department', fromdate='$fromdate', todate='$todate', duration='$duration', responsibility='responsibility' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM employment WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $name = $row['name'];
 $business = $row['business'];
 $address = $row['address'];
 $designation = $row['designation'];
 $department = $row['department'];
 $fromdate = $row['fromdate'];
 $todate = $row['todate'];
 $duration = $row['duration'];
 $responsibility = $row['responsibility'];

 
 // show form
 renderForm($id, $name, $business, $address, $designation, $department, $fromdate, $todate, $duration, $responsibility, '');
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
