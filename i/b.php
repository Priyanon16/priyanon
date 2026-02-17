<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ปรียานนท์ กรุตนิด (มินนี่)</title>
</head>

<body>

<h1>จัดการข้อมูลจังหวัด -- ปรียานนท์ กรุตนิด (มินนี่)</h1>

<form method="post" action="" enctype="multipart/form-data">
    ชื่อจังหวัด: <input type="text" name="pname" autofocus required>
    รูปภาพ: <input type="file" name="pimage" required> <br>
    ภาค: 
    <select name="rid">
    <?php 
    include_once("connectdb.php");
    $sql3 = "SELECT * FROM `regions`";
    $rs3 = mysqli_query($conn, $sql3);
    while ($data3 = mysqli_fetch_array($rs3)){
    ?>
        <option value='{$data3['r_id']}'>{$data3['r_name']}</option>";

    <?php } ?>
    </select>
    <button type="submit" name="Submit">บันทึก</button>
</form> <br>

<?php
if(isset($_POST['Submit'])){
    include_once("connectdb.php");
    $pname = $_POST['pname'];
    $rid = $_POST['rid'];
    $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION); // ใช้ $_FILES
    
    $sql2 = "INSERT INTO `provinces` VALUES (NULL, '{$pname}','{$ext}','{$rid}')";
    if(mysqli_query($conn, $sql2)){
        $pid = mysqli_insert_id($conn);
        //copy($_FILES['pimage']['tmp_name'], "images/".$pid.".".$ext);
        move_uploaded_file($_FILES['pimage']['tmp_name'], "images/".$pid.".".$ext);
        echo "<script>window.location.href=window.location.href;</script>";
    } else {
        echo "เพิ่มข้อมูลไม่ได้: " . mysqli_error($conn);
    }
}
?>

<table border="1" width="600">
    <tr bgcolor="#eee">
        <th>รหัสจังหวัด</th>
        <th>ชื่อจังหวัด</th>
        <th>ชื่อภาค</th>
        <th>รูป</th>
        <th>ลบ</th>
    </tr>
<?php 
include_once("connectdb.php");
// แก้ไขตรง p.r_id = r.r_id เพื่อไม่ให้ SQL Error
$sql = "SELECT * FROM `provinces` AS p INNER JOIN `regions` AS r ON p.r_id = r.r_id";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

while ($data = mysqli_fetch_array($rs)){
?>
    <tr>
        <td><?php echo $data['p_id'];?></td>
        <td><?php echo $data['p_name'];?></td>
        <td><?php echo $data['r_name'];?></td>
        <td><img src="images/<?php echo $data['p_id'].".".$data['p_ext'];?>" width="100"></td>
        <td align="center">
            <a href="delete_province.php?id=<?php echo $data['p_id'];?>&ext=<?php echo $data['p_ext'];?>" onClick="return confirm('ยืนยันการลบ?');">
                <img src="images/delete.jpg" width="20">
            </a>
        </td>
    </tr>
<?php } ?>
</table>

</body>
</html>
<?php mysqli_close($conn); ?>