<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (isset($_SESSION['ID'])) {
    header('Location: index.php?page=homepage');
} else {
     ?>
     <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="components\showpassword.js" defer></script>
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <script src="https://google.com/recaptcha/api.js" async defer></script>

    <title>Stats Tracker - Login</title>
</head>
<body>
    <div class="container container--login">
        <h1 class='page-title uppercase'><span class='text-red'>L</span>ogin</h1>
        <br>
        <form method="POST">
            <div class="mb-3 text-white">
                <!-- login via email -->
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3 text-white">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <input type="checkbox" onclick="showPassword()">Show Password
            </div>

            <!-- <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div> -->
            <button type="submit" name="submit" class="btn btn-primary">Login</button> 
            <span class="right">Forgot your password? <a style="text-decoration: none;" class="text-red" href="index.php?page=password_reset">Reset here</a></span>
            <br>
                <?php if (isset($_POST['submit'])) {
                    $error = '';
                    // Filters the email and password
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    try {
                        // Select the user email from the database
                        $sql = 'SELECT * FROM user WHERE email = ?';
                        $stmt = $db->prepare($sql);
                        $stmt->execute([$email]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($result) {
                            $passwordInDB = $result['password'];
                            $rol = $result['is_admin'];
                            // Check if the password is correct
                            if (password_verify($password, $passwordInDB)) {
                                $_SESSION['ID'] = session_id();
                                $_SESSION['USER_ID'] = $result['name'];
                                $_SESSION['E-MAIL'] = $result['email'];
                                $_SESSION['STATUS'] = 'ACTIEF';
                                $_SESSION['ROL'] = $rol;
                                if ($rol == 0) {
                                    echo "<script>location.href='index.php?page=profile'</script>";
                                } elseif ($rol == 1) {
                                    echo "<script>location.href='index.php?page=homepage'</script>";
                                } else {
                                    $error .= 'Access denied<br>';
                                }
                            } else {
                                $error .= 'Email or password is incorrect<br>';
                            }
                        } else {
                            $error .= 'Email or password is incorrect<br>';
                        }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                    echo "<div class='alert alert-warning text-dark'>$error</div>";
                } ?>
            <br>
        </form>
    </div>
    <script>
        
    </script>
</body>
</html>
<?php
} ?>
