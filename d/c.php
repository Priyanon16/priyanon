<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ปรียานนท์ กรุตนิด (มินนี่)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title mb-0">ฟอร์มรับข้อมูล - ปรียานนท์ กรุตนิด (มินนี่) - Gemini</h1>
        </div>
        <div class="card-body">
            <form method="post" action="">
                
                <div class="mb-3">
                    <label for="fullname" class="form-label">ชื่อ-สกุล <span class="text-danger">*</span></label>
                    <input type="text" name="fullname" id="fullname" class="form-control" autofocus required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">เบอร์โทร <span class="text-danger">*</span></label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="height" class="form-label">ส่วนสูง (ซม.) <span class="text-danger">*</span></label>
                    <input type="number" name="height" id="height" class="form-control" min="100" max="200" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">ที่อยู่</label>
                    <textarea name="address" id="address" class="form-control" rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">วันเดือนปีเกิด</label>
                    <input type="date" name="birthday" id="birthday" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">สีที่ชอบ</label>
                    <input type="color" name="color" id="color" class="form-control form-control-color w-50" value="#000000"> 
                </div>

                <div class="mb-3">
                    <label for="major" class="form-label">สาขาวิชา</label>
                    <select name="major" id="major" class="form-select">
                        <option value="การบัญชี">การบัญชี</option>
                        <option value="การตลาด">การตลาด</option>
                        <option value="การจัดการ">การจัดการ</option>
                        <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
                    </select>
                </div>
                
                <hr>

                <div class="d-flex flex-wrap">
                    <button type="submit" name="Submit" class="btn btn-primary me-2 mb-2">สมัครสมาชิก</button>
                    <button type="reset" class="btn btn-secondary me-2 mb-2">ยกเลิก</button>
                    <button type="button" onClick="window.location='https://www.msu.ac.th/';" class="btn btn-info text-white me-2 mb-2">Go to MSU</button>
                    <button type="button" onMouseOver="alert('ต๊ะเอ๋');" class="btn btn-warning me-2 mb-2">Hello</button>
                    <button type="button" onClick="window.print();" class="btn btn-dark mb-2">พิมพ์</button>
                </div>

            </form>
        </div>
    </div>
    
    <?php
    if (isset ($_POST['Submit'])) {
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $height = $_POST['height'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        $color = $_POST['color'];
        $major = $_POST['major'];

        // ใช้ class alert ของ Bootstrap ในการแสดงผล
        echo "<div class='alert alert-success mt-4 shadow' role='alert'>";
        echo "<strong>ข้อมูลที่ถูกส่ง:</strong><br>";
        echo "ชื่อ-สกุล: " .$fullname."<br>";
        echo "เบอร์โทร: " .$phone."<br>";
        echo "ส่วนสูง: " .$height." ซม.<br>";
        echo "ที่อยู่: " .$address." <br>";
        echo "วันเดือนปีเกิด: " .$birthday." <br>";
        echo "สีที่ชอบ: " .$color." <br>"; // เพิ่มส่วนแสดงผลสีที่ชอบ
        echo "สาขาวิชา: " .$major." <br>";
        echo "</div>";
    }
    ?>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>