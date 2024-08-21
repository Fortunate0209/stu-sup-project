<?php
require 'connection.php';
session_start();

if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query="SELECT * FROM `supervisors_table` WHERE email=?";
    $prepare=$connection->prepare($query);
    $prepare->bind_param('s',$email);
    $execute=$prepare->execute();
    $supervisor=$prepare->get_result();

    if($supervisor){
        if($supervisor->num_rows>0){
            $user=$supervisor->fetch_assoc();
            // print_r($user['password']);

            $hassedpass=$user['password'];
            $password_verify=password_verify($password,$hassedpass);

            if($password_verify){
                $_SESSION['super_id']=$user['supervisor_id'];
                header('location:supervisor_dash.php');
                // echo $password_verify;
            }
            else{
                echo "Invalid email or password";
            }
        }
        else{
            echo "Invalid email or password";
        }
    }
    else{
        echo "Error in query";
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
        <div class="col-6 mx-auto">
            <h2>Sign In Page</h2>
            <form action="<?php echo $_SERVER ['PHP_SELF']  ?>" method="POST">

            <input type="text" name="email" placeholder="Email" class="form-control">
            <input type="text" name="password" placeholder="Password" class="form-control">
            <input type="submit" name="submit" value="Sigin in here!" class="form-control btn btn-primary">

            </form>
        </div>
    </div>
</body>
</html>