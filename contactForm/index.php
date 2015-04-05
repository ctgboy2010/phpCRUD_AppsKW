<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($presentAddress, $permanentAddress, $district, $homePhone, $mobile, $emergencyContact, $Email, $alternateEmail, $error)

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
<h2 align="center">Applicant Contact Details</h2> 
<table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">
<tr>
    <form action="" method="post">
    
        <div>
            <td width="32%" align='left'><strong>presentAddress: *</strong> 
          <td width="67%"><input type="text" name="presentAddress" value="<?php echo $presentAddress; ?>" /><br/></td>
         <tr><td align='left'>   
         
          <strong>permanentAddress: *</strong> </td><td><input type="text" name="permanentAddress" value="<?php echo $permanentAddress; ?>" /><br/></td></tr>
         <tr> <td align='left'><strong>district: *</strong> </td><td><select name="district"> 
        <!-- <option value="<?php echo $district; ?>" -->
         <option value='Dhaka'>Dhaka</option>
  <option value='Comilla'>Comilla</option>
   <option value='Pabna'>Pabna</option>
  <option value='Nator'>Nator</option>
   <option value='Kushtia'>Kushtia</option>
  <option value='Rajshahi'>Rajshahi</option>
  
         </select><br/></td></tr>
            
          <tr><td align='left'><strong>homePhone: *</strong></td><td> <input type="text" name="homePhone" value="<?php echo $homePhone; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>mobile: *</strong> </td><td><input type="text" name="mobile" value="<?php echo $mobile; ?>" /><br/></td>
            </tr>
          <tr><td align='left'><strong>emergencyContact: *</strong> </td><td><input type="text" name="emergencyContact" value="<?php echo $emergencyContact; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>Email ID: *</strong> </td><td><input type="text" name="Email" value="<?php echo $Email; ?>" /><br/></td></tr>
            
          <tr><td align='left'><strong>alternateEmail: *</strong> </td><td><input type="text" name="alternateEmail" value="<?php echo $alternateEmail; ?>" /><br/></td></tr>
          
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
    $presentAddress = mysql_real_escape_string(htmlspecialchars($_POST['presentAddress']));
    $permanentAddress = mysql_real_escape_string(htmlspecialchars($_POST['permanentAddress']));
	  $district = mysql_real_escape_string(htmlspecialchars($_POST['district']));
    $homePhone = mysql_real_escape_string(htmlspecialchars($_POST['homePhone']));
	  $mobile = mysql_real_escape_string(htmlspecialchars($_POST['mobile']));
    $mobile = mysql_real_escape_string(htmlspecialchars($_POST['mobile']));
	  $emergencyContact = mysql_real_escape_string(htmlspecialchars($_POST['emergencyContact']));
	  $Email = mysql_real_escape_string(htmlspecialchars($_POST['Email']));
    $alternateEmail = mysql_real_escape_string(htmlspecialchars($_POST['alternateEmail']));
	

    // check to make sure both fields are entered
    if ($presentAddress == '' || $permanentAddress == '' || $district == '' || $homePhone == '' || $mobile == '' || $emergencyContact == '' || $Email == '' || $alternateEmail == '')
    {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        renderForm($presentAddress, $permanentAddress, $district, $homePhone, $mobile, $emergencyContact, $Email, $alternateEmail, $error);
    }
    else
    {
        // save the data to the database
        mysql_query("INSERT contact SET presentAddress='$presentAddress', permanentAddress='$permanentAddress', district='$district', homePhone='$homePhone', mobile='$mobile', emergencyContact='$emergencyContact', Email='$Email', alternateEmail='$alternateEmail'")
        or die(mysql_error());

        // once saved, redirect back to the view page
        header("Location: view.php");
    }
}
else
    // if the form hasn't been submitted, display the form
{
    renderForm('','','','','','','','','');
}
?>