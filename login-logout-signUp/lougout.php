<?php
session_start();
session_unset();
session_destroy();
if (isset($_GET['client'])):header('Location:../client/indexClient.php');else:header('Location:login_one.php');endif;
?>