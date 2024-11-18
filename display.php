<?php
include 'Navbar.php';

require("connect.php");

$pid = 0;
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    //echo("ID:".$pid);
}
$status=2;
$name = "";
$age = 0;
$sex = "";
?>
<!DOCTYPE html>
<html>

<head>
    <title>insertion</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
            background-color: #f2f2f2;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
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
    <h1>Grade information</h1>
    <table border="1">
        <tr>
            <th width="10%">รหัสวิชา</th>
            <th width="50%">ชื่อรายวิชา</th>
            <th width="10%">semeters</th>
            <th width="15%">grade</th>
            <th width="5%">แก้ไข </th>
            <th width="5%">ลบ </th>
            </tr>
        <?php
        //echo("dasdas".$pid);
        $sql = "SELECT * FROM course WHERE owner_id=$pid";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['course_code'] . "</td>";
                echo "<td>" . $row['course_name'] . "</td>";
                echo "<td>" . $row['semeters'] . "</td>";
                echo "<td>" . $row['grade'] . "</td>";
                echo "<td><a href = 'edit.php?courseid=" . $row['course_id'] . "&pid=".$pid."'><button>Update</button></a></td>";
                echo "<td><a href = 'data.php?deletecourseid=" . $row['course_id'] . "&pid=".$pid."'onclick ='return confirm(\"คุณต้องการลบข้อมูลหรือไม่\")'><button>Delete</button></a></td>";
                echo "</tr>";
            }
        } else {
            echo "EMPTY!".$pid;
        }
        ?>
    </table>
    <div class="button-container">
        <?php if ($status == 1) echo ("<a href='TeacherMenu.php?pid=" . $pid . "'><button>Teacher Menu</button></a>"); ?>
        <?php if ($status == 2) echo ("<a href='StudentMenu.php?pid=" . $pid . "'><button>Student Menu</button></a>"); ?>
        <?php if ($status == 0) echo ("<a href='StaffMenu.php?pid=" . $staffId . "'><button>Staff Menu</button></a>"); ?>
    </div>
</body>

</html>

