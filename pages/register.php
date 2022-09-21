<?php
include_once '.\components\register_code.php';
// if user is logged in redirect to movies page
if (isset($_SESSION['ID'])) {
    header('Location: index.php?page=homepage');
} else {
     ?>

<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="components\showpassword.js" defer></script>
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>    
	<title>Stats Tracker - Register</title>
</head>
<body>
	<div class="container register-container">
        <h1 class='page-title uppercase'><span class='text-red'>R</span>egister an account</h1>
        <br>
		<form action="" method="post">

			<div class="mb-3 ">
                <?php if (isset($errorMsg[0])) {
                    foreach ($errorMsg[0] as $nameErrors) {
                        echo '<p class="small  text-danger">' .
                            $nameErrors .
                            '</p>';
                    }
                } ?>
				<label for="name" class="form-label">Name</label>
				<input type="text" name="name" class="form-control" placeholder="Joe Doe">
			</div>

			<div class="mb-3">
                <?php if (isset($errorMsg[2])) {
                    foreach ($errorMsg[2] as $emailErrors) {
                        echo '<p class="small  text-danger">' .
                            $emailErrors .
                            '</p>';
                    }
                } ?>
				<label for="email" class="form-label">Email Address</label>
				<input type="email" name="email" class="form-control" placeholder="example@example.com">
			</div>
			<div class="mb-3">
                <?php if (isset($errorMsg[3])) {
                    foreach ($errorMsg[3] as $passwordErrors) {
                        echo '<p class="small  text-danger">' .
                            $passwordErrors .
                            '</p>';
                    }
                } ?>
				<label for="password" class="form-label">Password</label>
				<input type="password" name="password" class="form-control" id="password" placeholder="password">
                <input type="checkbox" onclick="showPassword()">Show Password
			</div>
            <div class="mb-3">
                <?php if (isset($errorMsg[4])) {
                    foreach ($errorMsg[4] as $passwordErrors) {
                        echo '<p class="small  text-danger">' .
                            $passwordErrors .
                            '</p>';
                    }
                } ?>
				<label for="password" class="form-label">Confirm Password</label>
				<input type="password" name="password_confirm" class="form-control" id="password" placeholder="confirm password">
                <input type="checkbox" onclick="showPassword()">Show Password
            </div>

            
			<button type="submit" name="register_btn" class="btn btn-primary">Register</button> 
            <span class="right">Already have an account? <a class="text-red" href="index.php?page=login" style="text-decoration: none;">Login here!</a></span>
		</form>
		
	</div>
</body>
</html>
<?php
} ?>
