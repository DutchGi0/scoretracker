
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="components/jquery-3.6.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
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
      <a class="navbar-brand" href="index.php?page=homepage">
        Stats Tracker
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=homepage">Home</a>
          </li>
          <!-- <li>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </li> -->
          <!-- Account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Account
                </a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="accountDropdown">
                  <a class="dropdown-item" href="index.php?page=login">Login</a>
                  <a class="dropdown-item" href="index.php?page=register">Register</a>
                  <a class="dropdown-item" href="index.php?page=password_reset">Forgot Password</a>
                </div>
              </li>
        </ul>
      </div>
    </nav>
    <?php } ?>
    
        <!-- Logged in as normal -->
      <?php if (isset($_SESSION['ID']) && $_SESSION['STATUS'] == 'ACTIEF') {
          if ($_SESSION['ROL'] == 0) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand " href="index.php?page=homepage">
        Stats Tracker
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=homepage">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=teams">Teams</a>
          </li>
          <!-- <li>
            <form class="d-flex" action="pages/search.php" method="GET">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </li> -->
          <!-- Account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['USER_ID']; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="accountDropdown">
                  <a class="dropdown-item" href="index.php?page=profile">View Account</a>
                  <a class="dropdown-item" onclick="logout()">Logout</a>
                </div>
              </li>
        </ul>
      </div>
    </nav>
    <?php } }?>

    <?php if (isset($_SESSION['ID']) && $_SESSION['STATUS'] == 'ACTIEF') {
          if ($_SESSION['ROL'] == 1) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand " href="index.php?page=homepage">
        Stats Tracker
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=homepage">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=admin">Admin Panel</a>
          </li>
          <!-- Account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['USER_ID']; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="accountDropdown">
                  <a class="dropdown-item" href="index.php?page=profile">View Account</a>
                  <a class="dropdown-item" onclick="logout()">Logout</a>
                </div>
              </li>
        </ul>
      </div>
    </nav>
    <?php } }?>
    </div>
  </body>
</html>
