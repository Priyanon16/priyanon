<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ปรียานนท์ กรุตนิด (มินนี่)</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        /* ปรับแต่งเพิ่มเติมเล็กน้อย */
        body { background-color: #f8f9fa; }
        .table-img { width: 55px; height: 55px; object-fit: cover; border-radius: 5px; }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">ปรียานนท์ กรุตนิด (มินนี่)</h3>
            </div>
            <div class="card-body">
                
                <table id="customerTable" class="table table-striped table-hover table-bordered" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>ชื่อสินค้า</th>
                            <th>ประเภทสินค้า</th>
                            <th>วันที่</th>
                            <th>ประเทศ</th>
                            <th>จำนวนเงิน</th>
                            <th>รูปภาพ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ตรวจสอบว่าไฟล์ connectdb.php มีอยู่จริง
                        if(file_exists("connectdb.php")){
                            include_once("connectdb.php");
                            $sql = "SELECT * FROM `popsupermarket`";
                            $rs = mysqli_query($conn, $sql);
                            
                            while ($data = mysqli_fetch_array($rs)) {
                        ?>
                        <tr>
                            <td><?php echo $data['p_order_id'];?></td>
                            <td><?php echo $data['p_product_name'];?></td>
                            <td><?php echo $data['p_category'];?></td>
                            <td><?php echo $data['p_date'];?></td>
                            <td><?php echo $data['p_country'];?></td>
                            <td class="text-end"><?php echo number_format($data['p_amount'], 0);?></td>
                            <td class="text-center">
                                <img src="images/<?php echo $data['p_product_name'];?>.jpg" class="table-img" alt="Product Image">
                            </td>
                        </tr>
                        <?php 
                            } 
                            mysqli_close($conn);
                        } else {
                            echo "<tr><td colspan='7' class='text-center text-danger'>ไม่พบไฟล์ connectdb.php</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable({
                // (Optional) แปลงภาษาเมนูเป็นภาษาไทย
                /*
                language: {
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง _MENU_ แถว",
                    "sZeroRecords": "ไม่พบข้อมูล",
                    "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                    "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "sInfoPostFix": "",
                    "sSearch": "ค้นหา:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "หน้าสุดท้าย"
                    }
                }
                */
            });
        });
    </script>

</body>
</html>