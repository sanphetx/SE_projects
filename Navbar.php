<?php
$pid = 0;
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    //echo("ID:".$pid);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style>


body {
    background-image: url('img/2.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.navbar {
  background-image: url('img/navBar1.png');
  background-color: #F3CD95;
  background-size:20%;
  background-repeat: no-repeat;
  background-position: left;
  position: fixed;
  top: 0;
  width: 100%;
  height: 100px;
  z-index: 1000;
}
body {
  padding-top: 100px; /* Adjust the value as needed */
}
</style>
</head>
<body>

<nav class="navbar navbar-default">
    </div>
    <a href='login.php' style="float: right;">
      <img src='img/enter.png' alt="Login" style="width: 80px; height: 70px; margin-top: 20px;margin-right: 10px;">
    </a>
  </div>
  
</nav>
</body>
</html>
