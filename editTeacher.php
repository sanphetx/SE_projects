<?php
include 'Navbar.php';

require("connect.php");
if (isset($_GET['pid'])&&isset($_GET['status'])&&isset($_GET['staffid'])) {
    $id = (int)$_GET['pid'];
    $status = (int)$_GET['status'];
    $staffId = (int)$_GET['staffid'];
    //echo("ID:".$id);
    //echo("Status:".$status);
    $sql = "SELECT * FROM teacher WHERE id = $id";
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);
    if (!$result) {
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <title>Edit Teacher Personal information</title>
    <style>
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

        legend {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0px;
        }

        form {
            background-color: #f2f2f2;
        }
        </style>
</head>

<body>
    <form action="data.php" method="post">
        <fieldset>
            <legend>Edit Teacher Personal information:</legend>
            <lable>ชื่อ</lable><br>
            <input type="text" name="edit_name" required value="<?php echo $result['teacher_name'] ?>"><br>
            <lable>นามสกุล</lable><br>
            <input type="text" name="edit_lastname" required value="<?php echo $result['teacher_lastname'] ?>"><br>
            <lable>ตำแหน่ง</lable><br>
            <input type="text" name="edit_position" required value="<?php echo $result['position'] ?>"><br>
            <lable>ชื่อผู้ใช้งาน</lable><br>
            <input type="text" name="edit_username" required value="<?php echo $result['username'] ?>"><br>
            <lable>รหัสผ่าน</lable><br>
            <input type="text" name="edit_password" required value="<?php echo $result['password'] ?>"><br>
            <input type="hidden" name="edit_form_id" value="<?php echo $result['id'] ?>">
            <input type="hidden" name="edit_form_status" value="<?php echo $status ?>">
            <input type="hidden" name="edit_form_staff" value="<?php echo $staffId ?>">
            <input type="hidden" name="edit_form_staff_status" value="1">
            <p><input type="submit" value="Save"></p>
        </fieldset>
    </form>
    <div class="button-container">
        <?php if ($status == 1) echo ("<a href='TeacherMenu.php?pid=" . $pid . "'><button>Teacher Menu</button></a>"); ?>
        <?php if ($status == 2) echo ("<a href='StudentMenu.php?pid=" . $pid . "'><button>Student Menu</button></a>"); ?>
        <?php if ($status == 0) echo ("<a href='StaffMenu.php?pid=" . $staffId . "'><button>Staff Menu</button></a>"); ?>
    </div>
</body>

</html>