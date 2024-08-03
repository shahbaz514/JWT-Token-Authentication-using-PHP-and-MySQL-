<?php
ob_start();
session_start();
include "db/db.php";
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

    <style>
        /* Import Google font - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4070f4;
        }
        :where(.container, form, .input-field, header) {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: #fff;
            padding: 30px 65px;
            border-radius: 12px;
            row-gap: 20px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        .container header {
            height: 65px;
            width: 65px;
            background: #ffcc2a;
            color: #fff;
            font-size: 2.5rem;
            border-radius: 50%;
        }
        .container h4 {
            font-size: 1.25rem;
            color: #333;
            font-weight: 500;
        }
        form .input-field {
            flex-direction: row;
            column-gap: 10px;
        }
        .input-field input {
            height: 45px;
            width: 42px;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
        }
        .input-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }
        .input-field input::-webkit-inner-spin-button,
        .input-field input::-webkit-outer-spin-button {
            display: none;
        }
        form button {
            margin-top: 25px;
            width: 100%;
            color: #fff;
            font-size: 1rem;
            border: none;
            padding: 9px 0;
            cursor: pointer;
            border-radius: 6px;
            pointer-events: none;
            background: rgb(166, 145, 79);
            transition: all 0.2s ease;
        }
        form button.active {
            background: #ffcc2a;
            pointer-events: auto;
        }
        form button:hover {
            background: #ffcc2a;
        }
    </style>
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
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="container">
                        <header>
                            <img src="img/logo.png" class="img-thumbnail">
                        </header>
                        <h4>Enter OTP Code</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="input-field">
                                <input type="number" name="otp1"/>
                                <input type="number" name="otp2" disabled />
                                <input type="number" name="otp3" disabled />
                                <input type="number" name="otp4" disabled />
                            </div>
                            <button type="submit" name="otp_verify">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <?php
    if (isset($_POST['otp_verify']))
    {
        $otp1 = mysqli_real_escape_string($db, $_POST['otp1']);
        $otp2 = mysqli_real_escape_string($db, $_POST['otp2']);
        $otp3 = mysqli_real_escape_string($db, $_POST['otp3']);
        $otp4 = mysqli_real_escape_string($db, $_POST['otp4']);
        $otp = $otp1.$otp2.$otp3.$otp4;
        $sql = mysqli_query($db, "SELECT * FROM users WHERE otp = '$otp' AND username = '".$_SESSION['username_otp']."'");
        $row = mysqli_fetch_array($sql);
        $count = mysqli_num_rows($sql);
        if ($count > 0)
        {
            $_SESSION['username'] = $_SESSION['username_otp'];
            echo "<script>window.open('index.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Invalid OTP, Login Again.')</script>";
            echo "<script>window.open('logout.php','_self')</script>";
        }
    }
    ?>


    <script>
        const inputs = document.querySelectorAll("input"),
            button = document.querySelector("button");

        // iterate over all inputs
        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                // This code gets the current input element and stores it in the currentInput variable
                // This code gets the next sibling element of the current input element and stores it in the nextInput variable
                // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
                const currentInput = input,
                    nextInput = input.nextElementSibling,
                    prevInput = input.previousElementSibling;

                // if the value has more than one character then clear it
                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }
                // if the next input is disabled and the current value is not empty
                //  enable the next input and focus on it
                if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                // if the backspace key is pressed
                if (e.key === "Backspace") {
                    // iterate over all inputs again
                    inputs.forEach((input, index2) => {
                        // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
                        // and the previous element exists, set the disabled attribute on the input and focus on the previous element
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }
                //if the fourth input( which index number is 3) is not empty and has not disable attribute then
                //add active class if not then remove the active class.
                if (!inputs[3].disabled && inputs[3].value !== "") {
                    button.classList.add("active");
                    return;
                }
                button.classList.remove("active");
            });
        });

        //focus the first input which index is 0 on window load
        window.addEventListener("load", () => inputs[0].focus());
    </script>
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


