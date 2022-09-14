
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="bootstrap/js/jquery-3.6.1.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <script>
      function logout() {
        var logout = confirm('Are you sure you want to logout?')
        if (logout) {
          location.href = 'index.php?page=logout'
        }
      }
    </script>
  </head>
  <body>
    <?php if (!isset($_SESSION['USER_ID'])) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Stats Tracker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=homepage">Home</a></li>
          <a class="nav-link" href="index.php?page=login">Login</a>
          <a class="nav-link" href="index.php?page=register">Register</a>
          <a class="nav-link" href="index.php?page=forgotpassword">Forgot password</a>
          <a class="nav-link" onclick="logout()">Logout</a>
        </ul>
    </nav>
    <?php } ?>
    
    
   
     
        <!-- Logged in as normal -->
      <?php if (isset($_SESSION['ID']) && $_SESSION['STATUS'] == 'ACTIEF') {
          if ($_SESSION['ROL'] == 0) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Stats Tracker</a>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=homepage">Home</a></li>
          <a class="nav-link" href="index.php?page=login">Login</a>
          <a class="nav-link" href="index.php?page=register">Register</a>
          <a class="nav-link" href="index.php?page=forgotpassword">Forgot password</a>
          <a class="nav-link" onclick="logout()">Logout</a>
        </ul>
    </nav>
    <?php } }?>

    <?php if (isset($_SESSION['ID']) && $_SESSION['STATUS'] == 'ACTIEF') {
          if ($_SESSION['ROL'] == 1) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Stats Tracker</a>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=homepage">Home</a></li>
          <a class="nav-link" href="index.php?page=login">Login</a>
          <a class="nav-link" href="index.php?page=register">Register</a>
          <a class="nav-link" href="index.php?page=forgotpassword">Forgot password</a>
          <a class="nav-link" onclick="logout()">Logout</a>
        </ul>
    </nav>
    <?php } }?>
    </div>
  </body>
</html>
