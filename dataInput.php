<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>Property Panel - All Save Data</title>";
?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                order: [[0, 'desc']],
            });
        });
    </script>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Save Data</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                        <tr>
                            <th>Country</th>
                            <th>Language</th>
                            <th>locale</th>
                            <th>model</th>
                            <th>modelCode</th>
                            <th>orderID</th>
                            <th>price</th>
                            <th>options</th>
                            <th>customer</th>
                            <th>vehicle</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM datasave ORDER BY id DESC");
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <th><?php echo $row['country']; ?></th>
                                <th><?php echo $row['language']; ?></th>
                                <td><?php echo $row['locale']; ?></td>
                                <td><?php echo $row['model']; ?></td>
                                <td><?php echo $row['modelCode']; ?></td>
                                <td><?php echo $row['orderID']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo substr($row['options'], 0, 5); ?>...</td>
                                <td><?php echo $row['customer']; ?></td>
                                <td><?php echo $row['vehicle']; ?></td>
                                <td><?php echo $row['date']; ?></td>
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