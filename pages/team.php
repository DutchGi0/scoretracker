<?php 
// Select all users from database where user is in the team
$sql = 'SELECT * FROM user WHERE teamid = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM team WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$team = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $team['tm_name'];

$goals = 'SELECT sum(`goal`) as total FROM user WHERE teamid=:id;';
$stmt = $db->prepare($goals);
$stmt->execute(['id' => $_GET['id']]);
$goals = $stmt->fetchAll(PDO::FETCH_ASSOC);

$assists = 'SELECT sum(`assist`) as total FROM user WHERE teamid=:id;';
$stmt = $db->prepare($assists);
$stmt->execute(['id' => $_GET['id']]);
$assists = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Stat Tracker - <?php echo $name;
    ?></title>
</head>
<body>
    <div class="container">
        <!-- Shows Team Name -->
        <h1 class='title'><?php echo $name ?></h1>
        <div class="row">
            <div class="col-6">
                <!-- Shows total goals and assists -->
                <h2 class="h2-title">Goals</h2>
                <p class="h2-title"><?php foreach ($goals as $goal) {
                    echo $goal['total'];
                } ?></p>
            </div>
            <div class="col-6">
                <h2 class="h2-title">Assists</h2>
                <p class="h2-title"><?php foreach ($assists as $assist) {
                    echo $assist['total'];
                } ?></p>
            </div>
        </div>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Player</th>
                    <th>Goals</th>
                    <th>Assists</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) {
                    $id = $user['id'];
                    ?>
                <tr>
                    <!-- Display team member, goals and assist per team member -->
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['goal']; ?></td>
                    <td><?php echo $user['assist']; ?></td>
                </tr>
                <?php
                
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>