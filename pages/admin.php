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
    <script src="components/jquery-3.6.1.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Stat Tracker - Admin CP</title>
</head>
<body>
    <div class="container">
        <h1 class='title'>Admin CP</h1>
        <br>
        
        <!-- search bar for users -->
        <form action="index.php?page=admin" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search for user" name="searchUser">
                <button class="btn btn-dark btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <?php
            // show search results
            if (isset($_POST['searchUser'])) {
                ?>
                <h3 class="h3-title">User Search Results:</h3>
                <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <?php
                $search = $_POST['searchUser'];
                $sql = "SELECT user.id, user.name, user.is_admin, team.tm_name FROM user INNER JOIN team ON user.teamid = team.id WHERE user.name LIKE '%$search%';";
                $stmt = $db->prepare($sql);
                $stmt->execute([]);
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($users as $user) {
                    $id = $user['id'];
                    echo '<tr>';
                    echo '<td class="user">' . $user['name'] . '</td>';
                    echo '</tr>';
                }
                ?>
                </table>
                <?php
            }
        ?>
        <h2 class="h2-title">Users</h2>
        <br>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Team</th>
                <th scope="col">Admin</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <!-- Display users -->
            <?php
            $sql = 'SELECT user.id, user.name, user.is_admin, team.tm_name FROM user INNER JOIN team ON user.teamid = team.id;';
            $stmt = $db->prepare($sql);
            $stmt->execute([]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $id = $user['id'];
                if ($user['is_admin'] == 0) {
                    $admin = '<span class="text-red">&#10060;</span>';
                } else {
                    $admin = '<span class="text-green">&#10004;</span>';
                }
                echo '<tr>';
                echo '<td>' . $user['name'] . '</td>';
                echo '<td>' . $user['tm_name'] . '</td>';
                echo '<td>' . $admin . '</td>';
                echo "<td><a style='text-decoration: none;' href='index.php?page=user_edit&id=" .
                    $user['id'] .
                    "'>&#9989;</a></td>";
                echo "<td><a onclick='javascript:confirmationDelete($(this));return false;' style='text-decoration: none;'  href='index.php?page=user_delete&id=" .
                    $user['id'] .
                    "'>&#10062;</a></td>";
                echo '<td></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

        <div class="line"></div>

        <br>
        
        <!-- searchbar for teams -->
        <form action="index.php?page=admin" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search for team" name="searchTeam">
                <button class="btn btn-dark btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <?php
            // results of search teams
            if (isset($_POST['searchTeam'])) {
                ?>
                <h3 class="h3-title">Team Search Results:</h3>
                <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $search = $_POST['searchTeam'];
                $sql = "SELECT * FROM team WHERE tm_name LIKE '%$search%';";
                $stmt = $db->prepare($sql);
                $stmt->execute([]);
                $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($teams as $team) {
                    $id = $team['id'];
                    ?>
                    <tr>
                        <td><?php echo $team['tm_name']; ?></td>
                        <td><a style="text-decoration: none;" href="index.php?page=team_edit&id=<?php echo $team['id']; ?>">&#9989;</a></td>
                        <td><a onclick="javascript:confirmationDelete($(this));return false;" style="text-decoration: none;"  href="index.php?page=team_delete&id=<?php echo $team['id']; ?>">&#10062;</a></td>
                    </tr>
                    <?php
                } ?>
                </table>
                <?php
            }
            
            ?>
            <h2 class="h2-title">Teams</h2>
        <br>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Team</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Shows teams in tabel -->
            <?php
            $sql = 'SELECT * FROM team';
            $stmt = $db->prepare($sql);
            $stmt->execute([]);
            $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($teams as $team) {
                $id = $team['id'];
                echo '<tr>';
                echo '<td>' . $team['tm_name'] . '</td>';
                echo "<td><a onclick='javascript:confirmationDelete($(this));return false;' style='text-decoration: none;'  href='index.php?page=team_delete&id=" .
                    $team['id'] .
                    "'>&#10062;</a></td>";
            }
            ?>
            </tbody>
        </table>
        <a class="btn btn-dark right" href="index.php?page=team_add" role="button">Add</a>
</div>
<script>
    // conformation script for delete
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
