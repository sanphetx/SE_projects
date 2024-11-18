<?php
require("connect.php");
include 'Navbar.php';
if (isset($_GET['courseid']) && isset($_GET['pid'])) {
    $course_id = (int)$_GET['courseid'];
    $pid = $_GET['pid'];
    echo ("ID:" . $pid);
    echo ("ID:" . $course_id);


    $sql = "SELECT * FROM course WHERE course_id = $course_id";
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);

    echo ("course_name" . $result['course_name']);
    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <title>Edit รายวิชา</title>
</head>

<body>
    <form action="data.php" method="post">
        <fieldset>
            <legend>information:</legend>
            <lable>รหัสวิชา</lable><br>
            <input type="text" name="edit_course_code" required value="<?php echo $result['course_code'] ?>"><br>
            <lable>ชื่อ</lable><br>
            <input type="text" name="course_name" required value="<?php echo $result['course_name'] ?>"><br>
            <lable>เทอม</lable><br>
            <input type="text" name="semeters" required value="<?php echo $result['semeters'] ?>"><br>
            <input type="hidden" name="course_id" value="<?php echo $result['course_id'] ?>">
            <input type="hidden" name="owner_id" value="<?php echo $pid ?>">
            <label for="grade">เกรด:</label><br>
            <select id="grade" name="grade">
                <option value="A" <?php if ($result['grade'] === 'A') echo 'selected'; ?>>A</option>
                <option value="B+" <?php if ($result['grade'] === 'B+') echo 'selected'; ?>>B+</option>
                <option value="B" <?php if ($result['grade'] === 'B') echo 'selected'; ?>>B</option>
                <option value="C+" <?php if ($result['grade'] === 'C+') echo 'selected'; ?>>C+</option>
                <option value="C" <?php if ($result['grade'] === 'C') echo 'selected'; ?>>C</option>
                <option value="D+" <?php if ($result['grade'] === 'D+') echo 'selected'; ?>>D+</option>
                <option value="D" <?php if ($result['grade'] === 'D') echo 'selected'; ?>>D</option>
                <option value="P" <?php if ($result['grade'] === 'P') echo 'selected'; ?>>P</option>
            </select>


            <input type="submit" value="Save">
        </fieldset>
    </form>
    <div class="button-container">
        
        <?php echo ("<a href='StudentMenu.php?pid=" . $pid . "'><button>Student Menu</button></a>"); ?>
       
    </div>
</body>

</html>