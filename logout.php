<?php
session_start();
session_unset();
session_destroy();
header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/login.php ');
exit;
?>