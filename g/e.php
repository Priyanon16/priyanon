<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard ยอดขายรวมตามประเทศ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="text-center mb-4">รายงานยอดขายแยกตามประเทศ</h2>
    <h3 class="text-center mb-4">ปรียานนท์ กรุตนิด (มินนี่)</h3>
    
    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    ตารางข้อมูล
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ประเทศ</th>
                                <th class="text-end">ยอดขาย (บาท)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include_once("connectdb.php");
                        
                        // เตรียมตัวแปร Array สำหรับเก็บข้อมูลไปทำกราฟ
                        $label = array();
                        $result = array();

                        $sql = "SELECT `p_country`, SUM(`p_amount`) AS total FROM `popsupermarket` GROUP BY `p_country` ORDER BY total DESC";
                        $rs = mysqli_query($conn, $sql);

                        while ($data = mysqli_fetch_array($rs)) {
                            // 1. เก็บข้อมูลใส่ Array เพื่อส่งไปให้ Chart.js
                            $label[] = $data['p_country'];
                            $result[] = $data['total'];
                        ?>
                            <tr>
                                <td><?php echo $data['p_country'];?></td>
                                <td class="text-end"><?php echo number_format($data['total'], 0);?></td>
                            </tr>
                        <?php 
                        } 
                        mysqli_close($conn);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">กราฟแท่ง (Bar Chart)</div>
                        <div class="card-body">
                            <canvas id="barChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark">กราฟวงกลม (Pie Chart)</div>
                        <div class="card-body">
                            <div style="width: 60%; margin: auto;">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // รับค่า JSON จาก PHP มาใส่ตัวแปร JavaScript
    const labels = <?php echo json_encode($label); ?>;
    const datas = <?php echo json_encode($result); ?>;

    // ชุดสีสำหรับกราฟ (เพื่อให้สีต่างกันในแต่ละประเทศ)
    const bgColors = [
        'rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 
        'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)', 
        'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)',
        'rgba(199, 199, 199, 0.7)'
    ];

    // --- สร้าง Bar Chart ---
    const ctxBar = document.getElementById('barChart');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ยอดขายรวม (บาท)',
                data: datas,
                backgroundColor: bgColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });

    // --- สร้าง Pie Chart ---
    const ctxPie = document.getElementById('pieChart');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: datas,
                backgroundColor: bgColors,
                hoverOffset: 4
            }]
        }
    });
</script>

</body>
</html>