<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($category, $description, $activities, $error)

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
<h2 align="center">Applicant Skills</h2> 
<table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">
<tr>
    <form action="" method="post">
    
        <div>
            <td align='left'><strong>Category: *</strong> </td><td><select name="category"> 
        <!-- <option value="<?php echo $category; ?>" -->
         <option value='ICT'>ICT</option>
                    <option value='Accounting'>Accounting</option>
                    <option value='Data Entry'>Data Entry</option>


  
         </select><br/></td></tr>
            
          <tr><td align='left'><strong>description: *</strong></td><td> <input type="text" name="description" value="<?php echo $description; ?>" /><br/></td></tr>
          <tr><td align='left'><strong>activities: *</strong> </td><td><input type="text" name="activities" value="<?php echo $activities; ?>" /><br/></td>
            </tr>
         
            
         
          
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
    
	  $category = mysql_real_escape_string(htmlspecialchars($_POST['category']));
	  $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
    $activities = mysql_real_escape_string(htmlspecialchars($_POST['activities']));
	

    // check to make sure both fields are entered
    if ($category == '' || $description == '' || $activities == '')
    {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        renderForm($category, $description, $activities, $error);
    }
    else
    {
        // save the data to the database
        mysql_query("INSERT ict SET category='$category', description='$description', activities='$activities'")
        or die(mysql_error());

        // once saved, redirect back to the view page
        header("Location: view.php");
    }
}
else
    // if the form hasn't been submitted, display the form
{
    renderForm('','','','');
}
?>