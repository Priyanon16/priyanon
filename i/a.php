<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ปรียานนท์ กรุตนิด (มินนี่)</title>
</head>

<body>

<h1>งาน i -- ปรียานนท์ กรุตนิด (มินนี่)</h1>

<?php
include_once("connectdb.php");
$sql = SELECT * FROM `regions`
$rs = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($rs)){
    echo $data['r_id']. "<br>";
    echo $data['r_name']. "<hr>";
}

mysqli_close($conn);
?>

<table border="1">
    <tr>
        <hr>รหัสภาค</hr>
        <hr>ชื่อภาค</hr>
    </tr>

    <tr>
        <hr>xxx</hr>
        <hr>xxx</hr>
    </tr>

</table>
</body>
</html>