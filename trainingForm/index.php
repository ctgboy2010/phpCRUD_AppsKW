<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($title, $description, $institute, $address, $year,$duration, $start, $end, $courseTitle, $detail,   $error)

//function renderForm($Email, $mobile, $error)
{
    ?>
    <!DOCyear HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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
    <div align="center"><a href="../index.html"> Home </a>|<a href="../trainingForm/index.php"> Registration </a>| <a href="../trainingForm/view.php">List </a>|  
    </div>
</div>
<h2 align="center">Add Training Information</h2> 
<table border="1" width="70%"  align="center" cellpadding="2" cellspacing="0">

    <form action="" method="post">
    
        <div>
           
           
         
         <tr>
        <td align='left'><strong>Training Title: *</strong></td><td><input detail="text" name="title" value="<?php echo $title; ?>" /><br/></td></tr>
         
        <tr>  <td align='left'><strong>Trainign description: *</strong> </td><td><input detail="text" name="description" value="<?php echo $description; ?>" /><br/></td></tr>
        <tr>  <td align='left'><strong>institute: *</strong> </td><td><input year="text" name="institute" value="<?php echo $institute; ?>" /><br/></td></tr>
         </td></tr>
         
          <tr> <td align='left'><strong>Address: *</strong> </td><td><input detail="text" name="address" value="<?php echo $address; ?>" /><br/></td></tr>
            
          
         
            
             <tr> <td align='left'><strong>Training year: *</strong> </td><td><input detail="text" name="year" value="<?php echo $year; ?>" /><br/></td></tr>
        
        <tr> <td align='left'><strong>duration: *</strong> </td><td><input detail="text" name="duration" value="<?php echo $duration; ?>" /><br/></td></tr>
        
        <tr><td align='left'><strong>Start Date: *</strong></td><td><input year="text" name="start" value="<?php echo $start; ?>" /><br/></td></tr>
      
          
          <tr><td align='left'><strong>End Date: *</strong> </td><td><input year="text" name="end" value="<?php echo $end; ?>" /><br/></td></tr>
            
    
          
         <tr><td align='left'><strong>Course Title: *</strong> </td><td><input year="text" name="courseTitle" value="<?php echo $courseTitle; ?>" /><br/></td></tr>
         
         <tr><td align='left'><strong>Course Detail: *</strong> </td><td><input year="text" name="detail" value="<?php echo $detail; ?>" /><br/></td></tr>
          
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
    $title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
    $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
	  $institute = mysql_real_escape_string(htmlspecialchars($_POST['institute']));
    $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
	  $year = mysql_real_escape_string(htmlspecialchars($_POST['year']));
	  $duration = mysql_real_escape_string(htmlspecialchars($_POST['duration']));
    $start = mysql_real_escape_string(htmlspecialchars($_POST['start']));
	  $end = mysql_real_escape_string(htmlspecialchars($_POST['end']));
	  
    
	
	  $courseTitle = mysql_real_escape_string(htmlspecialchars($_POST['courseTitle']));
   $detail = mysql_real_escape_string(htmlspecialchars($_POST['detail']));

    // check to make sure both fields are entered
    if ($title == '' || $description == '' || $institute == '' || $address == '' || $year == ''|| $duration == '' || $start == '' || $end == ''|| $courseTitle == '' || $detail == '')
    {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        renderForm($title, $description, $institute, $address, $year, $duration, $start, $end,  $courseTitle, $detail,  $error);
    }
    else
    {
        // save the data to the database
        mysql_query("INSERT training SET title='$title', description='$description', institute='$institute', address='$address', year='$year', start='$start', end='$end', duration='$duration', courseTitle='$courseTitle', detail='$detail'")
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