<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $name, $father, $mother, $gender, $religion, $dob, $nationality, $nid, $birth, $passport, $error)
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
            
         <tr> <td align='left'> <strong>father: *</strong> </td><td><input type="text" name="father" value="<?php echo $father; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>mother: *</strong> </td><td><input type="text" name="mother" value="<?php echo $mother; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>gender: *</strong> </td><td><input type="text" name="gender" value="<?php echo $gender; ?>" /><br/></td></tr>
        <tr> <td align='left'>  <strong>religion: *</strong> </td><td><input type="text" name="religion" value="<?php echo $religion; ?>" /><br/></td></tr>
            
          <tr> <td align='left'><strong>dob: *</strong> </td><td><input type="text" name="dob" value="<?php echo $dob; ?>" />
                yyyy-mm-dd<br/></td></tr>
          <tr> <td align='left'><strong>nationality ID: *</strong></td><td> <input type="text" name="nationality" value="<?php echo $nationality; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>nid: *</strong> </td><td><input type="text" name="nid" value="<?php echo $nid; ?>" /><br/></td></tr>
          <tr> <td align='left'> <strong>birth: *</strong> </td>
              <td><input type="text" name="birth" value="<?php echo $birth; ?>" /><br/></td></tr>
           <tr> <td align='left'> <strong>passport: *</strong> </td>
               <td><input type="text" name="passport" value="<?php echo $passport; ?>" /><br/></td></tr>
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
    $father = mysql_real_escape_string(htmlspecialchars($_POST['father']));
	  $mother = mysql_real_escape_string(htmlspecialchars($_POST['mother']));
    $gender = mysql_real_escape_string(htmlspecialchars($_POST['gender']));
	  $religion = mysql_real_escape_string(htmlspecialchars($_POST['religion']));
    $religion = mysql_real_escape_string(htmlspecialchars($_POST['religion']));
	  $dob = mysql_real_escape_string(htmlspecialchars($_POST['dob']));
	  $nationality = mysql_real_escape_string(htmlspecialchars($_POST['nationality']));
    $nid = mysql_real_escape_string(htmlspecialchars($_POST['nid']));
	
$birth = mysql_real_escape_string(htmlspecialchars($_POST['birth']));
    $passport = mysql_real_escape_string(htmlspecialchars($_POST['passport']));
 
 // check that email/created fields are both filled in
 if ($name == '' || $father == '' || $mother == '' || $gender == '' || $religion == '' || $dob == '' || $nationality == '' || $nid == ''|| $birth == '' || $passport == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $name, $father, $mother, $gender, $religion, $dob, $nationality, $nid, $birth, $passport, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE personal SET name='$name', father='$father', mother='$mother', gender='$gender', religion='$religion', dob='$dob', nationality='$nationality', nid='$nid', birth='$birth', passport='$passport' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM personal WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $name = $row['name'];
 $father = $row['father'];
 $mother = $row['mother'];
 $gender = $row['gender'];
 $religion = $row['religion'];
 $dob = $row['dob'];
 $nationality = $row['nationality'];
 $nid = $row['nid'];
 $birth = $row['birth'];
 $passport = $row['passport'];

 
 // show form
 renderForm($id, $name, $father, $mother, $gender, $religion, $dob, $nationality, $birth, $passport, $nid, '');
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
