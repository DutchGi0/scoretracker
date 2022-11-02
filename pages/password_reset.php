<?php
// if user is logged in redirect to movies page
if (isset($_SESSION['ID'])) {
    header('Location: index.php?page=movies');
} else {
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="js/movies.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <script src="https://google.com/recaptcha/api.js" async defer></script>
    <title>Stat Tracker - Password Reset</title>
</head>
<body>
    <!-- HTML FORM -->
    <div class="container">
        <h1 class='page-title uppercase'><span class='text-red'>P</span>assword <span class='text-red'>R</span>eset</h1>
        <br>
        <form method="post" action="">
            <div class="mb-3 ">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="" required>
            </div>
            <button type="submit" class="btn btn-dark uppercase right" name="submit">Reset password</button>
            <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
        </form>
    </div>
    <!-- END HTML FORM -->

            <?php if (isset($_POST['submit'])) {
                $error = '';
                $email = htmlspecialchars($_POST['email']);

                // Generate token with 32 random characters, check bin2hex() and random_bytes()
                $token = bin2hex(random_bytes(32));
                // Create a timestamp of today's date and time
                $timestamp = new DateTime('now');
                // check getTimestamp() for more information
                $timestamp = $timestamp->getTimestamp();
                //saving the token in the database
                try {
                    // Update the token in database user
                    $sql = 'UPDATE user SET `token` = ? WHERE `email` = ?';
                    $stmt = $db->prepare($sql);
                    $stmt = $stmt->execute([$token, $email]);
                    if (!$stmt) {
                        echo "<script>alert('Couldn't save in the databse.') </script>";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                //Makes the url for the reset page
                // Check sprintf() and dirname() if you want more explanation
                $url = sprintf(
                    '%s://%s',
                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'
                        ? 'https'
                        : 'http',
                    $_SERVER['HTTP_HOST'] .
                        dirname($_SERVER['PHP_SELF']) .
                        '/reset.php'
                );

                //Add the token and the timestamp to the url ie: localhost?token=12345&timestamp=1567891234
                $url = $url . '?token=' . $token . '&timestamp=' . $timestamp;

                // Mail() script
                $receiver = $email;
                $from = 'localgiomail@gmail.com';

                $subject = 'Stat Tracker - Password reset';
                // only with this header you will get the email in html format
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .=
                    'Content-Type: text/html; charset=iso=8859-1' . "\r\n";

                $message = '<html><body>';
                $message .= '<h1>Stat Tracker - Password reset</h1>';
                $message .= '<p>Dear user,</p>';
                $message .=
                    '<p>You have requested a password reset for your Stat Tracker account.</p>';
                $message .=
                    '<p>Please click on the following link to reset your password:</p>';
                $message .= '<p><a href="' . $url . '">' . $url . '</a></p>';
                $message .=
                    '<p>If you did not request a password reset, please ignore this email.</p>';
                $message .= '<p>Best regards,</p>';
                $message .= '<p>The Stat Tracker team</p>';
                $message .= '</body></html>';

                try {
                    // Check mail() for more information
                    mail($receiver, $subject, $message, $headers);
                    $error = 'Open your mail to reset your password.';
                } catch (Exception $e) {
                    $error = 'Couldn\'t send mail.';
                }
                echo "<div class='alert alert-danger'>$error</div>";
            } ?>
</body>
</html>
<?php
} ?>
