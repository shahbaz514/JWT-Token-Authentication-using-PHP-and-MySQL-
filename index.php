<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>Property Panel - Profile</title>";
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
    </style>

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6">
                <div class="bg-light rounded d-flex justify-content-between p-4">
                    <i class="fa fa-search fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2" style="text-align: right!important;">Total Data Input</p>
                        <h6 class="mb-0" style="text-align: right!important;">
                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM datasave"));
                            ?>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="bg-light rounded d-flex justify-content-between p-4">
                    <i class="fa fa-list fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2" style="text-align: right!important;">Total Emails</p>
                        <h6 class="mb-0" style="text-align: right!important;">
                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM email"));
                            ?>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="bg-light rounded d-flex justify-content-between p-4">
                    <i class="fa fa-credit-card fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2" style="text-align: right!important;">Total Admins</p>
                        <h6 class="mb-0" style="text-align: right!important;">
                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM users"));
                            ?>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="bg-light rounded d-flex justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2" style="text-align: right!important;">Total Countries</p>
                        <h6 class="mb-0" style="text-align: right!important;">
                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM country"));
                            ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
include "inc/footer.php";
?>