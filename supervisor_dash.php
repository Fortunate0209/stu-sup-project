<?php 
require 'connection.php';
session_start();

echo $_SESSION['super_id'];
$id=$_SESSION['super_id'];

echo $_SESSION['stu_id'];
$stu=$_SESSION['stu_id'];

$query="SELECT * FROM `supervisors_table` WHERE supervisor_id=$id";
$dbconnection=$connection->query($query);
$user=$dbconnection->fetch_assoc();
// print_r($user);

// $query="SELECT * FROM `supervisors_table` WHERE supervisor_id=$id";
// $dbconnection=$connection->query($query);
// $sup_details=$dbconnection->fetch_all(MYSQLI_ASSOC);

$query="SELECT * FROM `student_table` WHERE supervisor_id=$id";
$dbconnection=$connection->query($query);
$student_details=$dbconnection->fetch_all(MYSQLI_ASSOC);
// print_r($student_details);



if(isset($_POST['submit'])){
    // print_r($_FILES);
    $name=$_FILES['picture']['name'];
    print_r($name);
    $temp=$_FILES['picture']['tmp_name'];

    $newPicture=time().$name;
    // print_r($newPicture);
    $move=move_uploaded_file($temp, 'images/'.$newPicture);

    if($move){
        $query="UPDATE `supervisors_table` SET `picture` = '$newPicture' WHERE supervisor_id=$id";
        $dbconnection=$connection->query($query);
        if($dbconnection){
            echo "moved";
        }
    }
    else{
        echo "not moved";
    }
}

if(isset($_POST['Del'])){
    $del=$_POST['student_id'];
    $query="DELETE FROM `student_table` WHERE student_id = $del";
    $dbconnection=$connection->query($query);
    if($dbconnection){
        echo "deleted";
    }
    else{
        echo "not deleted";
    }
}

if (isset($_POST['update'])) {
    $student_id = $_POST['student_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phonenumber = $_POST['phonenumber'];

    $query = "UPDATE `student_table` SET `firstName` = '$firstName', `lastName` = '$lastName', `username` = '$username', `department` = '$department', `email` = '$email', `gender`='$gender', `phonenumber` = '$phonenumber' WHERE `student_id` = '$student_id'";
    $dbconnection = $connection->query($query);

    if ($dbconnection) {
        echo "Student updated successfully!";
    } else {
        echo "Error updating student: " . $connection->error;
    }
}


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
        <div class="navbar bg-success p-3">
                <h4 class="text-white">Welcome: <span><?php echo $user['firstName'] ?></span> <span><?php echo $user['lastName'] ?></span></h4>
                <img src="<?php echo 'images/'.$newPicture?>" alt="">
                <h4 class="text-white">Supervisor-Id: <span><?php echo $user['supervisor_id'] ?></span></h4>
        </div>

        <div class="p-2">
            <form class="d-block" action="<?php echo $_SERVER ['PHP_SELF']  ?>" method="post" enctype="multipart/form-data">
            <label>Upload profile picture</label>
            <input type="file" name="picture">
            <input type="submit" name="submit">
            </form>
        </div>


        <!-- <div class="container-fluid mx-auto my-2">
        <div class="p-2 border border-danger text-center">
                    <?php foreach($sup_details as $info ): ?>
                        <p>Firstname: <?php echo $info['firstName'],  $info['lastName'] ?></p>
                        <p>Lastname: <?php echo $info['lastName'] ?></p>

                    <?php endforeach; ?>
                </div>
        </div> -->

         <!-- <div class="container-fluid mx-auto my-2">
        <div class="p-2 border border-danger text-center">
            <h4>Students</h4>
                    <?php foreach($student_details as $info ): ?>
                        <p>Firstname: <?php echo $info['firstName'],  $info['lastName'] ?></p>
                        <p>Lastname: <?php echo $info['lastName'] ?></p>
                        <p>Email: <?php echo $info['email'] ?></p>
                        <p>Supervisor-id: <?php echo $info['supervisor_id'] ?></p>

                        <form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="POST">
                            <input type="hidden" name='student_id' value="<?php echo $info ['student_id'] ?>">
                        <button type='submit' name="Del" class="text-white p-1 bg-danger " onclick="return confirm('Are you sure you want to delete this student')">Delete</button>
                        </form>

                        <form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="POST">
                            <input type="hidden" name='student_id' value="<?php echo $info ['student_id'] ?>">
                            <button type="submit_edit" name="Edit" class="text-white p-1 bg-info " data-bs-toggle="modal" data-bs-target="#exampleModal" (click)="Edit()">Edit</button>
                        </form>

                    <?php endforeach; ?>
                </div>
        </div> -->



        <div class="row ms-5 ps-5 mt-5 border shadow col-8">
        <div class="col-12">
             <!-- <?php if(count($student_details)<1): ?>
                <div style="color: red; font-weight: bold;">

                    <p>Empty note</p>
                </div>
            
            <?php endif; ?> -->

            <table class="table table-stripped" <?php if(count($student_details)>0) ?>>
                <h3 class="text-center text-info">Students</h3>
                <tr>
                    <th>S/N</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone-Number</th>
                </tr>
                <?php foreach($student_details as $index => $info): ?>
                    <tr>
                        <td><?php echo $index+1; ?></td>
                        <td><?php echo $info['firstName']; ?></td>
                        <td><?php echo $info['lastName']; ?></td>
                        <td><?php echo $info['username']; ?></td>
                        <td><?php echo $info['department']; ?></td>
                        <td><?php echo $info['email']; ?></td>
                        <td><?php echo $info['gender']; ?></td>
                        <td><?php echo $info['phonenumber']; ?></td>

                        <td>
                        <form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="POST">
                            <input type="hidden" name='student_id' value="<?php echo $info ['student_id'] ?>">
                        <button type='submit' name="Del" class="text-white p-1 bg-danger " onclick="return confirm('Are you sure you want to delete this student')">Delete</button>
                        </form>
                        </td>
                        
                        <td>
            <button type="button" class="text-white p-1 bg-info" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $info ['student_id']; ?>">Edit</button>

            <!-- Modal form -->
            <div class="modal fade" id="exampleModal-<?php echo $info ['student_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="POST">
                                <input type="hidden" name='student_id' value="<?php echo $info ['student_id'] ?>">
                                <label for="firstName">Firstname:</label>
                                <input type="text" name="firstName" value="<?php echo $info ['firstName']; ?>">
                                <br>
                                <label for="lastName">Lastname:</label>
                                <input type="text" name="lastName" value="<?php echo $info ['lastName']; ?>">
                                <br>
                                <label for="username">Username:</label>
                                <input type="text" name="username" value="<?php echo $info ['username']; ?>">
                                <br>
                                <label for="department">Department:</label>
                                <input type="text" name="department" value="<?php echo $info ['department']; ?>">
                                <br>
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="<?php echo $info ['email']; ?>">
                                <br>
                                <br>
                                <label for="gender">Gender:</label>
                                <input type="text" name="gender" value="<?php echo $info ['gender']; ?>">
                                <br>
                                <label for="phonenumber">Phone Number:</label>
                                <input type="text" name="phonenumber" value="<?php echo $info ['phonenumber']; ?>">
                                <br>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </td>

                    </tr>


                    
                <?php endforeach; ?>

            </table>

          
        </div>
    </div>

    </div>
</body>
</html>