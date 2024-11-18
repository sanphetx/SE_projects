<?php
include 'Navbar.php';

$pid = 0;
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    //echo("ID:".$pid);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Teacher Menu</title>
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
    </style>
</head>

<body>

    <h1>เลือกเมนูอาจารย์ <?php
    ?></h1>
    <br />
    <div>
        <a href="CheckTeacherInfo.php?pid=<?= $pid; ?>&status=1&staffid=0"><button>ตรวจสอบข้อมูลอาจารย์</button></a>
    </div>
    <br />
    <div>
        <a href="CheckStudentInfo.php?pid=<?= $pid; ?>&status=1&staffid=0"><button>ตรวจสอบข้อมูลนักศึกษา</button></a>
    </div>
    <br />
    <div>
        <a href="login.php"><button>ลงชื่อออก</button></a>
    </div>
   

</body>

</html>
