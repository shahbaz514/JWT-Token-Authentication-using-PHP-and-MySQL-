<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="index.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">
                    <img src="img/logo.png" style="width: 100%;">
                </h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <?php
                    $userCredentials = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
                    if ($userCredentials['img'] == "")
                    {
                        echo '<img class="rounded-circle" src="img/user.jpg" style="width: 40px; height: 40px;">';
                    }
                    else
                    {
                        echo '<img class="rounded-circle" src="img/'.$userCredentials['img'].'" style="width: 40px; height: 40px;">';
                    }
                    ?>

                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0"><?php echo ucfirst($_SESSION['username']); ?></h6>
                </div>
            </div>
            <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link <?= ($activePage == 'index') ? 'active':''; ?>">
                        <i class="fa fa-tachometer-alt me-2"></i>
                        Dashboard
                    </a>
                    <a href="dataInput.php" class="nav-item nav-link <?= ($activePage == 'dataInput') ? 'active':''; ?>">
                        <i class="fa fa-database"></i>
                        <span style="margin-left: 10px!important;">
                            Fetch Data
                        </span>
                    </a>
                    <a href="allEmails.php" class="nav-item nav-link <?= ($activePage == 'allEmails') ? 'active':''; ?>">
                        <i class="fa fa-mail-bulk"></i>
                        <span style="margin-left: 10px!important;">
                            All Emails
                        </span>
                    </a>
                    <a href="allCountries.php" class="nav-item nav-link <?= ($activePage == 'allCountries') ? 'active':''; ?>">
                        <i class="fa fa-city"></i>
                        <span style="margin-left: 10px!important;">
                            All Countries
                        </span>
                    </a>
                    <a href="users.php" class="nav-item nav-link <?= ($activePage == 'users') ? 'active':''; ?>">
                        <i class="fa fa-users me-2"></i>
                        Users
                    </a>
            </div>
        </nav>
    </div>
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0">
                    <img src="img/logo.png" style="width: 100%;">
                </h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <?php
                        if ($userCredentials['img'] == "")
                        {
                            echo '<img class="rounded-circle" src="img/user.jpg" style="width: 40px; height: 40px;">';
                        }
                        else
                        {
                            echo '<img class="rounded-circle" src="img/'.$userCredentials['img'].'" style="width: 40px; height: 40px;">';
                        }
                        ?>
                        <span class="d-none d-lg-inline-flex">
                            <?php echo ucfirst($_SESSION['username']); ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="profile.php" class="dropdown-item <?= ($activePage == 'profile') ? 'active':''; ?>">My Profile</a>
                        <a href="settings.php" class="dropdown-item <?= ($activePage == 'settings') ? 'active':''; ?>">Settings</a>
                        <a href="changePassword.php" class="dropdown-item <?= ($activePage == 'changePassword') ? 'active':''; ?>">Change Password</a>
                        <a href="logout.php" class="dropdown-item <?= ($activePage == 'logout') ? 'active':''; ?>">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
        <style>
            .dataTables_wrapper {
                position: relative; }
            .dataTables_wrapper select {
                border: none;
                border-bottom: 1px solid #ddd;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                -ms-border-radius: 0;
                border-radius: 0;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                -ms-box-shadow: none;
                box-shadow: none; }
            .dataTables_wrapper select:active, .dataTables_wrapper select:focus {
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                -ms-box-shadow: none;
                box-shadow: none; }
            .dataTables_wrapper input[type="search"] {
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                -ms-border-radius: 0;
                border-radius: 0;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                -ms-box-shadow: none;
                box-shadow: none;
                border: none;
                font-size: 12px;
                border-bottom: 1px solid #ddd; }
            .dataTables_wrapper input[type="search"]:focus, .dataTables_wrapper input[type="search"]:active {
                border-bottom: 2px solid #1f91f3; }
            .dataTables_wrapper .dt-buttons {
                float: left; }
            .dataTables_wrapper .dt-buttons a.dt-button {
                background-color: #607D8B;
                color: #fff;
                padding: 7px 12px;
                margin-right: 5px;
                text-decoration: none;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                -ms-border-radius: 2px;
                border-radius: 2px;
                border: none;
                font-size: 13px;
                outline: none; }
            .dataTables_wrapper .dt-buttons a.dt-button:active {
                opacity: 0.8; }

            .dt-button-info {
                position: fixed;
                top: 50%;
                left: 50%;
                min-width: 400px;
                text-align: center;
                background-color: #fff;
                border: 2px solid #999;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                -ms-border-radius: 3px;
                border-radius: 3px;
                margin-top: -100px;
                margin-left: -200px;
                z-index: 21; }
            .dt-button-info h2 {
                color: #777; }
            .dt-button-info div {
                color: #777;
                margin-bottom: 20px; }

        </style>