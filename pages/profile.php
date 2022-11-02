<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} else {
    ?>
<?php
// Select user from database
$sql = 'SELECT * FROM user INNER JOIN team ON user.id = team.id WHERE email = :email';
$stmt = $db->prepare($sql);
$stmt->execute([':email' => $_SESSION['E-MAIL']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.1.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Stat Tracker - Profile</title>
</head>
<?php foreach ($users as $user) {
    $id = $user['id']; 
    $goals = $user['goal'];
    $assists = $user['assist'];
    $team = $user['tm_name'];
    ?>
<body>
    <div class="container">
        <h1 class='title'>Account</h1>
        <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Account information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo 'Name: ' . $user['name']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo 'Email address: ' .
                            $_SESSION['E-MAIL']; ?></td>
                    </tr>
                    <tr>
                        <td>Password: ********</td>
                    </tr>
                    <tr>
                        <th>Team: <?php echo $team ?></th>
                    </tr>
                    <tr>
                        <th>Stats:</th>
                    </tr>
                    <tr>
                        <td>Goals: <?php echo $goals ?></td>
                    </tr>
                    <tr>
                        <td>Assists: <?php echo $assists ?></td>
                    </tr>
                    <tr><?php echo "<td><span class='right uppercase'> <a class='btn btn-primary' href='index.php?page=profile_edit&id=" .
                            $user['id'] .
                            "'>Edit profile</a></span></td>"; ?>
                </tbody>
            </table>
            <?php
} ?>
    </div>
</body>
</html>

<?php
} ?>
