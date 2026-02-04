<?php
include_once("check_login.php");
include_once("connectdb.php");

// ตัวอย่างการดึงข้อมูลสินค้า (ใช้ Prepared Statement หากมีการกรองข้อมูล)
$sql = "SELECT * FROM products ORDER BY p_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสินค้า - ปรียานนท์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #fff5f8; font-family: 'Kanit', sans-serif; }
        .navbar { background-color: #f06292 !important; }
        .nav-link { color: white !important; }
        .btn-pink { background-color: #f06292; color: white; border-radius: 10px; border: none; }
        .btn-pink:hover { background-color: #e91e63; color: white; }
        .btn-outline-pink { border: 1px solid #f06292; color: #f06292; border-radius: 10px; }
        .btn-outline-pink:hover { background-color: #fce4ec; color: #d81b60; }
        
        /* สไตล์ตาราง */
        .table-container {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(240, 98, 146, 0.1);
        }
        .table thead { background-color: #fce4ec; }
        .table thead th { color: #d81b60; border: none; }
        .img-product { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index2.php"><i class="fa-solid fa-heart-pulse me-2"></i>Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="products.php">สินค้า</a></li>
                <li class="nav-item"><a class="nav-link" href="orders.php">ออเดอร์</a></li>
                <li class="nav-item"><a class="nav-link" href="customers.php">ลูกค้า</a></li>
            </ul>
            <span class="navbar-text text-white me-3">
                <i class="fa-regular fa-circle-user"></i> <?= htmlspecialchars($_SESSION['aname']); ?>
            </span>
            <a href="logout.php" class="btn btn-sm btn-light text-pink" style="color:#f06292;">ออกจากระบบ</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary"><i class="fa-solid fa-box-open me-2 text-pink" style="color:#f06292;"></i>จัดการข้อมูลสินค้า</h2>
        <a href="add_product.php" class="btn btn-pink px-4"><i class="fa-solid fa-plus me-1"></i> เพิ่มสินค้าใหม่</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th width="100">รูปภาพ</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // สมมติโครงสร้างฐานข้อมูลเบื้องต้น
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td><?= $row['p_id']; ?></td>
                        <td><img src="images/<?= $row['p_img']; ?>" class="img-product" alt="product"></td>
                        <td><?= htmlspecialchars($row['p_name']); ?></td>
                        <td><?= number_format($row['p_price'], 2); ?> บาท</td>
                        <td class="text-center">
                            <a href="edit_product.php?id=<?= $row['p_id']; ?>" class="btn btn-sm btn-outline-pink me-1">
                                <i class="fa-solid fa-pen-to-square"></i> แก้ไข
                            </a>
                            <a href="delete_product.php?id=<?= $row['p_id']; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('ยืนยันการลบสินค้านี้?')">
                                <i class="fa-solid fa-trash"></i> ลบ
                            </a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='5' class='text-center py-4 text-muted'>ยังไม่มีข้อมูลสินค้า</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="text-center mt-5 pb-4 text-muted">
        <small>&copy; 2026 ปรียานนท์ กรุตนิด (มินนี่)</small>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>