<!doctype html>
<html lang="th">

<head>
<meta charset="utf-8">
<title>ฟอร์มรับข้อมูล - ปรียานนท์ กรุตนิด (มินนี่)</title>

<!-- Bootstrap v5.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #f5f6fa;
    }
    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.15);
    }
</style>
</head>

<body>

<div class="container mt-5">
    <div class="card p-4">
        <h3 class="text-center mb-3">ฟอร์มรับข้อมูล- ปรียานนท์ กรุตนิด (มินนี่) - ChatGPT</h3>
        <hr>

        <form method="post" action="">
            
            <div class="mb-3">
                <label class="form-label">ชื่อ-สกุล *</label>
                <input type="text" name="fullname" class="form-control" autofocus required>
            </div>

            <div class="mb-3">
                <label class="form-label">เบอร์โทร *</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ส่วนสูง (ซม.) *</label>
                <input type="number" name="height" min="100" max="200" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ที่อยู่</label>
                <textarea name="address" cols="40" rows="4" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">วันเดือนปีเกิด</label>
                <input type="date" name="birthday" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">สีที่ชอบ</label>
                <input type="color" name="color" class="form-control form-control-color">
            </div>

            <div class="mb-3">
                <label class="form-label">สาขาวิชา</label>
                <select name="major" class="form-select">
                    <option value="การบัญชี">การบัญชี</option>
                    <option value="การตลาด">การตลาด</option>
                    <option value="การจัดการ">การจัดการ</option>
                    <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
                </select>
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="submit" name="Submit" class="btn btn-success">สมัครสมาชิก</button>
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                <button type="button" class="btn btn-primary" onClick="window.location='https://www.msu.ac.th/';">Go to MSU</button>
                <button type="button" class="btn btn-warning" onMouseOver="alert('ต๊ะเอ๋');">Hello</button>
                <button type="button" class="btn btn-secondary" onClick="window.print();">พิมพ์</button>
            </div>
        </form>
    </div>
</div>

<hr>

<div class="container mt-3">
<?php
if (isset ($_POST['Submit'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $height = $_POST['height'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $color = $_POST['color'];
    $major = $_POST['major'];

    echo "<div class='alert alert-info'><strong>ข้อมูลที่คุณส่งมา:</strong><br>";
    echo "ชื่อ-สกุล: ".$fullname."<br>";
    echo "เบอร์โทร: ".$phone."<br>";
    echo "ส่วนสูง: ".$height." ซม.<br>";
    echo "ที่อยู่: ".$address." <br>";
    echo "วันเดือนปีเกิด: ".$birthday." <br>";
    echo "สาขาวิชา: ".$major." <br>";
    echo "</div>";
}
?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
