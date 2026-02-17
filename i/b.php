<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ปรียานนท์ กรุตนิด (มินนี่)</title>
</head>

<body>

<h1>จัดการข้อมูลจังหวัด -- ปรียานนท์ กรุตนิด (มินนี่)</h1>

<form method="post" action="" enctype="multipart/form-data">
    ชื่อจังหวัด<input type="text" name="pname" autofocus require><br>
    รูปประจำจังหวัด<input type="file" name="pimage" require><br>
    ภาค
    <select name="rid">
    <?php
include_once("conectdb.php");
$sql3 = "SELECT * FROM regions";
$rs3 = mysqli_query($conn,$sql3);
while ($data3 = mysqli_fetch_array($rs3)){

?>
        <option value="<?php echo $data3['r_id']; ?>"><?php echo $data3['r_name']; ?></option>
<?php } ?>
</SELECT>
<br>
    <button type="submit" name="Submit">บันทึก</button>

</form><br><br>

<?php
if(isset($_POST['Submit'])){
    include_once("conectdb.php");
    

    $pname = $_POST['pname'];
    $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
    $rid = $_POST['rid'];
    $sql2 = "INSERT INTO `provinces` VALUES (NULL, '{$pname}', '{$ext}', '{$rid}')";
    mysqli_query($conn,$sql2) or die ("ไม่ได้");

    //var_dump($sql2);exit;
    $pid = mysqli_insert_id($conn);
    //copy($_FILES['pimage']['tmp_name'],"img/".$pid.".".$ext);
    move_uploaded_file($_FILES['pimage']['tmp_name'],"images/".$pid.".".$ext);
}
?>

<table border="1">
    <tr>
        <th>รหัสจังหวัด</th>
        <th>ชื่อจังหวัด</th>
        <th>ชื่อภาค</th>
        <th>รูปจังหวัด</th>
        <th>ลบ</th>

    </tr>
<?php
include_once("conectdb.php");
$sql = "SELECT * FROM `provinces`";
$rs = mysqli_query($conn,$sql);
while ($data = mysqli_fetch_array($rs)){
    
?>
<?php
    include_once("conectdb.php");
    $sql = "SELECT * FROM `provinces` AS p INNER JOIN `regions` AS r ON p.r_id = r.r_id";
    $rs = mysqli_query($conn,$sql);
    while ($data = mysqli_fetch_array($rs)){

?>
    <tr>
        <td><?php echo $data['p_id']; ?></td>
        <td><?php echo $data['p_name']; ?></td>
        <td><?php echo $data['r_name']; ?></td>
        <td><img src="images/<?php echo $data['p_id']; ?>.<?php echo $data['p_ext']; ?>" width="80"></td>
        <td width="80" align="center"><a href="delete_province.php?id=<?php echo $data['p_id']; ?>$ext=<?php echo $data['p_ext'];?>"onClick="return confirm('ยืนยันการลบ?');"><img src="images/delete.jpg" width="80"></a></td>
    </tr>
<?php } ?>
</table>
</body>
</html>
<?php
mysqli_close($conn);
?>
<?php } ?>