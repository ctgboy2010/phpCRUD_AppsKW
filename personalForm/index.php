<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($name, $father, $mother, $gender, $religion, $dob, $nationality, $nid, $birth, $passport, $error)

//function renderForm($nationality, $religion, $error)
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
<h2 align="center">Applicant Personal Information</h2> 
<table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">
<tr>
    <form action="" method="post">
    
        <div>
            <td width="32%" align='left'><strong>name: *</strong> 
          <td width="67%"><input type="text" name="name" value="<?php echo $name; ?>" /><br/></td>
         <tr><td align='left'>   
         
          <strong>father: *</strong> </td><td><input type="text" name="father" value="<?php echo $father; ?>" /><br/></td></tr>
         <tr> <td align='left'><strong>mother: *</strong> </td><td><input type="text" name="mother" value="<?php echo $mother; ?>" /><br/></td></tr> 
       
            
          <tr><td align='left'><strong>gender: *</strong></td><td> <input type="text" name="gender" value="<?php echo $gender; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>religion: *</strong> </td><td><input type="text" name="religion" value="<?php echo $religion; ?>" /><br/></td>
            </tr>
          <tr><td align='left'><strong>dob: *</strong> </td><td><input type="text" name="dob" value="<?php echo $dob; ?>" />
          yyyy-mm-dd<br/></td></tr>
          <tr><td align='left'><strong>nationality ID: *</strong> </td><td><input type="text" name="nationality" value="<?php echo $nationality; ?>" /><br/></td></tr>
            
          <tr><td align='left'><strong>nid: *</strong> </td><td><input type="text" name="nid" value="<?php echo $nid; ?>" /><br/></td></tr>
           <tr><td align='left'><strong>birth ID: *</strong> </td><td><input type="text" name="birth" value="<?php echo $birth; ?>" /><br/></td></tr>
            
          <tr><td align='left'><strong>passport: *</strong> </td><td><input type="text" name="passport" value="<?php echo $passport; ?>" /><br/></td></tr>
          
          
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
    $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
    $father = mysql_real_escape_string(htmlspecialchars($_POST['father']));
	  $mother = mysql_real_escape_string(htmlspecialchars($_POST['mother']));
    $gender = mysql_real_escape_string(htmlspecialchars($_POST['gender']));
	  $religion = mysql_real_escape_string(htmlspecialchars($_POST['religion']));
    
	  $dob = mysql_real_escape_string(htmlspecialchars($_POST['dob']));
	  $nationality = mysql_real_escape_string(htmlspecialchars($_POST['nationality']));
    $nid = mysql_real_escape_string(htmlspecialchars($_POST['nid']));
	$birth = mysql_real_escape_string(htmlspecialchars($_POST['birth']));
    $passport = mysql_real_escape_string(htmlspecialchars($_POST['passport']));
	

    // check to make sure both fields are entered
    if ($name == '' || $father == '' || $mother == '' || $gender == '' || $religion == '' || $dob == '' || $nationality == '' || $nid == '' || $birth == '' || $passport == '')
    {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        renderForm($name, $father, $mother, $gender, $religion, $dob, $nationality, $nid, $birth, $passport, $error);
    }
    else
    {
        // save the data to the database
        mysql_query("INSERT personal SET name='$name', father='$father', mother='$mother', gender='$gender', religion='$religion', dob='$dob', nationality='$nationality', nid='$nid', birth='$birth', passport='$passport'")
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