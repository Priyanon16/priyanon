<meta charset="utf-8">
<?php
    include_once("connectdb.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM provinces WHERE p_id='{$id}'";
    mysqli_query($conn, $sql) or die ("ลบข้อมูลไม่ได้");

    unlink("images/".$id.".");

    echo "<script>";
    echo "window.location='b.php';";
    echo "</script>";
?>