<?php
require("connect.php");

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
//add new data form to mysql 
if (isset($_POST['student_name'])) {
    $status = (int)$_POST['status'];
    $studentName = $_POST['student_name'];
    $studentLastname = $_POST['student_lastname'];
    $studentCode = $_POST['code'];
    $studentUsername = $_POST['student_username'];
    $studentPassword = $_POST['student_password'];
    $staffId = $_POST['staffid'];
    $sql = "INSERT INTO student (student_name, student_lastname, code,username,password,status) VALUES ('$studentName', '$studentLastname', '$studentCode','$studentUsername','$studentPassword',2)";
    if (mysqli_query($conn, $sql)) {
        header("Location: CheckStudentInfo.php?pid=0&status=0&staffid=" . $staffId);
    } else {
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
}
if (isset($_POST['teacher_name'])) {
    $status = (int)$_POST['status'];
    $teacherName = $_POST['teacher_name'];
    $teacherLastname = $_POST['teacher_lastname'];
    $position = $_POST['position'];
    $course = $_POST['course'];
    $teacherUsername = $_POST['teacher_username'];
    $teacherPassword = $_POST['teacher_password'];
    $staffId = $_POST['staffid'];
    $sql = "INSERT INTO teacher (teacher_name, teacher_lastname, position,course,username,password,status) VALUES ('$teacherName', '$teacherLastname', '$position','$course','$teacherUsername','$teacherPassword',1)";
    if (mysqli_query($conn, $sql)) {
        header("Location: CheckTeacherInfo.php?pid=0&status=0&staffid=" . $staffId);
    } else {
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
}
//save edit data
if (isset($_POST['edit_form_id'])) {
    $name = $_POST['edit_name'];
    $lastname = $_POST['edit_lastname'];
    $status = $_POST['edit_form_status'];
    $username = $_POST['edit_username'];
    $password = $_POST['edit_password'];
    $id = (int)$_POST['edit_form_id'];
    $staffStatus = $_POST['edit_form_staff_status'];

    if ($status == 1) {
        $position = $_POST['edit_position'];
        $sql = "UPDATE teacher SET teacher_name='$name', teacher_lastname='$lastname' ,position = '$position',username ='$username',password='$password' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
            header("Location: TeacherMenu.php?pid=" . $id);
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    if ($status == 2) {
        $sql = "UPDATE student SET student_name='$name', student_lastname='$lastname',username ='$username',password='$password' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
            header("Location: StudentMenu.php?pid=" . $id);
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    if ($status == 0) {
        $staffId = $_POST['edit_form_staff'];
        if ($staffStatus == 1) {
            $position = $_POST['edit_position'];
            $sql = "UPDATE teacher SET teacher_name='$name', teacher_lastname='$lastname' ,position = '$position',username ='$username',password='$password' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
                header("Location: CheckTeacherInfo.php?pid=0&status=0&staffid=" . $staffId);
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
        if ($staffStatus == 2) {
            $advisor_id = $_POST['edit_teacherid'];
            if($advisor_id!=null){
                $sql = "UPDATE student SET student_name='$name', student_lastname='$lastname',username ='$username',password='$password',advisor_id=$advisor_id WHERE id=$id";
            }else{
                $sql = "UPDATE student SET student_name='$name', student_lastname='$lastname',username ='$username',password='$password' WHERE id=$id";
            }
            if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
                header("Location: CheckStudentInfo.php?pid=0&status=0&staffid=" . $staffId);
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
}
//delete data 
if (isset($_GET['staffid']) && isset($_GET['pid']) && isset($_GET['status'])) {
    $id = (int)$_GET['pid'];
    $status = (int)$_GET['status'];
    $staffId = (int)$_GET['staffid'];
    // sql to delete a record
    if ($status == 1) {
        $sql = "DELETE FROM teacher WHERE id= $id";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
            header("Location: CheckTeacherInfo.php?pid=0&status=0&staffid=" . $staffId);
        } else {
            echo "Error deleting record:" . mysqli_error($conn);
        }
    }
    if ($status == 2) {
        $sql = "DELETE FROM student WHERE id= $id";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
            header("Location: CheckStudentInfo.php?pid=0&status=0&staffid=" . $staffId);
        } else {
            echo "Error deleting record:" . mysqli_error($conn);
        }
    }
}

// ตรวจสอบว่ามีการส่งข้อมูลรายวิชาผ่าน POST หรือไม่
if (isset($_POST['course_code'])) {
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $semeters = $_POST['semeters'];
    $grade = $_POST['grade'];
    $owner_id = (int)$_POST['pid'];
    echo("<br>course_code:".$course_code);
    echo("<br>course_name:".$course_name);
    echo("<br>semeters:".$semeters);
    echo("<br>grade:".$grade);
    echo("<br>pid:".$owner_id);
    
    $sql ="INSERT INTO course (course_code , course_name  ,semeters, grade,owner_id) VALUES ('$course_code' ,'$course_name' ,'$semeters', '$grade',$owner_id)";

    if (mysqli_query($conn, $sql)) {
        header("Location: StudentMenu.php?pid=".$owner_id);
        echo "บันทึกข้อมูลรายวิชาเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
    }
}
//แก้ไขวิชา
if (isset($_POST['edit_course_code'])) {
    $course_code = $_POST['edit_course_code'];
    $course_name = $_POST['course_name'];
    $semeters = $_POST['semeters'];
    $grade = $_POST['grade'];
    $course_id = $_POST['course_id'];
    $owner_id = $_POST['owner_id'];
    
        $sql ="UPDATE  course SET course_code='$course_code' , course_name='$course_name'  ,semeters='$semeters', grade='$grade' WHERE course_id=$course_id";

    if (mysqli_query($conn, $sql)) {
        echo "บันทึกข้อมูลรายวิชาเรียบร้อยแล้ว";
        header("Location: display.php?pid=".$owner_id);
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
    }
}
//ลบ
if (isset($_GET['deletecourseid'])) {
    $course_id = $_GET['deletecourseid'];
    $owner_id = $_GET['pid'];
    
    $sql = "DELETE FROM course WHERE course_id= $course_id";

    if (mysqli_query($conn, $sql)) {
        echo "บันทึกข้อมูลรายวิชาเรียบร้อยแล้ว";
        header("Location: display.php?pid=".$owner_id);
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
    }
}
