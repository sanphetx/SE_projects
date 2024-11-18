<?php
include 'Navbar.php';
require('connect.php');
if (isset($_GET['uname']) && isset($_GET['passw'])) {
    $userName = $_GET['uname'];
    $passWord = $_GET['passw'];

    
    $sql = "SELECT username, password, status, id
        FROM (
          SELECT username, password, status, id FROM teacher
          UNION ALL
          SELECT username, password, status, id FROM student
          UNION ALL
          SELECT username, password, status, id FROM staff
        ) AS combined
        WHERE username = '" . $userName . "'
        LIMIT 1;";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $dbPassword = $row['password'];
        $status = $row['status'];
        $pid = $row['id'];

        // Verify the password
        if ($passWord == $dbPassword) {
            // Login successful
            if ($status == 0) {
                header("Location: StaffMenu.php?pid=" . $pid);
            }
            if ($status == 1) {
                header("Location: TeacherMenu.php?pid=" . $pid);
            }
            if ($status == 2) {
                header("Location: StudentMenu.php?pid=" . $pid);
            }
        } else {
            // Incorrect password
            echo '<script type="text/javascript">
                    alert("รหัสผิดพลาด!");
                    window.location.href = "index.php";
                  </script>';
        }
    } else {
        // User not found
        echo '<script type="text/javascript">
                alert("ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด!");
              </script>';
    }

    mysqli_free_result($result);
}

?>
<!DOCTYPE html>
<html>

<head>
   
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
            margin: 0;
        }

        form {
    text-align: center;
    padding: 20px;
    border: 2px solid #007BFF; 
    border-radius: 20px; 
    width: 900px;
    height: 400px;
    background-color: #f2f2f2;
    
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
}

label {
    font-size: 20px;
    margin-right: 85%;
}


input[type="text"] {
    width: 95%;
    padding: 10px;
    margin: 30px auto; /* เพิ่ม margin ด้วยค่าที่คุณต้องการ */
    border: 1px solid #ccc;
    border-radius: 50px;
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
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <form action="login.php" method="get">
        <fieldset>
            <legend>Login</legend>
            <label>Username</label><br>
            <input type="text" name="uname"><br>
            <label>Password</label><br>
            <input type="text" name="passw"><br><br>
            <input type="submit" value="Login">
        </fieldset>
    </form>
</body>

</html>
