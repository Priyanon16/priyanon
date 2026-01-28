<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ฟอร์มสมัครงาน</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-4">

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">แบบฟอร์มสมัครงาน - บริษัท มหาวิศวกรรม โซลูชัน จำกัด</h4>
        <h5 class="mb-0">ปรียานนท์ กรุตนิด (มินนี่)</h5>
    </div>

<div class="card-body">

<form method="post" action="f.php">

    <!-- ตำแหน่งงาน -->
    <div class="mb-3">
        <label class="form-label">ตำแหน่งที่ต้องการสมัคร</label>
        <select class="form-select" name="job" required>
            <option value="">-- โปรดเลือก --</option>
            <option>Programmer</option>
            <option>Accounting Officer</option>
            <option>Marketing</option>
            <option>Technician</option>
        </select>
    </div>

    <!-- คำนำหน้า / ชื่อ -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <label class="form-label">คำนำหน้า</label>
            <select class="form-select" name="title" required>
                <option value="">-- เลือก --</option>
                <option>นาย</option>
                <option>นาง</option>
                <option>นางสาว</option>
            </select>
        </div>
        <div class="col-md-9 mb-3">
            <label class="form-label">ชื่อ-สกุล</label>
            <input type="text" class="form-control" name="fullname" required>
        </div>
    </div>

    <!-- วันเกิด -->
    <div class="mb-3">
        <label class="form-label">วันเดือนปีเกิด</label>
        <input type="date" class="form-control" name="birth" required>
    </div>

    <!-- ระดับการศึกษา -->
    <div class="mb-3">
        <label class="form-label">ระดับการศึกษา</label>
        <select class="form-select" name="edu" required>
            <option value="">-- เลือก --</option>
            <option>มัธยมศึกษาตอนปลาย</option>
            <option>ปวช./ปวส.</option>
            <option>ปริญญาตรี</option>
            <option>ปริญญาโท</option>
            <option>ปริญญาเอก</option>
        </select>
    </div>

    <!-- ความสามารถพิเศษ -->
    <div class="mb-3">
        <label class="form-label">ความสามารถพิเศษ</label>
        <textarea class="form-control" name="skill" rows="3"></textarea>
    </div>

    <!-- ประสบการณ์ทำงาน -->
    <div class="mb-3">
        <label class="form-label">ประสบการณ์ทำงาน</label>
        <textarea class="form-control" name="exp" rows="4"></textarea>
    </div>

    <!-- เบอร์ติดต่อ -->
    <div class="mb-3">
        <label class="form-label">เบอร์โทรศัพท์</label>
        <input type="tel" class="form-control" name="phone" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label">อีเมล</label>
        <input type="email" class="form-control" name="email" required>
    </div>

    <!-- ปุ่ม -->
    <div class="d-grid gap-2 mt-4">
        <button type="submit" class="btn btn-success">ส่งใบสมัคร</button>
        <button type="reset" class="btn btn-secondary">ล้างข้อมูล</button>
    </div>

</form>

</div>
</div>
</div>
</body>
</html>
