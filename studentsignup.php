<?php


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
    <div class="container-fluid">
        <div class="col-8 shadow mx-auto my-2 p-2">
        <h2 class="text-center text-secondary">Student Sign Up Page</h2>

            <form action="studentprocess.php" method="POST">
            <input type="text" name="firstname" placeholder="Firstname" class="form-control my-2 shadow-none">
            <input type="text" name="lastname" placeholder="Lastname" class="form-control my-2 shadow-none">
            <input type="text" name="username" placeholder="Username" class="form-control my-2 shadow-none">
            <input type="text" name="department" placeholder="Department" class="form-control my-2 shadow-none">
            <input type="emal" name="email" placeholder="Email" class="form-control my-2 shadow-none">
                <!-- <?php
                    session_start();
                    if(isset($_SESSION['msg'])){
                        echo"<div class='text-danger'>".$_SESSION['msg']."</div>";
                    }
                ?> -->


            <input type="password" name="password" placeholder="Password" class="form-control my-2 shadow-none">
            <input type="text" name="gender" placeholder="Gender" class="form-control my-2 shadow-none">
            <input type="number" name="phonenumber" placeholder="Phonenumber" class="form-control my-2 shadow-none">
            <input type="submit" name="submit" class="form-control btn btn-info" >
            </form>
        </div>
    </div>
</body>
</html>