<?php
include_once("check_login.php");
include_once("connectdb.php");

// ดึงข้อมูลลูกค้าทั้งหมด
$sql = "SELECT * FROM customers ORDER BY c_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการลูกค้า - ปรียานนท์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #fff5f8; font-family: 'Kanit', sans-serif; }
        .navbar { background-color: #f06292 !important; box-shadow: 0 2px 10px rgba(240, 98, 146, 0.2); }
        .nav-link { color: rgba(255,255,255,0.9) !important; }
        .nav-link.active { color: #fff !important; font-weight: 500; }
        
        .customer-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 20px;
        }
        
        .table thead th {
            background-color: #fce4ec;
            color: #d81b60;
            border: none;
            font-weight: 500;
        }
        
        .avatar-circle {
            width: 40px;
            height: 40px;
            background-color: #f8bbd0;
            color: #d81b60;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
        }

        .btn-action {
            border-radius: 8px;
            transition: 0.2s;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index2.php">🌸 Preeyanon Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="products.php">สินค้า</a></li>
                <li class="nav-item"><a class="nav-link" href="orders.php">ออเดอร์</a></li>
                <li class="nav-item"><a class="nav-link active" href="customers.php">ลูกค้า</a></li>
                <li class="nav-item ms-lg-3">
                    <a href="logout.php" class="btn btn-sm btn-outline-light rounded-pill px-3">ออกจากระบบ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold" style="color: #f06292;">จัดการรายชื่อลูกค้า</h2>
            <p class="text-muted">ตรวจสอบข้อมูลสมาชิกและประวัติการติดต่อ</p>
        </div>
        <div class="col-md-6 text-md-end">
            <button class="btn btn-pink shadow-sm text-white" style="background-color: #f06292; border-radius: 10px;">
                <i class="fa-solid fa-user-plus me-1"></i> เพิ่มลูกค้าใหม่
            </button>
        </div>
    </div>

    <div class="customer-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="text-center" width="70">ID</th>
                        <th width="60"></th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>อีเมล / ชื่อผู้ใช้</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) { 
                            // ดึงตัวอักษรแรกของชื่อมาทำ Avatar
                            $initial = mb_substr($row['c_name'], 0, 1, 'UTF-8');
                    ?>
                    <tr>
                        <td class="text-center text-muted"><?= $row['c_id']; ?></td>
                        <td>
                            <div class="avatar-circle"><?= $initial; ?></div>
                        </td>
                        <td class="fw-medium"><?= htmlspecialchars($row['c_name']); ?></td>
                        <td><?= htmlspecialchars($row['c_email']); ?></td>
                        <td><?= htmlspecialchars($row['c_phone']); ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="edit_customer.php?id=<?= $row['c_id']; ?>" class="btn btn-sm btn-outline-secondary btn-action">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>
                                <a href="delete_customer.php?id=<?= $row['c_id']; ?>" 
                                   class="btn btn-sm btn-outline-danger btn-action ms-1"
                                   onclick="return confirm('ยืนยันการลบข้อมูลลูกค้าท่านนี้?')">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='6' class='text-center py-5 text-muted'>ยังไม่พบข้อมูลลูกค้าในระบบ</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="text-center mt-5 pb-4 text-muted">
        <p style="font-size: 0.85rem;">คุณกำลังล็อกอินในชื่อ: <strong><?= htmlspecialchars($_SESSION['aname']); ?></strong></p>
        <small>&copy; 2026 ปรียานนท์ กรุตนิด (มินนี่)</small>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>