<?php
include 'Navbar.php';

$staffId = 0;
require("connect.php");
if (isset($_GET['pid']) && isset($_GET['status']) && isset($_GET['staffid'])) {
    //echo ("StaffId:" . $staffId);
    $id = (int)$_GET['pid'];
    $status = (int)$_GET['status'];
    $staffId = (int)$_GET['staffid'];
    //echo ("ID:" . $id);
    //echo ("Status:" . $status);
    $sql = "SELECT * FROM student WHERE id = $id";
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);
    if (!$result) {
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
}
if (isset($_GET['searchInput'])) {
    $searchInput = mysqli_real_escape_string($conn, $_GET['searchInput']);
    $pid = (int)$_GET['pid'];
    $staffId = (int)$_GET['staffid'];
    $status = (int)$_GET['status'];

    //echo ("ID:" . $pid);
    //echo ("Status:" . $status);
    $sql = "SELECT * FROM student WHERE id = $pid";
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);
    if (!$result) {
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }

    if (is_numeric($searchInput)) {
        $searchInput = (int) $searchInput;
        $sql = "SELECT * FROM teacher WHERE teacher_name LIKE $searchInput OR teacher_lastname LIKE $searchInput OR id = $searchInput";
    } else {
        $sql = "SELECT * FROM teacher WHERE teacher_name LIKE '%$searchInput%' OR teacher_lastname LIKE '%$searchInput%'";
    }

    $result_teacher = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT * FROM teacher";
    $result_teacher = mysqli_query($conn, $sql);
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <title>Edit Personal Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
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

        input[type="text"] {
            width: 60%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #008CBA;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #005F7B;
        }

        .button-container {
            text-align: right;
            margin-top: 20px;
        }

        .button-container a button {
            background-color: #fff;
            border: 1px solid #ccc;
            color: #000;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .button-container a button:hover {
            background-color: #ccc;
        }

        form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
        }

        legend {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="data.php" method="post">
            <fieldset>
                <legend>Personal Information:</legend>
                <p><label>ชื่อ-สกุล: <?php echo $result['student_name'] . " " . $result['student_lastname']; ?></label></p>
                <p><label>รหัสนักศึกษา: <?php echo $result['code']; ?></label></p>
                <label>ระบุ ID อาจารย์: <?php echo $result['advisor_id']; ?></label><br>
                <input type="hidden" name="edit_name" value="<?php echo $result['student_name'] ?>">
                <input type="hidden" name="edit_lastname" value="<?php echo $result['student_lastname'] ?>">
                <input type="hidden" name="edit_username" value="<?php echo $result['username'] ?>">
                <input type="hidden" name="edit_password" value="<?php echo $result['password'] ?>">
                <input type="hidden" name="edit_form_id" value="<?php echo $result['id'] ?>">
                <input type="hidden" name="edit_form_status" value="<?php echo $status ?>">
                <input type="hidden" name="edit_form_staff" value="<?php echo $staffId ?>">
                <input type="hidden" name="edit_form_staff_status" value="2">
                <input type="text" name="edit_teacherid" required value="<?php echo $result['advisor_id'] ?>">
                <input type="submit" value="Save">
            </fieldset>
        </form>
        <form action="assignAdvisor.php" method="GET">
            <input type="text" name="searchInput" placeholder="ค้นหาชื่ออาจารย์..">
            <input type="hidden" name="pid" value="<?php echo $id ?>">
            <input type="hidden" name="status" value="<?php echo $status ?>">
            <input type="hidden" name="staffid" value="<?php echo $staffId ?>">
            <input type="submit" value="ค้นหา">
        </form>
        <div class="button-container">
            <?php if ($status == 0) echo ("<a href='StaffMenu.php?pid=" . $staffId . "'><button>Staff Menu</button></a>"); ?>
        </div>
        <table>
            <tr>
                <th width='5%'>ลำดับ</th>
                <th width='15%'>ID</th>
                <th width='20%'>ชื่อ</th>
                <th width='20%'>นามสกุล</th>
                <th width='20%'>ตำแหน่ง</th>
                <th width='20%'>สาขาวิชา</th>
            </tr>
            <?php
            if (mysqli_num_rows($result_teacher) > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result_teacher)) {
                    echo "<tr>";
                    echo "<td>" . ($i + 1) . "</td>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['teacher_name'] . "</td>";
                    echo "<td>" . $row['teacher_lastname'] . "</td>";
                    echo "<td>" . $row['position'] . "</td>";
                    echo "<td>" . $row['course'] . "</td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr><td colspan='5'>ไม่พบข้อมูล!</td></tr>";
            }
            ?>
        </table>
        
    </div>
</body>

</html>