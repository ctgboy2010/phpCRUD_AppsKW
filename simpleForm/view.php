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

//$query = "select * from users;";
$query = "SELECT FROM `students`.`users` WHERE `users`.`id` = $id";


$result = mysqli_query($link, $query);


//while( $row = mysqli_fetch_assoc($result) ){
//    print_r($row);
//}

//alternative way


//print_r($row);

?>


<table border="1" width="70%">
    <tr>
        <td>ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Phone Number</td>

    </tr>
    <?php
 
    foreach($result as $row){
       ?>

        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['firstName']?></td>
            <td><?php echo $row['lastName']?></td>
            <td><?php echo $row['phoneNumber']?></td>

        </tr>

    <?php
    }
    ?>

</table>



