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
    <select name="rid" required>
        <option value="">-- เลือกภาค --</option>
        <?php 
        include_once("connectdb.php");
        $sql3 = "SELECT * FROM `regions`";
        $rs3 = mysqli_query($conn, $sql3);
        while ($data3 = mysqli_fetch_array($rs3)){
            // แก้ไขตรงนี้: ใช้ echo และลบเครื่องหมายส่วนเกินออก
            echo "<option value='".$data3['r_id']."'>".$data3['r_name']."</option>";
        } 
        ?>
    </select>
    <button type="submit" name="Submit">บันทึก</button>
</form> <br>

<?php
if(isset($_POST['Submit'])){
    include_once("connectdb.php");
    $pname = $_POST['pname'];
    $rid = $_POST['rid'];
    
    // ตรวจสอบนามสกุลไฟล์
    $filename = $_FILES['pimage']['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    // บันทึกลงฐานข้อมูล (ระบุชื่อคอลัมน์เพื่อความชัวร์)
    $sql2 = "INSERT INTO `provinces` (`p_name`, `p_ext`, `r_id`) VALUES ('$pname', '$ext', '$rid')";
    
    if(mysqli_query($conn, $sql2)){
        $pid = mysqli_insert_id($conn); // ได้ ID ล่าสุดมาทำชื่อไฟล์
        $target_file = "images/" . $pid . "." . $ext;
        
        // ย้ายไฟล์จาก Temp ไปยังโฟลเดอร์ images
        if(move_uploaded_file($_FILES['pimage']['tmp_name'], $target_file)){
            echo "<script>alert('บันทึกข้อมูลและอัปโหลดรูปสำเร็จ'); window.location.href='b.php';</script>";
        } else {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ แต่ไม่สามารถย้ายไฟล์รูปภาพได้ (เช็ค Permission โฟลเดอร์ images)');</script>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
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
$sql = "SELECT * FROM `provinces` AS p INNER JOIN `regions` AS r ON p.r_id = r.r_id ORDER BY p.p_id DESC";
$rs = mysqli_query($conn, $sql);

while ($data = mysqli_fetch_array($rs)){
    $img_name = "images/" . $data['p_id'] . "." . $data['p_ext'];
?>
    <tr>
        <td align="center"><?php echo $data['p_id'];?></td>
        <td><?php echo $data['p_name'];?></td>
        <td><?php echo $data['r_name'];?></td>
        <td align="center">
            <?php if(file_exists($img_name)){ ?>
                <img src="<?php echo $img_name; ?>" width="120">
            <?php } else { echo "ไม่มีรูป"; } ?>
        </td>
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