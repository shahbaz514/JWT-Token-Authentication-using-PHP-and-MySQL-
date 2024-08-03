<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>Property Panel - Add Admin</title>";
?>


    <style>
        h3 .fa-search{
            padding: 60px;
            border-radius: 50%;
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
        }
        h3 .fa-copy{
            padding: 60px;
            border-radius: 50%;
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
        }
        .fa-eye{
            padding: 20px;
            border-radius: 50%;
            color: #FFFFFF;
        }
        .btn-info{
            background-color: #0dcaf0;
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-info:hover{
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-success{
            color: #0c4128;
            color: #FFFFFF;
            padding: 10px;
            width: 120px;
        }
        .btn-warning{
            background-color: #efc23c;
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-warning:hover{
            background-color: #efc23c;
            color: white;
            padding: 10px;
            width: 120px;
        }
    </style>


    <!-- Sign Up Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <center>
                    <h2>Add Admin</h2>
                </center>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" id="floatingText" placeholder="jhondoe" required>
                            <label for="floatingText">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button type="submit" name="signup" class="btn btn-primary py-3 w-100 mb-4">Add User</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['signup']))
                {
                    $email = mysqli_real_escape_string($db, $_POST['email']);
                    $username = mysqli_real_escape_string($db, $_POST['username']);
                    $password = mysqli_real_escape_string($db, $_POST['password']);

                    $password = md5($password);


                    $sqlCheck = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
                    $count = mysqli_num_rows($sqlCheck);
                    if ($count>0)
                    {
                        ?>
                        <strong>Hello! <?php echo $_POST['username']; ?> </strong> This Username Already Exist. Use Another One.
                        <?php
                    }
                    else
                    {
                        $sqlInsert = mysqli_query($db, "INSERT INTO `users`(`email`, `username`, `password`) VALUES ('$email', '$username', '$password')");
                        if ($sqlInsert)
                        {
                            echo "<script>window.open('users.php', '_self')</script>";
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>

    <div class="clearfix"></div>

<?php

include "inc/footer.php";