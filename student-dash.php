<?php 

require 'connection.php';
session_start();

echo $_SESSION['stu_id'];
$id=$_SESSION['stu_id'];

$query="SELECT * FROM `student_table` WHERE student_id=$id";
$dbconnection=$connection->query($query);
$student=$dbconnection->fetch_assoc();
// print_r($student['firstName'])

$query="SELECT * FROM `student_table` WHERE student_id=$id";
$dbconnection=$connection->query($query);
$stu_details=$dbconnection->fetch_all(MYSQLI_ASSOC);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
</head>
<body>
    <div>
        <div class="navbar bg-info p-3">
                <h5 class="text-white">Welcome: <span><?php echo $student['firstName'] ?></span> <span><?php echo $student['lastName'] ?></span></h5>
                <img src="<?php echo 'images/'.$newPicture?>" alt="">
                <h5 class="text-white">Supervisor-Id: <span><?php echo $student['supervisor_id'] ?></span></h5>
        </div>

        <div class="p-2">
            <form class="d-block" action="<?php echo $_SERVER ['PHP_SELF']  ?>" method="post" enctype="multipart/form-data">
            <label>Upload profile picture</label>
            <input type="file" name="picture">
            <input type="submit" name="submit">
            </form>
        </div>


        <div class="container-fluid mx-auto my-2">
        <div class="p-2 border border-danger text-center">
                    <?php foreach($stu_details as $info ): ?>
                        <p>Firstname: <?php echo $info['firstName']?></p>
                        <p>Lastname: <?php echo $info['lastName'] ?></p>
                        <p>Username: <?php echo $info['username'] ?></p>
                        <p>Email: <?php echo $info['email'] ?></p>

                    <?php endforeach; ?>
                </div>
        </div>
    </div>
</body>
</html>