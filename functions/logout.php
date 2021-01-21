<?php
session_start();
<<<<<<< HEAD
unset($_SESSION["user"]);
=======
unset($_SESSION["staff_id"]);
>>>>>>> 48474e60d9bd94751050ad52ecd0476f632e2d9f
session_destroy();
header("Location:../login.php");
?>