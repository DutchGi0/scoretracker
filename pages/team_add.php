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
    <title>Stat Tracker - Team add</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Add new team</h1>   
        <br> 
        <form name="newteam" class="form" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="teamname" class="form-label">Team Name:</label>
                <input type="text" class="form-control" name="teamname" id="teamname" aria-describedby="teamname">
            </div>
            <button class="btn btn-dark uppercase" name="submit" type="submit">Add new team</button>
            <span class="right"><a class="text-red" style="text-decoration: none;" href="index.php?page=admin">Back</a></span>

            <?php if (isset($_POST['submit'])) {
                
                $error = '';
                $teamname = htmlspecialchars($_POST['teamname']);

                $sql = "INSERT INTO team (id, tm_name) 
                        VALUES (?,?)";
                $stmt = $db->prepare($sql);
                try {
                    $stmt->execute([
                        null,
                        $teamname,
                    ]);
                    $error = '<br>New team was successfully added';
                } catch (PDOException $e) {
                    $error = "Couldn't add team." . $e->getMessage();
                }
                echo "<div id='error'>" . $error . '</div>';
            } ?>
    
        </form>
    </div>
</body>
</html>