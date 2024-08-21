<?php

require 'connection.php';
session_start();


if(isset($_POST['submit'])){
    echo '<div>processing</div>';
// print_r($_POST);

$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$email=$_POST['email'];
$password=$_POST['password'];

$query= "SELECT * FROM `supervisors_table` WHERE email=? ";
$prepare=$connection->prepare($query);
$prepare -> bind_param('s', $email);
$execute=$prepare->execute();

if($execute){
    // print_r($prepare);
    $user=$prepare->get_result();

    if($user->num_rows>0){
        $_SESSION['msg']='Email exist';
        echo "email existed";
    }
    else{
        $hassedpass=password_hash($password, PASSWORD_DEFAULT);
        $query= "INSERT INTO `supervisors_table`(`firstName`,`lastName`, `email`, `password`) VALUES (?,?,?,?)";
        $prepare=$connection->prepare($query);
        $prepare->bind_param('ssss', $fname,$lname,$email,$hassedpass);
        $execute=$prepare->execute();

        if($execute){
            echo "inserted";
            header('location:supervisorsignin.php');
        }
        else {
            echo"code not ran";
        }
    }
}
else{
    echo "code not executed";
}


}

?>
