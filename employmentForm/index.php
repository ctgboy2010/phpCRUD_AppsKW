<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($name, $business, $address, $designation, $department, $fromdate, $todate, $duration, $responsibility, $error)

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
<h2 align="center">Employment Details</h2> 
<table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">

    <form action="" method="post">
    
        <div>
           <tr> <td width="32%" align='left'><strong>Company Name: *</strong></td> <td width="67%"><input type="text" name="name" value="<?php echo $name; ?>" /><br/></td></tr>  
         
          <td align='left'> <strong>Company Business: *</strong> </td><td><input type="text" name="business" value="<?php echo $business; ?>" /><br/></td></tr>
         <tr> <td align='left'><strong>Address: *</strong> </td><td><input type="text" name="address" value="<?php echo $address; ?>" /><br/></td></tr>
       
            
          <tr><td align='left'><strong>Designation: *</strong></td><td> <input type="text" name="designation" value="<?php echo $designation; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>Department: *</strong> </td><td><input type="text" name="department" value="<?php echo $department; ?>" /><br/></td>
            </tr>
          <tr><td align='left'><strong>From Date: *</strong> </td><td><input type="text" name="fromdate" value="<?php echo $fromdate; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>To Date: *</strong> </td><td><input type="text" name="todate" value="<?php echo $todate; ?>" /><br/></td></tr>
            
          <tr><td align='left'><strong>Duration: *</strong> </td><td><input type="text" name="duration" value="<?php echo $duration; ?>" /><br/></td></tr>
          
          <tr><td align='left'><strong>Responsibility: *</strong> </td><td><input type="text" name="responsibility" value="<?php echo $responsibility; ?>" /><br/></td></tr>
          
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
    $business = mysql_real_escape_string(htmlspecialchars($_POST['business']));
	  $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
    $designation = mysql_real_escape_string(htmlspecialchars($_POST['designation']));
	  $department = mysql_real_escape_string(htmlspecialchars($_POST['department']));
    $fromdate = mysql_real_escape_string(htmlspecialchars($_POST['fromdate']));
	  $todate = mysql_real_escape_string(htmlspecialchars($_POST['todate']));
	  $duration = mysql_real_escape_string(htmlspecialchars($_POST['duration']));
    $responsibility = mysql_real_escape_string(htmlspecialchars($_POST['responsibility']));
	

    // check to make sure both fields are entered
    if ($name == '' || $business == '' || $address == '' || $designation == '' || $department == '' || $fromdate == '' || $todate == '' || $duration == '' ||$responsibility == '')
    {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        renderForm($name, $business, $address, $designation, $department, $fromdate, $todate, $duration, $responsibility, $error);
    }
    else
    {
        // save the data to the database
        mysql_query("INSERT employment SET name='$name', business='$business', address='$address', designation='$designation', department='$department', fromdate='$fromdate', todate='$todate', duration='$duration', responsibility='$responsibility'")
        or die(mysql_error());

        // once saved, redirect back to the view page
        header("Location: view.php");
    }
}
else
    // if the form hasn't been submitted, display the form
{
    renderForm('','','','','','','','','','');
}
?>