<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>Inquiry Portal</title>";

if (isset($_GET['delete']))
{
    $sql = mysqli_query($db, "DELETE FROM `email` WHERE id = '".$_GET['delete']."'");
    if ($sql)
    {
        header('Location: allEmails.php');
    }
}
?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                order: [[0, 'asc']],
            });
        });
    </script>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Emails</h6>
                    <a href="addEmail.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM email");
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td colspan="2">
                                    <center>
                                        <a href="allEmails.php?delete=<?php echo $row['id']; ?>" class="btn btn-primary">
                                            <i class="fa fa-cut"></i>DELETE
                                        </a>

                                    </center>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


<?php
include "inc/footer.php";
?>