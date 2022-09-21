<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
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
    <script src="components\showpassword.js" defer></script>
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Stat Tracker - Edit Profile</title>
</head>
<body>
    <?php
    $sql = 'SELECT * FROM user WHERE ID= ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        $id = $user['ID']; ?>
    <div class="container">
        <h1 class='page-title uppercase'><span class='text-red'>E</span>dit Profile</h1>
        <br>
        <form action="" method="post">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th><input type="hidden" name="id" id="id" value="<?php echo $user[
                        'ID'
                    ]; ?>" /></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="name" class="form-control" id='name' placeholder="Name" value="<?php echo $_SESSION["USER_ID"]?>" required>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" id='email' value=<?php echo $_SESSION["E-MAIL"] ?> required>
                    </td>
                    <td>
                    </td>
                </tr>
                
            </tbody>
            <thead>
                <tr>
                    <th>Password</th>
                    <th><input type="hidden" name="id" id="id" value="<?php echo $user[
                        'ID'
                    ]; ?>" /></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="password" name="password" class="form-control" placeholder="Password" id='password' value='' required>
                        <input type="checkbox" onclick="showPassword()">Show Password
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="password_confirm" class="form-control" id='password' placeholder="Confirm Password" required>
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-dark" value="Submit">
        <span class="right"><a class="text-red" style="text-decoration: none;" href="index.php?page=profile">Back</a></span>
        </form>
    <?php
    }

    if (isset($_POST['password']) && isset($_POST['password_confirm'])) {
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        if ($password == $password_confirm) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE user SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
            $stmt = $db->prepare($query);
            $stmt->execute();
            echo '<script>alert("Password is successfully changed!")</script>';
            echo '<script>window.location.href="index.php?page=profile"</script>';
        } else {
            echo '<div class="alert alert-danger">';
            echo '<strong>Error!</strong> Password and Confirm Password are not the same!';
            echo '</div>';
        }
    }
    ?>
    </div>
</body>
</html>

<?php
} ?>
