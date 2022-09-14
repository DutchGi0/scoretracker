<?php

DEFINE('user', 'root');
DEFINE('password', '');
try {
    $db = new PDO('mysql:host=localhost;dbname=stattracker', user, password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    echo 'Kon geen verbinding maken';
}
