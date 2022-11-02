<?php include_once 'DBconfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="components/jquery-3.6.1.min.js" defer></script>
    <script src="components/password.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <script src="https://google.com/recaptcha/api.js" async defer></script>
    <title>Stat Tracker - Reset Password</title>
</head>
<body>
    <div class="container">
        <h1 class='title uppercase'>Reset Password</h1>
        <br>
        <form name="passwordReset" action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="someone@example.com" required>
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" id='password' value='' required>
                <input type="checkbox" onclick="showPassword()">Show Password
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-dark uppercase" name="submit">Reset password</button>
        </form>
    </div>
</body>
</html>

<?php if (isset($_POST['submit'])) {
    if (isset($_GET['token']) && isset($_GET['timestamp'])) {
        // Get the token and timestamp from the URL
        $token = $_GET['token'];
        $timestamp1 = $_GET['timestamp'];
        //check email is valid with token
        $email = htmlspecialchars($_POST['email']);
        // Set the password in the hashed password
        $password = htmlspecialchars($_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        try {
            // Checks for the token with the email
            $sql = 'SELECT * FROM user where email = ? AND token = ?';
            $stmt = $db->prepare($sql);
            $stmt->execute([$email, $token]);
            $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
            //check if the token is valid
            if ($stmt) {
                // Creates a second timestamp to get the difference between the first and second timestamp
                $timestamp2 = new DateTime('now');
                $timestamp2 = $timestamp2->getTimestamp();
                //if the token is valid and the email is valid, reset the password and the timestamp difference is less than 12 hours update password
                if ($timestamp2 - $timestamp1 < 43200) {
                    $query = 'UPDATE user SET password = ? WHERE email = ?';
                    $stmt = $db->prepare($query);
                    $stmt->execute([$passwordHash, $email]);
                    if ($stmt) {
                        echo "<script>alert('Password has been successfully resetted.');
                            location.href='./index.php?page=login';</script>";
                    }
                } else {
                    echo "<script>alert('Link isn't valid anymore.');
                            location.href='./index.php';</script>";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
