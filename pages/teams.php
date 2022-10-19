<!-- Get teams DB -->
<?php
$sql = 'SELECT * FROM team INNER JOIN user ON team.userid = user.id';
$stmt = $db->prepare($sql);
$stmt->execute();
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/css/styles.css">    
    <title>Teams</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class='title'>Teams</h1>
        <br>
        <!-- Show teams in table -->
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Team</th>
                    <th>Goals</th>
                    <th>Assists</th>
                    <th>View team</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team) {
                    $id = $team['ID'];
                    $goals = $team['goal'];
                    $assists = $team['assist'];
                    // calculate team players
                    ?>
                <tr>
                    <td><?php echo $team['tm_name']; ?></td>
                    <td><?php echo $goals; ?></td>
                    <td><?php echo $assists; ?></td>
                    <td><?php echo "<span class='right uppercase'> <a class='btn btn-primary' href='index.php?page=team&id=" .
                            $team['id'] .
                            "'>View team</a></span>"; ?>
                </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>