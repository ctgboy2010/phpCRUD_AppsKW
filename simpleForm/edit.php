<?php
/**
 * Created by PhpStorm.
 * User: lict
 * Date: 12/22/14
 * Time: 3:54 PM
 */


$link = mysqli_connect("localhost",
    "root",
    "lict@2",
    "students");

$query = "select * from users;";

$result = mysqli_query($link, $query);


//while( $row = mysqli_fetch_assoc($result) ){
//    print_r($row);
//}

//alternative way


    //print_r($row);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Information Form</title>
</head>
<body>
<form action="list.php?id=<?php echo $_GET['id'] ?>" method="post">
    <input type="hidden" id="id" value="<?php echo $id ?>" />
    <label>First Name: </label>
    <input type="text" name="firstName" title="Enter the First Name" value="<?php echo $rows['firstName']?>" required />
    
    <label>Last Name: </label>
    <input type="text" name="lastName" title="Enter the Last Name" value="<?php echo $rows['lastName']?>" required />
    
    <label>Phone Number: </label>
    <input type="text" name="phoneNumber" title="Enter the phone number" value="<?php echo $rows['phoneNumber']?>" required />
    
    
    <input type="submit" value="Update" name="update" />
</form>
<br />
<a href="list.php"><b>Goto List</b></a>
</body>
</html>


