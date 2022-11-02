<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
    header('Location: index.php?page=homepage');
} else {
     ?>
<?php if (isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $assist = htmlspecialchars($_POST['assists']);
    $teamid = htmlspecialchars($_POST['teamid']);
    $goals = htmlspecialchars($_POST['goals']);
    $is_admin = htmlspecialchars($_POST['is_admin']);
    $sql =
        'UPDATE user SET `name` = ?,  `goal` = ?, `assist` = ?, `is_admin` = ?, `teamid` = ? WHERE `ID` = ?';
    $stmt = $db->prepare($sql);
    try {
        $stmt = $stmt->execute([$name, $goals, $assist, $is_admin, $teamid, $id]);
        echo "<script>alert('User is updated');
            location.href='index.php?page=admin';</script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} ?>
<?php
} ?>
