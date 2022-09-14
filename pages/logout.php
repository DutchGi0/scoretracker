<?php
unset($_SESSION['ID']);
unset($_SESSION['USER_ID']);
unset($_SESSION['STATUS']);
unset($_SESSION['E_MAIL']);
unset($_SESSION['ROL']);
session_destroy();
$db = null;
header('location: index.php?page=homepage');
?>
