<?php

//Create a connection and check if connection is established
$mysqli = new mysqli("localhost", "root", "");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//Select Database or create it if doesn't exists
$db_selected = $mysqli->select_db("EmbraceDBTest");
printf($db_selected);
if(!$db_selected) {
        $mysqli->query("CREATE DATABASE EmbraceDBTest");
        printf("Created Database");
        $db_selected = $mysqli->select_db("EmbraceDBTest");
}
//Error if Database doesn't exist and cannot be created
if(!$db_selected) {
        printf("Cannot connect to Database");
        exit();
}

$check_table=$mysqli->query("SHOW TABLES LIKE userlogins");
if($check_table->num_rows<1){
        $create_table="CREATE TABLE userlogins(firstname VARCHAR(255), lastname VARCHAR(255), time VARCHAR(255))";
        $mysqli->query($create_table);
}
//Inserting into database- First name, Last name, Time.
$query = "INSERT INTO userlogins VALUES ('".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["time"]."')";
printf($query);
$mysqli->query($query);


// close connection
$mysqli->close();

?>
