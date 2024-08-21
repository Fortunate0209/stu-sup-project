<?php 
require 'connection.php';
session_start();


if(isset($_POST['submit'])){
    echo '<div>processing</div>';
// print_r($_POST);

$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$username=$_POST['username'];
$department=$_POST['department'];
$email=$_POST['email'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$phone=$_POST['phonenumber'];

    $query="SELECT * FROM `student_table` WHERE email=?";
    $prepare=$connection->prepare($query);
    $prepare->bind_param('s', $email);
    $execute=$prepare->execute();

    if($execute){
        // print_r($prepare);
        $student=$prepare->get_result();

        if($student->num_rows>0){
            echo"email exited";
        }
        else{
            $hassedpass=password_hash($password, PASSWORD_DEFAULT);
            $supervisor_id = 5;
            $query="INSERT INTO `student_table`(`supervisor_id`,`firstName`, `lastName`, `username`,`department`, `email`, `password`, `gender`, `phonenumber`) VALUES (?,?,?,?,?,?,?,?,?)";
            $prepare=$connection->prepare($query);
            print_r($prepare);
            $prepare->bind_param('isssssssi', $supervisor_id, $fname, $lname, $username, $department, $email, $hassedpass, $gender, $phone);
            $execute=$prepare->execute();

            if($execute){
                header('location:studentsignin.php');
                echo "inserted";
            }
            else{
                echo "failed".$connection->error;
            }
        }
    }
}

?>