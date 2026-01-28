<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ปรียานนท์ กรุตนิด (มินนี่)</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* จัดหน้าให้ดูกระชับ */
    .chart-container { display: flex; gap: 20px; margin-bottom: 20px; justify-content: center; }
    .chart-box { width: 45%; max-width: 500px; }
    table { margin: 0 auto; border-collapse: collapse; width: 50%; text-align: center; }
    h1 { text-align: center; }
</style>
</head>

<body>
<h1>ปรียานนท์ กรุตนิด (มินนี่)</h1>

<?php
include_once("connectdb.php");
$sql = "SELECT MONTH(p_date) AS Month, SUM(p_amount) AS Total_Sales FROM popsupermarket GROUP BY MONTH(p_date) ORDER BY Month;";
$rs = mysqli_query($conn,$sql);

// 2. ตัวแปรสำหรับเก็บข้อมูลกราฟ
$labels = [];
$sales = [];
?>

<div class="chart-container">
    <div class="chart-box"><canvas id="myBarChart"></canvas></div>
    <div class="chart-box"><canvas id="myDoughnutChart"></canvas></div>
</div>

<hr>

<table border="1" cellpadding="5">
<tr>
    <th>เดือน</th>
    <th>ยอดขาย</th>
</tr>

<?php
while ($data = mysqli_fetch_array($rs)) {
    // เก็บข้อมูลลง Array เพื่อส่งไป JS
    $labels[] = "เดือน " . $data['Month']; 
    $sales[] = $data['Total_Sales'];
?>
<tr>
    <td><?php echo $data['Month'];?></td>
    <td><?php echo number_format($data['Total_Sales'],0);?></td>
</tr>
<?php 
} 
mysqli_close($conn);
?>
</table>

<script>
    // รับค่าจาก PHP มาเป็น JSON
    const labels = <?php echo json_encode($labels); ?>;
    const dataSales = <?php echo json_encode($sales); ?>;

    // ตั้งค่าสีพื้นฐาน
    const bgColors = [
        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)'
    ];

    // สร้าง Bar Chart
    new Chart(document.getElementById('myBarChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ยอดขายรายเดือน (บาท)',
                data: dataSales,
                backgroundColor: bgColors,
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // สร้าง Doughnut Chart
    new Chart(document.getElementById('myDoughnutChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: dataSales,
                backgroundColor: bgColors,
                hoverOffset: 4
            }]
        }
    });
</script>

</body>
</html>