<?php
include 'Navbar.php';

require("connect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>insertion</title>
</head>

<body>
    <table border="1">
        <tr>
            <th width="5%">ลำดับ</th>
            <th width="50%">ชื่อ</th>
            <th width="10%">อายุ</th>
            <th width="15%">เพศ</th>
        </tr>
        <?php
        $sql = "SELECT * FROM student";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['student_lastname'] . "</td>";
                echo "<td>" . $row['code'] . "</td>";
                echo "<td><a href = 'editStudent.php?id=" . $row['id'] . "'><button>Update</button></a></td>";
                echo "<td><a href = 'data.php?delete_id=" . $row['id'] . "'onclick ='return confirm(\"คุณต้องการลบข้อมูลหรือไม่\")'><button>Delete</button></a></td>";
                echo "</tr>";
                $i++;
            }
        } else {
            echo "EMPTY!";
        }
        ?>
    </table>
    <br><a href='index.php'>Bact To Main</a>
</body>

</html>