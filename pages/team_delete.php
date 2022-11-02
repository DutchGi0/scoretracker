<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
    header('Location: index.php?page=homepage');
} else {
     ?>
<?php
$sql = 'DELETE FROM team WHERE ID = ?';
$stmt = $db->prepare($sql);
try {
    $stmt->execute([$_GET['id']]);
    echo "<script>alert('Team is deleted');
        location.href='index.php?page=admin';</script>";
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<?php
} ?>
