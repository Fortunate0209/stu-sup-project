<?php
require 'connection.php';
session_start();

if(isset($_POST['submit'])){
    echo '<div>processing</div>';
    // print_r($_POST);

    $email=$_POST['email'];
    $password=$_POST['password'];

    $query="SELECT * FROM `student_table` WHERE email=?";
    $prepare=$connection->prepare($query);
    $prepare->bind_param('s', $email);
    $execute=$prepare->execute();
    $student=$prepare->get_result();

    if($student){
        if($student->num_rows>0){
            $user=$student->fetch_assoc();
            print_r($user);

            $hassedpass=$user['password'];
            $password_verify=password_verify($password,$hassedpass);

            if($password_verify){
                $_SESSION['stu_id']=$user['student_id'];
                header('location:student-dash.php');
                // echo '$password_verify';
            }
            else{
                echo "invalid email or password";
            }
        }
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <div class="col-6 shadow p-2 mx-auto">
            <h2>Sign In Page</h2>
            <form action="<?php echo $_SERVER ['PHP_SELF']  ?>" method="POST">

            <input type="email" name="email" placeholder="Email" class="form-control my-2">
            <input type="text" name="password" placeholder="Password" class="form-control my-2">
            <input type="submit" name="submit" value="Sigin in here!" class="form-control btn btn-success">

            </form>
        </div>
    </div>
</body>
</html>