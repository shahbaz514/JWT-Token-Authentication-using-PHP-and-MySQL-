<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>Property Panel - Add Key</title>";
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
                    <h2>Add Key</h2>
                </center>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="skey" class="form-control" id="floatingInput" placeholder="" required>
                            <label for="floatingInput">Secret Key</label>
                        </div>
                        <button type="submit" name="signup" class="btn btn-primary py-3 w-100 mb-4">Add Key</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['signup']))
                {
                    $skey = mysqli_real_escape_string($db, $_POST['skey']);
                    $sqlInsert = mysqli_query($db, "INSERT INTO secret (skey) VALUES ('$skey')");
                    if ($sqlInsert)
                    {
                        echo "<script>window.open('secret.php', '_self')</script>";
                    }

                }
                ?>

            </div>
        </div>
    </div>

    <div class="clearfix"></div>

<?php

include "inc/footer.php";