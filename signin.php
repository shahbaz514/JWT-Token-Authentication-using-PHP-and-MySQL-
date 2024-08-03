<?php
ob_start();
session_start();
include "db/db.php";
if (isset($_SESSION['username_otp']))
{
    echo "<script>window.open('otp.php','_self')</script>";
}
if (isset($_SESSION['username']))
{
    echo "<script>window.open('index.php','_self')</script>";
}
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
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form action="signin.php" enctype="multipart/form-data" method="post">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a>
                                    <h3 class="text-primary">
                                        <img src="img/logo.png" style="width: 200px;">
                                    </h3>
                                </a>
                                <h5>Sign In</h5>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" required class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="forgot-password.php">Forgot Password</a>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <?php
    if (isset($_POST['login']))
    {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $password = md5($password);

        $sql = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $row = mysqli_fetch_array($sql);
        $count = mysqli_num_rows($sql);
        if ($count > 0)
        {
            $otp = rand (1000,9999);
            $sqlOTP = mysqli_query($db,"UPDATE `users` SET `otp` = '$otp' WHERE username = '$username'");
            if ($sqlOTP)
            {
                $msg = "Your OTP is " . $otp;
                $mail = mail($row['email'], "New OTP For Property Panel", $msg);
                if ($mail)
                {
                    echo "<script>alert('New OTP is send to your email address. Kindly check.')</script>";
                    $_SESSION['username_otp'] = $username;
                    echo "<script>window.open('otp.php','_self')</script>";
                }
                else
                {
                    echo "<script>alert('Take an Error! Try again.')</script>";
                    echo "<script>window.open('signin.php','_self')</script>";
                }
            }
        }
        else
        {
            echo "<script>alert('Username and Password not Correct.')</script>";
        }
    }
    ?>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>


