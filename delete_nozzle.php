<?php
include ("connection.php");
error_reporting(0);
$id = $_GET['id'];

$query = "DELETE FROM nozzle WHERE nozzle_id = '$id' ";
$data = mysqli_query($conn, $query);
if ($data) {
    ?>
    <script >
        alert("Nozzle Deleted Successfully!!!");
    </script>    
    <?php
    header("Location:display_nozzle.php");
}
?>