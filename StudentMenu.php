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
    <title>Student Menu</title>
    <style>
        h1 {
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            border: 2px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
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
    <h1>เลือกเมนูนักศึกษา</h1>
    <br />
    <div>
        <a href="CheckTeacherInfo.php?pid=<?= $pid; ?>&status=2&staffid=0"><button>ตรวจสอบข้อมูลอาจารย์</button></a>
    </div>
    <br />
    <div>
        <a href="CheckStudentInfo.php?pid=<?= $pid; ?>&status=2&staffid=0"><button>ตรวจสอบข้อมูลนักศึกษา</button></a>
    </div>
    <br />
    <div>
    <a href="insertion.php?pid=<?= $pid;?>"><button>เพิ่มรายวิชา</button></a>
</div>
<br />
<div>
    <a href="display.php?pid=<?= $pid;?>"><button>ตรวจสอบข้อมูลรายวิชา</button></a>
</div>
    <br />  
    <div>
        <a href="login.php"><button>ลงชื่อออก</button></a>
    </div>
    

</body>

</html>