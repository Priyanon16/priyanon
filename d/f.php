<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>ผลการสมัครงาน</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">ข้อมูลใบสมัครงาน</h4>
        </div>

        <div class="card-body">

            <?php  
            $job      = $_POST['job'];
            $title    = $_POST['title'];
            $fullname = $_POST['fullname'];
            $birth    = $_POST['birth'];
            $edu      = $_POST['edu'];
            $skill    = $_POST['skill'];
            $exp      = $_POST['exp'];
            $phone    = $_POST['phone'];
            $email    = $_POST['email'];
            ?>

            <table class="table table-bordered">
                <tr><th>ตำแหน่งที่สมัคร</th><td><?php echo $job; ?></td></tr>
                <tr><th>คำนำหน้า</th><td><?php echo $title; ?></td></tr>
                <tr><th>ชื่อ-สกุล</th><td><?php echo $fullname; ?></td></tr>
                <tr><th>วันเกิด</th><td><?php echo $birth; ?></td></tr>
                <tr><th>ระดับการศึกษา</th><td><?php echo $edu; ?></td></tr>
                <tr><th>ความสามารถพิเศษ</th><td><?php echo nl2br($skill); ?></td></tr>
                <tr><th>ประสบการณ์ทำงาน</th><td><?php echo nl2br($exp); ?></td></tr>
                <tr><th>เบอร์โทรศัพท์</th><td><?php echo $phone; ?></td></tr>
                <tr><th>อีเมล</th><td><?php echo $email; ?></td></tr>
            </table>

            <a href="index.html" class="btn btn-secondary mt-3">ย้อนกลับ</a>

        </div>
    </div>
</div>

</body>
</html>
