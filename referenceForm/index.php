<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($name, $organization, $address, $relation, $phoneOffice, $phoneHome, $mobile, $email, $error)

//function renderForm($mobile, $phoneOffice, $error)
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
<h2 align="center">Refference Details</h2> 
<table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">
<tr>
    <form action="" method="post">
    
        <div>
            <td width="32%" align='left'><strong>name: *</strong> 
          <td width="67%"><input type="text" name="name" value="<?php echo $name; ?>" /><br/></td>
         <tr><td align='left'>   
         
          <strong>organization: *</strong> </td><td><input type="text" name="organization" value="<?php echo $organization; ?>" /><br/></td></tr>
         <tr> <td align='left'><strong>address: *</strong> </td><td><input type="text" name="address" value="<?php echo $address; ?>" /><br/></td></tr> 
       
            
          <tr><td align='left'><strong>relation: *</strong></td><td> <input type="text" name="relation" value="<?php echo $relation; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>phoneOffice: *</strong> </td><td><input type="text" name="phoneOffice" value="<?php echo $phoneOffice; ?>" /><br/></td>
            </tr>
          <tr><td align='left'><strong>phoneHome: *</strong> </td><td><input type="text" name="phoneHome" value="<?php echo $phoneHome; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>mobile ID: *</strong> </td><td><input type="text" name="mobile" value="<?php echo $mobile; ?>" /><br/></td></tr>
            
          <tr><td align='left'><strong>email: *</strong> </td><td><input type="email" name="email" value="<?php echo $email; ?>" /><br/></td></tr>
          
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
    $organization = mysql_real_escape_string(htmlspecialchars($_POST['organization']));
	  $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
    $relation = mysql_real_escape_string(htmlspecialchars($_POST['relation']));
	  $phoneOffice = mysql_real_escape_string(htmlspecialchars($_POST['phoneOffice']));
    
	  $phoneHome = mysql_real_escape_string(htmlspecialchars($_POST['phoneHome']));
	  $mobile = mysql_real_escape_string(htmlspecialchars($_POST['mobile']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	

    // check to make sure both fields are entered
    if ($name == '' || $organization == '' || $address == '' || $relation == '' || $phoneOffice == '' || $phoneHome == '' || $mobile == '' || $email == '')
    {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        renderForm($name, $organization, $address, $relation, $phoneOffice, $phoneHome, $mobile, $email, $error);
    }
    else
    {
        // save the data to the database
        mysql_query("INSERT reference SET name='$name', organization='$organization', address='$address', relation='$relation', phoneOffice='$phoneOffice', phoneHome='$phoneHome', mobile='$mobile', email='$email'")
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