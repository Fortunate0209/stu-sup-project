<?php

$host='localhost';
$username='root';
$password='';
$db='project_db';


$connection=new mysqli($host,$username,$password,$db);
if(!$connection){
    echo "connection failed".$connection->connect_error;
}

else{
    echo "Connected successfully";
}

?>