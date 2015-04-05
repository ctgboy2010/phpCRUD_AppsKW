<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $presentAddress, $permanentAddress, $district, $homePhone, $mobile, $emergencyContact, $Email, $alternateEmail, $error)
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

 
  <tr> <td align='left'><strong>presentAddress: *</strong> </td><td><input type="text" name="presentAddress" value="<?php echo $presentAddress; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>permanentAddress: *</strong> </td><td><input type="text" name="permanentAddress" value="<?php echo $permanentAddress; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>district: *</strong> </td><td><select id="district" name="district" /><br/>
          
          <option value="" selected="selected">Select District</option> 


 		<option <?php if ($district == 'Dhaka' ) echo 'selected'; ?> value="Dhaka">Dhaka</option>
            <option <?php if ($district == 'Comilla' ) echo 'selected'; ?> value="Comilla">Comilla</option>
            
             <option <?php if ($district == 'Pabna' ) echo 'selected'; ?> value='Pabna'>Pabna</option>
  <option <?php if ($district == 'Nator' ) echo 'selected'; ?> value='Nator'>Nator</option>
   <option <?php if ($district == 'Kushtia' ) echo 'selected'; ?> value='Kushtia'>Kushtia</option>
  <option <?php if ($district == 'Rajshahi' ) echo 'selected'; ?> value='Rajshahi'>Rajshahi</option>
  
 
  
  
            
		</select>
            
         <tr> <td align='left'> <strong>homePhone: *</strong> </td><td><input type="text" name="homePhone" value="<?php echo $homePhone; ?>" /><br/></td></tr>
        <tr> <td align='left'>  <strong>mobile: *</strong> </td><td><input type="text" name="mobile" value="<?php echo $mobile; ?>" /><br/></td></tr>
            
          <tr> <td align='left'><strong>emergencyContact: *</strong> </td><td><input type="text" name="emergencyContact" value="<?php echo $emergencyContact; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>Email ID: *</strong></td><td> <input type="text" name="Email" value="<?php echo $Email; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>alternateEmail: *</strong> </td><td><input type="text" name="alternateEmail" value="<?php echo $alternateEmail; ?>" /><br/></td></tr>
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

 
    $presentAddress = mysql_real_escape_string(htmlspecialchars($_POST['presentAddress']));
    $permanentAddress = mysql_real_escape_string(htmlspecialchars($_POST['permanentAddress']));
	  $district = mysql_real_escape_string(htmlspecialchars($_POST['district']));
    $homePhone = mysql_real_escape_string(htmlspecialchars($_POST['homePhone']));
	  $mobile = mysql_real_escape_string(htmlspecialchars($_POST['mobile']));
    $mobile = mysql_real_escape_string(htmlspecialchars($_POST['mobile']));
	  $emergencyContact = mysql_real_escape_string(htmlspecialchars($_POST['emergencyContact']));
	  $Email = mysql_real_escape_string(htmlspecialchars($_POST['Email']));
    $alternateEmail = mysql_real_escape_string(htmlspecialchars($_POST['alternateEmail']));
 
 // check that email/created fields are both filled in
 if ($presentAddress == '' || $permanentAddress == '' || $district == '' || $homePhone == '' || $mobile == '' || $emergencyContact == '' || $Email == '' || $alternateEmail == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $presentAddress, $permanentAddress, $district, $homePhone, $mobile, $emergencyContact, $Email, $alternateEmail, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE contact SET presentAddress='$presentAddress', permanentAddress='$permanentAddress', district='$district', homePhone='$homePhone', mobile='$mobile', emergencyContact='$emergencyContact', Email='$Email', alternateEmail='$alternateEmail' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM contact WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $presentAddress = $row['presentAddress'];
 $permanentAddress = $row['permanentAddress'];
 $district = $row['district'];
 $homePhone = $row['homePhone'];
 $mobile = $row['mobile'];
 $emergencyContact = $row['emergencyContact'];
 $Email = $row['Email'];
 $alternateEmail = $row['alternateEmail'];

 
 // show form
 renderForm($id, $presentAddress, $permanentAddress, $district, $homePhone, $mobile, $emergencyContact, $Email, $alternateEmail, '');
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
