<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ปรียานนท์ กรุตนิด(มินนี่)</title>
</head>
<body>
<h1>a.php</h1>

<?php
    $_SESSION['name'] = "ปรียานนท์ กรุตนิด";
    $_SESSION['nickname'] = "มินนี่";
    $_SESSION['p1'] = "โซฟา";
    $_SESSION['p2'] = "ห่วงยาง";
?>
</body>
</html>


