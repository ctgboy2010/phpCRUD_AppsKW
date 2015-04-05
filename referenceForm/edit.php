<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $name, $organization, $address, $relation, $phoneOffice, $phoneHome, $mobile, $email, $error)
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

 
  <tr> <td align='left'><strong>name: *</strong> </td><td><input type="text" name="name" value="<?php echo $name; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>organization: *</strong> </td><td><input type="text" name="organization" value="<?php echo $organization; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>address: *</strong> </td><td><input type="text" name="address" value="<?php echo $address; ?>" /><br/></td></tr>
         <tr> <td align='left'> <strong>relation: *</strong> </td><td><input type="text" name="relation" value="<?php echo $relation; ?>" /><br/></td></tr>
        <tr> <td align='left'>  <strong>phoneOffice: *</strong> </td><td><input type="text" name="phoneOffice" value="<?php echo $phoneOffice; ?>" /><br/></td></tr>
            
          <tr> <td align='left'><strong>phoneHome: *</strong> </td><td><input type="text" name="phoneHome" value="<?php echo $phoneHome; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>mobile ID: *</strong></td><td> <input type="text" name="mobile" value="<?php echo $mobile; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>email: *</strong> </td><td><input type="email" name="email" value="<?php echo $email; ?>" /><br/></td></tr>
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
    $organization = mysql_real_escape_string(htmlspecialchars($_POST['organization']));
	  $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
    $relation = mysql_real_escape_string(htmlspecialchars($_POST['relation']));
	  $phoneOffice = mysql_real_escape_string(htmlspecialchars($_POST['phoneOffice']));
    $phoneOffice = mysql_real_escape_string(htmlspecialchars($_POST['phoneOffice']));
	  $phoneHome = mysql_real_escape_string(htmlspecialchars($_POST['phoneHome']));
	  $mobile = mysql_real_escape_string(htmlspecialchars($_POST['mobile']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 
 // check that email/created fields are both filled in
 if ($name == '' || $organization == '' || $address == '' || $relation == '' || $phoneOffice == '' || $phoneHome == '' || $mobile == '' || $email == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $name, $organization, $address, $relation, $phoneOffice, $phoneHome, $mobile, $email, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE reference SET name='$name', organization='$organization', address='$address', relation='$relation', phoneOffice='$phoneOffice', phoneHome='$phoneHome', mobile='$mobile', email='$email' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM reference WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $name = $row['name'];
 $organization = $row['organization'];
 $address = $row['address'];
 $relation = $row['relation'];
 $phoneOffice = $row['phoneOffice'];
 $phoneHome = $row['phoneHome'];
 $mobile = $row['mobile'];
 $email = $row['email'];

 
 // show form
 renderForm($id, $name, $organization, $address, $relation, $phoneOffice, $phoneHome, $mobile, $email, '');
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
