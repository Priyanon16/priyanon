<?php
session_start();
include_once("connectdb.php");

$error_msg = "";

if (isset($_POST['Submit'])) {
    $user = $_POST['auser'];
    $pwd = $_POST['apwd'];

    // 1. ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
    $stmt = mysqli_prepare($conn, "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($data = mysqli_fetch_assoc($result)) {
        // 2. ตรวจสอบรหัสผ่านที่เข้ารหัส (Hash)
        // หมายเหตุ: ในฐานข้อมูลต้องเก็บรหัสที่ผ่านการ password_hash() มาก่อน
        if (password_verify($pwd, $data['a_password'])) {
            $_SESSION['aid'] = $data['a_id'];
            $_SESSION['aname'] = $data['a_name'];
            
            header("Location: index2.php");
            exit;
        } else {
            $error_msg = "Username หรือ Password ไม่ถูกต้อง";
        }
    } else {
        $error_msg = "Username หรือ Password ไม่ถูกต้อง";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - ปรียานนท์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fce4ec; /* ชมพูพาสเทลอ่อน */
            font-family: 'Kanit', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(255, 182, 193, 0.4);
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }
        .btn-pink {
            background-color: #f06292;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            transition: 0.3s;
        }
        .btn-pink:hover {
            background-color: #e91e63;
            color: white;
            transform: translateY(-2px);
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #f8bbd0;
        }
        .form-control:focus {
            border-color: #f06292;
            box-shadow: 0 0 0 0.25 darkred; /* หรือสีชมพูจางๆ */
        }
        h2 {
            color: #d81b60;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/6522/6522516.png" alt="Admin" width="80" class="mb-3">
    <h2 class="mb-4">เข้าสู่ระบบหลังบ้าน</h2>
    
    <?php if ($error_msg): ?>
        <div class="alert alert-danger border-0 py-2" style="font-size: 0.9rem;">
            <?= $error_msg; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3 text-start">
            <label class="form-label text-muted">Username</label>
            <input type="text" name="auser" class="form-control" placeholder="กรอกชื่อผู้ใช้" autofocus required>
        </div>
        <div class="mb-4 text-start">
            <label class="form-label text-muted">Password</label>
            <input type="password" name="apwd" class="form-control" placeholder="กรอกรหัสผ่าน" required>
        </div>
        <div class="d-grid">
            <button type="submit" name="Submit" class="btn btn-pink">LOGIN</button>
        </div>
    </form>
    
    <div class="mt-4 text-muted" style="font-size: 0.8rem;">
        &copy; <?= date('Y'); ?> ปรียานนท์ กรุตนิด(มินนี่)
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>