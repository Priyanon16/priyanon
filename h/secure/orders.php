<?php
include_once("check_login.php");
include_once("connectdb.php");

// ดึงข้อมูลออเดอร์ (ตัวอย่างการ Join ตารางลูกค้า)
// ใช้การเรียงลำดับตามวันที่สั่งซื้อล่าสุด
$sql = "SELECT orders.*, customers.c_name 
        FROM orders 
        LEFT JOIN customers ON orders.c_id = customers.c_id 
        ORDER BY orders.o_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการออเดอร์ - ปรียานนท์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #fff5f8; font-family: 'Kanit', sans-serif; }
        .navbar { background-color: #f06292 !important; border-bottom: 3px solid #f8bbd0; }
        .nav-link { color: white !important; font-weight: 300; }
        .nav-link.active { font-weight: 500; border-bottom: 2px solid white; }
        
        .main-container { margin-top: 40px; margin-bottom: 40px; }
        
        /* สไตล์ตารางออเดอร์ */
        .order-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(240, 98, 146, 0.1);
            overflow: hidden;
        }
        .table thead { background-color: #fce4ec; }
        .table thead th { color: #d81b60; font-weight: 500; border: none; padding: 15px; }
        .table tbody td { padding: 15px; vertical-align: middle; }
        
        /* ป้ายสถานะสีพาสเทล */
        .badge-pending { background-color: #ffecb3; color: #856404; border-radius: 50px; padding: 5px 12px; }
        .badge-paid { background-color: #c8e6c9; color: #2e7d32; border-radius: 50px; padding: 5px 12px; }
        .badge-shipped { background-color: #e1f5fe; color: #0277bd; border-radius: 50px; padding: 5px 12px; }
        
        .btn-view {
            background-color: #fce4ec;
            color: #d81b60;
            border: 1px solid #f8bbd0;
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-view:hover { background-color: #f06292; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index2.php">🌸 Preeyanon Shop</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="products.php">จัดการสินค้า</a></li>
                <li class="nav-item"><a class="nav-link active" href="orders.php">จัดการออเดอร์</a></li>
                <li class="nav-item"><a class="nav-link" href="customers.php">จัดการลูกค้า</a></li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-light btn-sm rounded-pill px-3" href="logout.php" style="color: #f06292;">
                        <i class="fa-solid fa-power-off me-1"></i> ออกจากระบบ
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container main-container">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-secondary fw-light">รายการ <span class="fw-bold" style="color: #f06292;">สั่งซื้อทั้งหมด</span></h2>
            <p class="text-muted">ตรวจสอบและอัปเดตสถานะการส่งสินค้าของคุณ</p>
        </div>
    </div>

    <div class="order-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>เลขที่ออเดอร์</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ยอดรวม</th>
                        <th>สถานะ</th>
                        <th class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) { 
                            // กำหนด Class ของ Badge ตามสถานะ
                            $status_class = "badge-pending";
                            $status_text = $row['o_status']; // สมมติค่าจาก DB เป็น 'รอชำระเงิน', 'ชำระแล้ว'
                            
                            if($status_text == "ชำระแล้ว") $status_class = "badge-paid";
                            if($status_text == "ส่งแล้ว") $status_class = "badge-shipped";
                    ?>
                    <tr>
                        <td class="fw-bold text-dark">#<?= str_pad($row['o_id'], 5, '0', STR_PAD_LEFT); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['o_date'])); ?></td>
                        <td><?= htmlspecialchars($row['c_name']); ?></td>
                        <td class="fw-bold text-pink" style="color: #e91e63;">฿<?= number_format($row['o_total'], 2); ?></td>
                        <td><span class="<?= $status_class; ?>"><?= $status_text; ?></span></td>
                        <td class="text-center">
                            <a href="order_detail.php?id=<?= $row['o_id']; ?>" class="btn btn-sm btn-view">
                                <i class="fa-solid fa-magnifying-glass me-1"></i> ดูรายละเอียด
                            </a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='6' class='text-center py-5 text-muted'>ยังไม่มีออเดอร์เข้ามาในขณะนี้</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="text-center pb-4 text-muted">
    <small>ระบบหลังบ้านดูแลโดย มินนี่ (ปรียานนท์) &copy; 2026</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>