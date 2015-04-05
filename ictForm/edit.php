<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $category, $description, $activities, $error)
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
<h2 align="center">Applicant Skills Edit</h2> 

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

 
          <tr> <td align='left'><strong>Category: *</strong> </td><td><select id="category" name="category" /><br/>
          
          <option value="" selected="selected">Select category</option> 


 		<option <?php if ($category == 'ICT' ) echo 'selected'; ?> value="ICT">ICT</option>
            <option <?php if ($category == 'Accounting' ) echo 'selected'; ?> value="Accounting">Accounting</option>
            <option <?php if ($category == 'Data Entry' ) echo 'selected'; ?> value="Data Entry">Data Entry</option>
  
 
  
  
            
		</select>
            
         <tr> <td align='left'> <strong>description: *</strong> </td><td><input type="text" name="description" value="<?php echo $description; ?>" /><br/></td></tr>
        <tr> <td align='left'>  <strong>activities: *</strong> </td><td><input type="text" name="activities" value="<?php echo $activities; ?>" /><br/></td></tr>
            
          
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

 
    $category = mysql_real_escape_string(htmlspecialchars($_POST['category']));
    $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
	  $activities = mysql_real_escape_string(htmlspecialchars($_POST['activities']));
 
 
 // check that email/created fields are both filled in
 if ($category == '' || $description == '' || $activities == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $category, $description, $district, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE ict SET category='$category', description='$description', activities='$activities' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM ict WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $category = $row['category'];
 $description = $row['description'];
 $activities = $row['activities'];
 

 
 // show form
 renderForm($id, $category, $description, $activities, '');
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
