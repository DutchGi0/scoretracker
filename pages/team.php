<?php 
$sql = 'SELECT * FROM user INNER JOIN team ON user.teamid = team.id';
$stmt = $db->prepare($sql);
$stmt->execute();
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC); 

$sql = 'SELECT * FROM team WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$team = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $team['tm_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stat Tracker - <?php echo $name;
    ?></title>
</head>
<body>
    <div class="container">
        <h1 class='title'><?php echo $name ?></h1>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Player</th>
                    <th>Goals</th>
                    <th>Assists</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team) {
                    $id = $team['id'];
                    ?>
                <tr>
                    <td><?php echo $team['name']; ?></td>
                    <td><?php echo $team['goal']; ?></td>
                    <td><?php echo $team['assist']; ?></td>
                </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>