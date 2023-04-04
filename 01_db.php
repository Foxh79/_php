<?php

include 'form.php'; 

//connection string constants
define('_HOST', 'localhost');
define('_USERNAME', 'root');
define('_PASS', '');
define('DB_NAME', 'Maseno');

//connect to and select database of focus
$conn = new mysqli(_HOST, _USERNAME, _PASS, DB_NAME);

//check connection
if ($conn->connect_error) {
    die('Connection failed' . $conn->connect_error);
}
echo 'CONNECTED';

//create table
mysqli_query($conn, "CREATE TABLE STUDENT(name varchar(255), regNo varchar(255), age int(255),
     primary key(regNo)");

//insert data into the table
mysqli_query($conn, "INSERT INTO STUDENT(name, regNo, age)
     VALUES('Boniface Mwau','CI/00167/017', 25)");

//close database engine
mysqli_close($conn);
