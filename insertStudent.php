<?php
include 'Navbar.php';

require("connect.php");
if(isset($_GET['staffId'])){
    $staffId = $_GET['staffId'];
    //echo("StaffId:".$staffId);
}
$status = 0;
$name = "";
$age = 0;
$sex = "";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Insertion</title>
    <style>
        body {
            display: grid;
            justify-content: center;
            align-items: center;
            height: 90vh;
            margin: 0;
        }

        form {
            text-align: center;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 20px;
            width: 800px;
            height: 550px;
            background-color: #f2f2f2;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin: 8px 0;
        }

        .form-group label {
            flex: 1;
            padding-right: 10px;
            font-size: 18px;
        }

        .form-group input {
            flex: 8;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        label {
            font-size: 18px;
        }

        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align:left;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        fieldset {
            border: none;
            margin: 0;
            padding: 0;
        }

        legend {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container a button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .button-container a button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div>
        <form action="data.php" method="post">
            <fieldset>
                <legend>Insert Student Personal Information:</legend>
                <div class="form-group">
                    <label for="student_name">ชื่อ:</label><br>
                    <input type="text" id="student_name" name="student_name"><br>
                </div>
                <div class="form-group">
                    <label> สกุล:</label><br>
                    <input type="text" name="student_lastname"><br>
                </div>
                <div class="form-group">
                    <label> รหัสนักศึกษา:</label><br>
                    <input type="text" name="code"><br>
                </div>
                <div class ="form-group">
                    <label> Username:</label><br>
                    <input type="text" name="student_username"><br>
                </div>
                <div class="form-group">
                    <label> Password:</label><br>
                    <input type="text" name="student_password"><br>
                </div>
                <input type="hidden" name="staffid" value="<?php echo $staffId ?>">
                <input type="hidden" name="status" value="2">
                <br>
                <input type="submit" value="เพิ่มนักศึกษา">
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
