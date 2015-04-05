<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($level, $exam, $subject, $institute, $type, $result, $scale, $year, $duration, $achivement, $error)

//function renderForm($Email, $mobile, $error)
{
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>
    <head>
        <title>New Record</title>
    </head>
    <body>
    <?php
    // if there are any errors, display them
    if ($error != '')
    {
        echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
    }
    ?>

 <div class='formbox'>
    <div align="center"><a href="../index.html"> Home </a>|<a href="index.php"> Registration </a>| <a href="view.php">List </a>|  
    </div>
</div>
<h2 align="center">Add Academic Information</h2> 
<table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">

    <form action="" method="post">
    
        <div>
           
           
         
         <tr>
        <td align='left'><strong>level of Education: *</strong></td>
      <td colspan="2">
      <input type="radio" name="level" value="Diploma" id="Diploma" />Diploma
      <input type="radio" name="level" value="SSC" id="SSC" />SSC
      <input type="radio" name="level" value="HSC" id="HSC" />HSC
      <input type="radio" name="level" value="Hons" id="Hons" />Hons
      
      </td>  </tr>
         
        <tr>  <td align='left'><strong>exam Title: *</strong> </td><td><input type="text" name="exam" value="<?php echo $exam; ?>" /><br/></td></tr>
        <tr>  <td align='left'><strong>Subject: *</strong> </td><td><input type="text" name="subject" value="<?php echo $subject; ?>" /><br/></td></tr>
         </td></tr>
         
          <tr> <td align='left'><strong>Institute: *</strong> </td><td><select name="institute"> 
        <!-- <option value="<?php echo $institute; ?>" -->
         <option value=''>Select</option>
  <option value='IUB'>IUB</option>
  <option value='DU'>DU</option>
  <option value='BUET'>BUET</option>
 
   
  
         </select><br/></td></tr>
            
          
         
            
             <tr> <td align='left'><strong>Result Type: *</strong> </td><td><select name="type"> 
        <!-- <option value="<?php echo $type; ?>" -->
         <option value=''>Select</option>
  <option value='Grade'>Grade</option>
   <option value='Division'>Division</option>
   
  
         </select><br/></td></tr>
          
          <tr>
        <td align='left'><strong>Result: *</strong></td><td><input type="text" name="result" value="<?php echo $result; ?>" /><br/></td></tr>
      
          
          <tr><td align='left'><strong>Scale: *</strong> </td><td><input type="text" name="scale" default value="4.00" value="<?php echo $scale; ?>" /><br/></td></tr>
            
          <tr><td align='left'><strong>Passing year: *</strong> </td><td><input type="text" name="year" value="<?php echo $year; ?>" /><br/></td></tr>
          <tr> <td align='left'><strong>duration: *</strong> </td><td><select name="duration"> 
        <!-- <option value="<?php echo $duration; ?>" -->
         <option value=''>Select</option>
         <option value='1'>1 Year</option>
  <option value='2'>2 Years</option>
   <option value='3'>3 Years</option>
   <option value='4'>4 Years</option>
  
         </select><br/></td></tr>
         <tr><td align='left'><strong>achivement: *</strong> </td><td><input type="text" name="achivement" value="<?php echo $achivement; ?>" /><br/></td></tr>
          
<tr> <td height="68" colspan="2" align="center">
            <p>* required Fields</p>
            <input type="submit" name="submit" value="Submit">
        </div>
        
    </form>
   
    </tr>
    </table>
    </body>
    </html>
<?php
}




// connect to the database
include('connect-db.php');

// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit']))
{
    // get form data, making sure it is valid
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
   

    // check to make sure both fields are entered
    if ($level == '' || $exam == '' || $subject == '' || $institute == '' || $type == '' || $result == '' || $scale == '' || $year == ''|| $duration == ''|| $achivement == '')
    {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        renderForm($level, $exam, $subject, $institute, $type, $result, $scale, $year, $duration, $achivement, $error);
    }
    else
    {
        // save the data to the database
        mysql_query("INSERT academic SET level='$level', exam='$exam', subject='$subject', institute='$institute', type='$type', result='$result', scale='$scale', year='$year', duration='$duration', achivement='$achivement'")
        or die(mysql_error());

        // once saved, redirect back to the view page
        header("Location: view.php");
    }
}
else
    // if the form hasn't been submitted, display the form
{
    renderForm('','','','','','','','','','','');
}
?>