<?php
include 'Navbar.php';

require("connect.php");
$notHaveTeacher = false; // กำหนดเริ่มต้นเป็น false

if (isset($_GET['pid']) && isset($_GET['status']) && isset($_GET['staffid'])) {
    $pid = (int)$_GET['pid'];
    $staffId = (int)$_GET['staffid'];
    $status = (int)$_GET['status'];
    //echo ("ID:" . $pid);
    //echo ("Status:" . $status);
    if ($status == 1) {
        $sql = "SELECT * FROM teacher WHERE id = $pid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            $TName = $row['teacher_name'];
            $TSex = $row['teacher_lastname'];
            $TAge = $row['position'];
            $TUsername = $row['course'];
        }
    }
    if ($status == 2) {
        $sql = "SELECT teacher.teacher_name,teacher.teacher_lastname,teacher.position,teacher.course FROM teacher,student WHERE student.id = $pid AND teacher.id = student.advisor_id;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            $TName = $row['teacher_name'];
            $TSex = $row['teacher_lastname'];
            $TAge = $row['position'];
            $TUsername = $row['course'];
        } else {
            $notHaveTeacher = true;
        }
    }
    if ($status == 0) {
        $sql = "SELECT * FROM teacher";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            //echo ("nice");
        } else {
            echo ("error");
        }
    }
}

if (isset($_GET['searchInput']) && isset($_GET['pid']) && isset($_GET['status']) && isset($_GET['staffid'])) {
    $searchInput = mysqli_real_escape_string($conn, $_GET['searchInput']);
    $pid = (int)$_GET['pid'];
    $staffId = (int)$_GET['staffid'];
    $status = (int)$_GET['status'];
    if (is_numeric($searchInput)) {
        $searchInput = (int) $searchInput;
        $sql = "SELECT * FROM teacher WHERE teacher_name LIKE $searchInput OR teacher_lastname LIKE $searchInput OR id = $searchInput";
    } else {
        $sql = "SELECT * FROM teacher WHERE teacher_name LIKE '%$searchInput%' OR teacher_lastname LIKE '%$searchInput%'";
    }

    $result = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT * FROM teacher";
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html>

<head>
<title>CheckTeacherInfo</title>

    <style>
        .info-box {
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
    background-color: #f2f2f2;
}

.info-label {
    font-size: 40px;
    font-weight: bold;
}

.info-text {
    font-size: 20px;
    margin-bottom: 10px;
}

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

        h1 {
            text-align: center;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f2f2f2;
        }

        label {
            font-size: 30px;
            font-weight: bold;
            margin: 10px 0;
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

        input[type="text"] {
            width: 30%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: #000;
            font-size: 14px;
            transition: box-shadow 0.3s ease;
        }

        input[type="submit"]:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>
    <h1>หน้าตรวจสอบข้อมูลอาจารย์</h1>

    <?php
if ($status == 1) {
    echo ("<div class='info-box'>");
    echo "<label class='info-label'>Name:</label><span class='info-text'>" . $row['teacher_name'] . "</span><br>";
    echo "<label class='info-label'>Lastname:</label><span class='info-text'>" . $TSex . "</span><br>";
    echo "<label class='info-label'>Position:</label><span class='info-text'>" . $TAge . "</span><br>";
    echo "<label class='info-label'>Course:</label><span class='info-text'>" . $TUsername . "</span><br>";
    echo "<td><a href='editTeacher.php?pid=" . $pid . "&status=1&staffid=0'><button>Update</button></a></td>";
    echo "</div>";
}
if ($status == 2) {
    if ($notHaveTeacher) {
        echo ("<div class='info-box'>");
        echo "You don't have Advisor right now!";
        echo "</div>";
    } else {
        echo ("<div class='info-box'>");
        echo "<label class='info-label'>Name:</label><span class='info-text'>" . $TName . "</span><br>";
        echo "<label class='info-label'>Lastname:</label><span class='info-text'>" . $TSex . "</span><br>";
        echo "<label class='info-label'>Position:</label><span class='info-text'>" . $TAge . "</span><br>";
        echo "<label class='info-label'>Course:</label><span class='info-text'>" . $TUsername . "</span><br>";
        echo "</div>";
    }
}
?>

    </div>
    <?php
    if ($status == 0) {
        echo ('<label>ค้นหา</label>
        <form action="CheckTeacherInfo.php" method="GET" >
        <input type="text" name="searchInput" placeholder="ค้นหาชื่ออาจารย์..">
        <input type="hidden" name ="pid"value="<?php echo $pid ?>">
        <input type="hidden" name ="status"value="<?php echo $status ?>">
        <input type="hidden" name ="staffid"value="<?php echo $staffId ?>">
        <input type="submit" value="ค้นหา">
        </form>');
        echo ("<table>");
        echo ("<tr>");
        echo ("<th width='5%'>ลำดับ</th>");
        echo ("<th width='20%'>ชื่อ</th>");
        echo ("<th width='20%'>นามสกุล</th>");
        echo ("<th width='17.5%'>ตำแหน่ง</th>");
        echo ("<th width='17.5%'>สาขาวิชา</th>");
        echo "<th width='10%'>แก้ไข</th>";
        echo "<th width='10%'>ลบ</th>";
        echo ("</tr>");
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ($i + 1) . "</td>";
                echo "<td>" . $row['teacher_name'] . "</td>";
                echo "<td>" . $row['teacher_lastname'] . "</td>";
                echo "<td>" . $row['position'] . "</td>";
                echo "<td>" . $row['course'] . "</td>";
                echo "<td><a href='editTeacher.php?pid=" . $row['id'] . "&status=" . $status . "&staffid=" . $staffId . "'><button>Update</button></a></td>";
                echo "<td><a href='data.php?staffid=" . $staffId . "&pid=" . $row['id'] . "&status=" . $row['status'] . "' onclick='return confirm(\"คุณต้องการลบข้อมูลหรือไม่\")'><button>Delete</button></a></td>";
                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='5'>ไม่พบข้อมูล!</td></tr>";
        }
    }
    echo ("</table>");
    ?>
    <div class="button-container">
        <?php if ($status == 1) echo ("<a href='TeacherMenu.php?pid=" . $pid . "'><button>Teacher Menu</button></a>"); ?>
        <?php if ($status == 2) echo ("<a href='StudentMenu.php?pid=" . $pid . "'><button>Student Menu</button></a>"); ?>
        <?php if ($status == 0) echo ("<a href='StaffMenu.php?pid=" . $staffId . "'><button>Staff Menu</button></a>"); ?>
    </div>
</body>

</html>