<?php

$firstName = $_POST['firstName'];
$lastName  = $_POST['lastName'];
$phoneNumber  = $_POST['phoneNumber'];

$link = mysqli_connect("localhost",
                        "root",
                        "lict@2",
                        "students");

$query = "INSERT INTO `students`.`users` (
`firstName` ,
`lastName` ,
`phoneNumber`

)
VALUES (
    '$firstName', '$lastName', '$phoneNumber'
)";

mysqli_query($link, $query);

header('location:list.php');
