<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
    header('Location: index.php?page=homepage');
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
    <script src="js/jquery-3.6.1.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Stat Tracker - Admin CP</title>
</head>
<body>
    <div class="container">
        <h1 class='title'>Admin CP</h1>
        <br>
        <!-- The movie overview, you can edit and delete movies from this overview -->
        <h2 class="h2-title">Users</h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Team</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT * FROM user INNER JOIN team ON user.teamid = team.id';
            $stmt = $db->prepare($sql);
            $stmt->execute([]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $id = $user['id'];
                echo '<tr>';
                echo '<td>' . $user['name'] . '</td>';
                echo '<td>' . $user['tm_name'] . '</td>';
                echo "<td><a style='text-decoration: none;' href='index.php?page=user_edit&id=" .
                    $user['id'] .
                    "'>&#9989;</a></td>";
                echo "<td><a onclick='javascript:confirmationDelete($(this));return false;' style='text-decoration: none;'  href='index.php?page=movies_delete&id=" .
                    $user['id'] .
                    "'>&#10062;</a></td>";
            }
            ?>
            </tbody>
        </table>

        <h2 class="h2-title">Teams</h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Team</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT * FROM team';
            $stmt = $db->prepare($sql);
            $stmt->execute([]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $id = $user['id'];
                echo '<tr>';
                echo '<td>' . $user['tm_name'] . '</td>';
                echo "<td><a style='text-decoration: none;' href='index.php?page=team_edit&id=" .
                    $user['id'] .
                    "'>&#9989;</a></td>";
                echo "<td><a onclick='javascript:confirmationDelete($(this));return false;' style='text-decoration: none;'  href='index.php?page=movies_delete&id=" .
                    $user['id'] .
                    "'>&#10062;</a></td>";
            }
            ?>
            </tbody>
        </table>
        <a class="btn btn-dark right" href="#" role="button">Add</a>
</div>
<script>
    function confirmationDelete(anchor){
        var conf = confirm('Are you sure want to delete this movie?');
        if(conf)
            window.location=anchor.attr("href");
    }
</script>

</body>
</html>
<?php
} ?>
