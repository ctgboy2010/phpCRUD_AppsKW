<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $level, $exam, $subject, $institute, $type, $result, $scale, $year, $duration, $achivement, $error)
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
<h2 align="center">Applicant Academic Edit</h2> 

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
        <td align='left'><strong>level of Education: *</strong></td>
        <td colspan="2">
        <input type="radio" name="level" value="Diploma" <?php echo($level == 'Diploma') ? 'checked' : ''; ?> />Diploma
        <input type="radio" name="level" value="SSC" <?php echo($level == 'SSC') ? 'checked' : ''; ?> />SSC
        <input type="radio" name="level" value="HSC" <?php echo($level == 'HSC') ? 'checked' : ''; ?> />HSC
        <input type="radio" name="level" value="Hons" <?php echo($level == 'Hons') ? 'checked' : ''; ?> />Hons
           </td>  </tr>
  
  
 
            
         <tr> <td align='left'> <strong>exam: *</strong> </td><td><input type="text" name="exam" value="<?php echo $exam; ?>" /><br/></td></tr>
          <tr> <td align='left'> <strong>Subject: *</strong> </td><td><input type="text" name="subject" value="<?php echo $subject; ?>" /><br/></td></tr>
         
         
         
          
         
          <tr> <td align='left'><strong>institute: *</strong> </td><td><select id="institute" name="institute" /><br/>
          
          <option value="" selected="selected">Select institute</option> 


 		<option <?php if ($institute == 'IUB' ) echo 'selected'; ?> value="IUB">IUB</option>
        <option <?php if ($institute == 'DU' ) echo 'selected'; ?> value="IUB">DU</option>
        <option <?php if ($institute == 'BUET' ) echo 'selected'; ?> value="BUET">BUET</option>
      
  
            
		</select>
            
         
       
          
          
          <tr> <td align='left'><strong>type: *</strong> </td><td><select id="type" name="type" /><br/>
          
          <option value="" selected="selected">Select Type</option> 


 		<option <?php if ($type == 'Grade' ) echo 'selected'; ?> value="Grade">Grade</option>
        	<option <?php if ($type == 'Division' ) echo 'selected'; ?> value="Division">Division</option>
      
  
            
		</select>
        
    
          <tr> <td align='left'><strong>result: *</strong></td><td> <input type="text" name="result" value="<?php echo $result; ?>" /><br/></td></tr>
            
         <tr> <td align='left'> <strong>scale: *</strong> </td><td><input type="text" name="scale" value="<?php echo $scale; ?>" /><br/></td></tr>
         
         <tr> <td align='left'> <strong>year: *</strong> </td><td><input type="text" name="year" value="<?php echo $year; ?>" /><br/></td></tr>
         
         
         
         
          <tr> <td align='left'><strong>Duration: *</strong> </td><td><select id="duration" name="duration" /><br/>
          
          <option value="" selected="selected">Select Duration</option> 


 		<option <?php if ($duration == '1' ) echo 'selected'; ?> value="1">1 Year</option>
        <option <?php if ($duration == '2' ) echo 'selected'; ?> value="2">2 Years</option>
        <option <?php if ($duration == '3' ) echo 'selected'; ?> value="3">3 Years</option>
        <option <?php if ($duration == '4' ) echo 'selected'; ?> value="4">4 Years</option>
      
  
            
		</select>
        </tr>
        
         <tr> <td align='left'> <strong>achivement: *</strong> </td><td><input type="text" name="achivement" value="<?php echo $achivement; ?>" /><br/></td></tr>
         
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

 
    $level = mysql_real_escape_string(htmlspecialchars($_POST['level']));
    $exam = mysql_real_escape_string(htmlspecialchars($_POST['exam']));
	  $subject = mysql_real_escape_string(htmlspecialchars($_POST['subject']));
    $institute = mysql_real_escape_string(htmlspecialchars($_POST['institute']));
	 
   
	  $type = mysql_real_escape_string(htmlspecialchars($_POST['type']));
	  $result = mysql_real_escape_string(htmlspecialchars($_POST['result']));
    $scale = mysql_real_escape_string(htmlspecialchars($_POST['scale']));
	 $year = mysql_real_escape_string(htmlspecialchars($_POST['year']));
	  $duration = mysql_real_escape_string(htmlspecialchars($_POST['duration']));
	   $achivement = mysql_real_escape_string(htmlspecialchars($_POST['achivement']));
 
 // check that result/created fields are both filled in
 if ($level == '' || $exam == '' || $subject == '' || $institute == '' || $type == '' || $result == '' || $scale == ''|| $year == ''|| $duration == ''|| $achivement == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $level, $exam, $subject, $institute, $type, $result, $scale, $year, $duration, $achivement, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE academic SET level='$level', exam='$exam', subject='$subject', institute='$institute', type='$type', result='$result', scale='$scale', year='$year', duration='$duration', achivement='$achivement' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM academic WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $level = $row['level'];
 $exam = $row['exam'];
 $subject = $row['subject'];
 $institute = $row['institute'];
 
 $type = $row['type'];
 $result = $row['result'];
 $scale = $row['scale'];
 $year = $row['year'];
 $duration = $row['duration'];
 $achivement = $row['achivement'];
 

 
 // show form
 renderForm($id, $level, $exam, $subject, $institute, $type, $result, $scale, $year, $duration, $achivement, '');
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
