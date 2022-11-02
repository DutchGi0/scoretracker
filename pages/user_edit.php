<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
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
    <script src="js/jquery-3.6.1.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Stat Tracker - User Edit</title>
</head>
<body>
<?php
$sql = 'SELECT * FROM user WHERE ID= ?';
$stmt = $db->prepare($sql);
$stmt->execute([$_GET['id']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $user) { ?>
<div class="container">
    <form class="form" action="index.php?page=user_update" method="post">
        <h1 class="page-title uppercase"><span class="text-red center">E</span>dit User</h1>
        <br>
        <input type="hidden" name="id" id="id" value="<?php echo $user[
            'id'
        ]; ?>" />
        <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user[
                'name'
            ]; ?>"/>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email"  value="<?php echo $user[
                'email'
            ]; ?>" readonly/>
        </div>
        <div class="mb-3">
        <label for="goals" class="form-label">Goals:</label>
            <input type="number" class="form-control" id="goals" name="goals" value="<?php echo $user[
                'goal'
            ]; ?>"/>
        </div>
        <div class="mb-3">
        <label for="assists" class="form-label">Assists:</label>
            <input type="number" class="form-control" id="assists" name="assists" value="<?php echo $user[
                'assist'
            ]; ?>"/>
        </div>
        <div class="mb-3">
            <label for="teamid" class="form-label">Team:</label>
            <select class="form-control" id="teamid" name="teamid">
                <?php 
                $sql = 'SELECT * FROM team';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($teams as $team) {
                    $teamid = $team['id'];
                    $teamname = $team['tm_name'];
                    if ($teamid == $user['teamid']) {
                        echo '<option value="' . $teamid . '" selected>' . $teamname . '</option>';
                    } else {
                        echo '<option value="' . $teamid . '">' . $teamname . '</option>';
                    }

                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="is_admin" class="form-label">Is admin:</label>

            <?php $selecton = array(0, 1);
            echo '<select class="form-control" id="is_admin" name="is_admin">';
            foreach ($selecton as $selecton) {
                if ($selecton == $user['is_admin']) {
                    echo '<option value="' . $selecton . '" selected>' . $selecton . '</option>';
                } else {
                    echo '<option value="' . $selecton . '">' . $selecton . '</option>';
                }
            }
            echo '</select>';
            ?>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-dark uppercase">EDIT USER</button>
        <span class="right"><a href="index.php?page=admin" class="text-red" style="text-decoration: none;">Back</a></span>
    </form>
</div>
<?php } ?>
</body>
</html>
<?php
} ?>
