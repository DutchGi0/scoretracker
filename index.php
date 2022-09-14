<?php
session_start();
include_once 'DBconfig.php';
include_once 'header.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'homepage';
}
if ($page) {
    include 'pages/' . $page . '.php';
}
include_once 'footer.php';
