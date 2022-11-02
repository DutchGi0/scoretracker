<?php
// if user is logged in, redirect to homepage
if (isset($_SESSION['user'])) {
    header('location: index.php?page=homepage');
}

if (isset($_REQUEST['register_btn'])) {
    // filter and sanitize input
    $name = htmlspecialchars($_REQUEST['name']);
    $email = htmlspecialchars(strtolower($_REQUEST['email']));
    $password = strip_tags($_REQUEST['password']);
    // different error massages
    if (empty($name)) {
        $errorMsg[0][] = 'Enter your full name';
    }
    if (empty($email)) {
        $errorMsg[2][] = 'Enter your email address';
    }
    if (empty($password)) {
        $errorMsg[3][] = 'Enter your password';
    }
    if (strlen($password) < 5) {
        $errorMsg[3][] = 'Your password needs to be at least 5 characters long';
    }
    if (isset($_REQUEST['password_confirm'])) {
        $password_confirm = strip_tags($_REQUEST['password_confirm']);
        if ($password != $password_confirm) {
            $errorMsg[4][] = 'Your passwords do not match';
        }
    }
    // if no errors, check if email already exists
    if (empty($errorMsg)) {
        try {
            $select_stat = $db->prepare(
                'SELECT email FROM user WHERE email = :email'
            );
            $select_stat->execute([':email' => $email]);
            $row = $select_stat->fetch(PDO::FETCH_ASSOC);

            if (isset($row['email']) == $email) {
                $errorMsg[2][] = 'This email address is already used';
            } else {
                // if no errors, insert user into database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $instert_stat = $db->prepare(
                    'INSERT INTO user (name,email,password) VALUES (:name,:email,:password)'
                );

                if (
                    $instert_stat->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':password' => $hashed_password,
                    ])
                ) {
                    header('location: index.php?page=login');
                }
            }
        } catch (PDOException $e) {
            $pdoError = $e->getMessage();
        }
    }
}
?>
