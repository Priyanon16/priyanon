<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>จัดการจังหวัด</title>
</head>

<body>

<h1>จัดการข้อมูลจังหวัด -- ปรียานนท์ กรุตนิด (มินนี่)</h1>

<form method="post" action="" enctype="multipart/form-data">
    ชื่อจังหวัด: <input type="text" name="pname" autofocus required>
    รูปภาพ: <input type="file" name="pimage" required> <br>

    ภาค:
    <select name="rid" required>
    <?php
    include_once("connectdb.php");
    $sql3 = "SELECT * FROM regions";
    $rs3 = mysqli_query($conn, $sql3);
    while ($data3 = mysqli_fetch_array($rs3)) {
        echo "<option value='{$data3['r_id']}'>{$data3['r_name']}</option>";
    }
    ?>
    </select>

    <button type="submit" name="Submit">บันทึก</button>
</form>

<br>

<?php
if(isset($_POST['Submit'])){
    include_once("connectdb.php");

    $pname = $_POST['pname'];
    $rid   = $_POST['rid'];

    // ทำให้ ext เป็นตัวเล็ก กัน .JPG .PNG
    $ext = strtolower(pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION));

    // Insert แบบระบุชื่อ column กันพัง
    $sql2 = "INSERT INTO provinces(p_name, p_ext, r_id)
             VALUES ('$pname', '$ext', '$rid')";

    if(mysqli_query($conn, $sql2)){
        $pid = mysqli_insert_id($conn);

        // ย้ายรูปเข้า images/
        move_uploaded_file($_FILES['pimage']['tmp_name'], "images/".$pid.".".$ext);

        echo "<script>window.location.href=window.location.href;</script>";
    }else{
        echo "เพิ่มข้อมูลไม่ได้: ".mysqli_error($conn);
    }
}
?>

<table border="1" width="700">
    <tr bgcolor="#eee">
        <th>รหัสจังหวัด</th>
        <th>ชื่อจังหวัด</th>
        <th>ชื่อภาค</th>
        <th>รูป</th>
        <th>ลบ</th>
    </tr>

<?php
include_once("connectdb.php");

// ดึงแบบ join ทีเดียว (ไม่ซ้อน loop)
$sql = "SELECT p.*, r.r_name
        FROM provinces p
        INNER JOIN regions r ON p.r_id = r.r_id";

$rs = mysqli_query($conn, $sql);

while($data = mysqli_fetch_array($rs)){
?>
    <tr>
        <td><?php echo $data['p_id']; ?></td>
        <td><?php echo $data['p_name']; ?></td>
        <td><?php echo $data['r_name']; ?></td>

        <td align="center">
            <img src="images/<?php echo $data['p_id'].".".$data['p_ext']; ?>" width="90">
        </td>

        <td align="center">
            <a href="delete_province.php?id=<?php echo $data['p_id']; ?>&ext=<?php echo $data['p_ext']; ?>"
               onClick="return confirm('ยืนยันการลบ?');">
               ลบ
            </a>
        </td>
    </tr>
<?php } ?>

</table>

</body>
</html>

<?php mysqli_close($conn); ?>
