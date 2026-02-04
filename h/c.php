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
<h1>c.php</h1>

<?php
    echo @$_SESSION['name']. "<br>";
    echo @$_SESSION['nickname']. "<br>";
    echo @$_SESSION['p1']. "<br>";
    echo @$_SESSION['p2']. "<br>";
?>

</body>
</html>


