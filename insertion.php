<?php
include 'Navbar.php';

require("connect.php");
$pid = 0;
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    echo ("ID:" . $pid);
}
$status = 2;
$name = "";
$age = 0;
$sex = "";

?>
<!DOCTYPE html>
<html>

<head>
    <title>บันทึกรายวิชา</title>
    <style>
        body {
            font-family: 'Sarabun PSK', sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            color: #0056b3;
        }

        .button-container {
            margin-top: 20px;
            justify-content: right;
        }

        .button-container a button {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: #000;
            font-size: 16px;
            transition: box-shadow 0.3s ease;
        }

        .button-container a button:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>
    <h1>บันทึกรายวิชา</h1>
    <br />
    <div>
        <form action="data.php" method="post">
            <fieldset>
                <legend>ข้อมูลรายวิชา:</legend>
                <label for="course_code">รหัสวิชา: (รูปแบบ: 123-123)</label><br>
                <input type="text" name="course_code" required pattern="[0-9]{3}-[0-9]{3}" title="รูปแบบที่ถูกต้อง: xxx-xxx"><br>
                <label for="course_name">ชื่อรายวิชา:</label><br>
                <input type="text" name="course_name" required><br>
                <label for="semeters">เทอมที่ลงเรียน (รูปแบบ: 1/2566):</label><br>
                <input type="text" name="semeters" id="semeters" required pattern="[0-9]+/[0-9]{4}" title="รูปแบบที่ถูกต้อง: x/xxxx"><br>
                <label for="grade">เกรด:</label><br>
<input type="hidden" name="pid" value="<?php echo $pid ?>">
<select id="grade" name="grade" required>
    <option value=""></option>
    <option value="A">A</option>
    <option value="B+">B+</option>
    <option value="B">B</option>
    <option value="C+">C+</option>
    <option value="C">C</option>
    <option value="D+">D+</option>
    <option value="D">D</option>
    <option value="P">P</option>
</select>

                <input type="submit" value="บันทึกข้อมูล">

            </fieldset>
        </form>
    </div>

    <div class="button-container">
        <?php if ($status == 1) echo ("<a href='TeacherMenu.php?pid=" . $pid . "'><button>Teacher Menu</button></a>"); ?>
        <?php if ($status == 2) echo ("<a href='StudentMenu.php?pid=" . $pid . "'><button>Student Menu</button></a>"); ?>
        <?php if ($status == 0) echo ("<a href='StaffMenu.php?pid=" . $staffId . "'><button>Staff Menu</button></a>"); ?>
    </div>
</body>

</html>
