<?php
session_start();
session_abort();
include "../../db/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Property Panel - SignIn</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <?php
                if (isset($_SESSION['ousername']))
                {
                    ?>
                    <a href="controller.php" class="btn btn-block bg-success waves-effect">
                        Dashboard
                    </a>
                    <a href="controller.php?page=logout" class="btn btn-block bg-warning waves-effect">
                        Logout
                    </a>
                    <?php
                }
                else
                {
                    echo "<h1>Kindly Login Know</h1>";
                }
                ?>
            </div>
            <div class="col-sm-10">
                <?php
                if (isset($_SESSION['ousername']))
                {
                    if (isset($_GET['page']))
                    {
                        if ($_GET['page'] == "logout")
                        {
                            session_start();
                            session_destroy();
                            header("Location: controller.php");
                        }
                        if ($_GET['page'] == "block")
                        {
                            if (isset($_GET['status'])){
                                $status = $_GET['status'];
                                if ($status == "Lock"){
                                    mysqli_query($db, "UPDATE athentication SET s_status = 'Lock'");
                                    header("Location: controller.php");
                                }
                                else{
                                    mysqli_query($db, "UPDATE athentication SET s_status = 'UnLock'");
                                    header("Location: controller.php");
                                }
                            }
                        }
                    }
                    else
                    {
                        ?>
                        Do You Want to Block this Site? <a class="btn btn-warning" href="controller.php?page=block&&status=Lock">Block Now</a><hr>
                        Do You Want to Un Block this Site? <a class="btn btn-warning" href="controller.php?page=block&&status=UnLock">Un Block Now</a>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="login-box">
                        <div class="card">
                            <div class="body">
                                <div class="logo">
                                    <img src="../../img/logo.png" style="width: 100%;" alt="ADC | MBL">
                                </div>
                                <form id="sign_in" action="" method="post" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-8 p-t-5">

                                        </div>
                                        <div class="col-xs-4">
                                            <button class="btn btn-block bg-pink waves-effect" name="login" type="submit">SIGN IN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['login'])){
                        $username = mysqli_real_escape_string($db, $_POST['username']);
                        $password = mysqli_real_escape_string($db, $_POST['password']);


                        $o_username = "Shahbaz514786";
                        $o_password = "Shahbaz@514786";

                        if ($o_username == $username && $o_password == $password){
                            @session_start();
                            $_SESSION['ousername'] = $username;
                            $_SESSION['role'] = "";
                            header("Location: controller.php");
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/bootstrap/js/npm.js"></script>
    </body>
</html>