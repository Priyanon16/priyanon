<?php

$hashed_password = password_hash("1234"$_POST['password'], PASSWORD_DEFAULT);
echo $hashed_password;
?>