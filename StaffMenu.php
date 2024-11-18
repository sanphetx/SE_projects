<?php
include 'Navbar.php';

$pid = 0;
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    //echo ("ID:" . $pid);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Staff Menu</title>
    <style>
       

        h1 {
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            border: 2px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        div {
            text-align: center;
        }

        button {
            background-color: #ffffff;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ddd;
        }
        h1 {
            text-align: center;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f2f2f2;
            margin-bottom: 20px;
        }

        div {
            text-align: center;
        }
    
    </style>
</head>

<body>
    <h1>เลือกเมนูเจ้าหน้าที่</h1>
    <br />
    <div>
    <a href="insertTeacher.php?staffId=<?= $pid ?>"><button class="menu-button">เพิ่มอาจารย์</button></a>
    </div>
    <div>
    <a href="insertStudent.php?staffId=<?= $pid ?>"><button class="menu-button">เพิ่มนักศึกษา</button></a>
    </div>
    <div>
    <a href="CheckStudentInfo.php?pid=0&status=0&staffid=<?= $pid ?>"><button class="menu-button">ตรวจสอบข้อมูลนักศึกษา</button></a>
    </div>
    <div>
    <a href="CheckTeacherInfo.php?pid=0&status=0&staffid=<?= $pid ?>"><button class="menu-button">ตรวจสอบข้อมูลอาจารย์</button></a>
    </div>
    <div>
    <a href="login.php"><button class="menu-button">ลงชื่อออก</button></a>
    </div>
    <br />
</body>

</html>