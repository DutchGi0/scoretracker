<!-- Get teams DB -->
<?php
// Select all teams from database
$sql = 'SELECT *  FROM team ';
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
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.1.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>  
    <title>Stat Tracker - Teams</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class='title'>Teams</h1>
        <br>
        <!-- Show teams in table -->
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Team</th>
                    <th scope="col">View team</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team) {
                    $id = $team['id'];
                    ?>
                <tr>
                    <!-- Display teams -->
                    <td><?php echo $team['tm_name']; ?></td>
                    <td><?php echo "<span class='uppercase'> <a class='btn  btn-outline-secondary' href='index.php?page=team&id=" .
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
