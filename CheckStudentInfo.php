<?php
include 'Navbar.php';

require("connect.php");
if (isset($_GET['pid']) && isset($_GET['status']) && isset($_GET['staffid'])) {
    $pid = (int)$_GET['pid'];
    $staffId = (int)$_GET['staffid'];
    $status = (int)$_GET['status'];
    //echo ("ID:" . $pid);
    //echo ("Status:" . $status);
    //echo ("StaffID:" . $staffId);
}
if ($status == 1) {
    $sql = "SELECT * FROM student WHERE advisor_id = $pid";
    $result = mysqli_query($conn, $sql);
}
if ($status == 2) {
    $sql = "SELECT * FROM student WHERE id = $pid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    //echo ("What da hail!");
    //echo ("Name:" . $row['student_name']);
}
if ($status == 0) {
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);
}
if (isset($_GET['searchInput']) && isset($_GET['pid']) && isset($_GET['status']) && isset($_GET['staffid'])) {
    $searchInput = mysqli_real_escape_string($conn, $_GET['searchInput']);
    $pid = (int)$_GET['pid'];
    $staffId = (int)$_GET['staffid'];
    $status = (int)$_GET['status'];
    if (is_numeric($searchInput)) {
        $searchInput = (int) $searchInput;
        $sql = "SELECT * FROM student WHERE student_name LIKE $searchInput OR student_lastname LIKE $searchInput OR code LIKE $searchInput OR id = $searchInput";
    } else {
        $sql = "SELECT * FROM student WHERE student_name LIKE '%$searchInput%' OR student_lastname LIKE '%$searchInput%' OR code LIKE '$searchInput'";
    }

    $result = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);
}



// $sql = "SELECT * FROM student WHERE id = $pid";
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
// if (mysqli_num_rows($result) > 0) {
//     $TName = $row['teacher_name'];
//     $TSex = $row['teacher_lastname'];
//     $TAge = $row['position'];
//     $TUsername = $row['course'];
// } else {
//     echo "EMPTY!";
//     echo $pid;
// }
?>
<!DOCTYPE html>
<html>

<head>
<title>CheckStudentInfo</title>

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

       /* เพิ่ม CSS สำหรับกรอบ */
.info-box {
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
    background-color: #f2f2f2;
}

/* สไตล์สำหรับปุ่มใน button-container */
.button-container {
    display: flex;
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
    <h1>ตรวจสอบข้อมูลนักศึกษา</h1>
    <?php
    if ($status == 2) {
        echo ("<div class='info-box'>");
        echo ("<label>Name:</label>" . $row['student_name'] . "<br>");
        echo ("<label>Lastname:</label>" . $row['student_lastname'] . "<br>");
        echo ("<label>Code:</label>" . $row['code'] . "<br>");
        echo "<td><a href='editStudent.php?pid=" . $pid . "&status=2&staffid=0'><button>Update</button></a></td>";
        echo ("<div class='button-container'>");
        echo "</div>";
        echo "</div>";
    }
    if ($status == 0 || $status == 1) {
        echo ("<table>");
        echo ("<tr>");
        if ($status == 1) {
            echo ("<th width='5%'>ลำดับ</th>");
            echo ("<th width='30%'>ชื่อ</th>");
            echo ("<th width='30%'>นามสกุล</th>");
            echo ("<th width='20%'>รหัสนักศึกษา</th>");
        }

        if ($status == 0) {
            echo ("<th width='5%'>ลำดับ</th>");
            echo ("<th width='30%'>ชื่อ</th>");
            echo ("<th width='30%'>นามสกุล</th>");
            echo ("<th width='20%'>รหัสนักศึกษา</th>");
            echo "<th width='5%'>จัดการที่ปรึกษา</th>";
            echo "<th width='5%'>แก้ไข</th>";
            echo "<th width='5%'>ลบ</th>";
        }
        echo ("</tr>");
        if ($status == 1) {
            $i = 1;
            if (mysqli_num_rows($result) > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . ($i + 1) . "</td>";
                    echo "<td>" . $row['student_name'] . "</td>";
                    echo "<td>" . $row['student_lastname'] . "</td>";
                    echo "<td>" . $row['code'] . "</td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr><td colspan='5'>EMPTY!</td></tr>";
            }
        }
        if ($status == 0) {
            echo ('<label>ค้นหา</label><br>
                <form action="CheckStudentInfo.php" method="GET" >
                <input type="text" name="searchInput" placeholder="ค้นหาชื่อนักศึกษา..">
                <input type="hidden" name ="pid"value="<?php echo $pid ?>">
                <input type="hidden" name ="status"value="<?php echo $status ?>">
                <input type="hidden" name ="staffid"value="<?php echo $staffId ?>">
                <input type="submit" value="ค้นหา">
                </form>');
            $i = 1;
            if (mysqli_num_rows($result) > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . ($i + 1) . "</td>";
                    echo "<td>" . $row['student_name'] . "</td>";
                    echo "<td>" . $row['student_lastname'] . "</td>";
                    echo "<td>" . $row['code'] . "</td>";
                    echo "<td><a href='assignAdvisor.php?pid=" . $row['id'] . "&status=" . $status . "&staffid=" . $staffId . "'><button>Add</button></a></td>";
                    echo "<td><a href='editStudent.php?pid=" . $row['id'] . "&status=" . $status . "&staffid=" . $staffId . "'><button>Update</button></a></td>";
                    echo "<td><a href='data.php?staffid=" . $staffId . "&pid=" . $row['id'] . "&status=" . $row['status'] . "' onclick='return confirm(\"คุณต้องการลบข้อมูลหรือไม่\")'><button>Delete</button></a></td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr><td colspan='5'>EMPTY!</td></tr>";
            }
        }
        echo ("</table>");
    }
    ?>


    <div class="button-container">
        <?php if ($status == 1) echo ("<a href='TeacherMenu.php?pid=" . $pid . "'><button>Teacher Menu</button></a>"); ?>
        <?php if ($status == 2) echo ("<a href='StudentMenu.php?pid=" . $pid . "'><button>Student Menu</button></a>"); ?>
        <?php if ($status == 0) echo ("<a href='StaffMenu.php?pid=" . $staffId . "'><button>Staff Menu</button></a>"); ?>
    </div>

</body>

</html>