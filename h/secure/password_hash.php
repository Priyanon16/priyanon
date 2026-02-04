<?php

$hashed_password = password_hash("4321", PASSWORD_DEFAULT);
echo $hashed_password;
?>