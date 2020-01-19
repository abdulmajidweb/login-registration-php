<?php
  $filepath  = realpath(dirname(__FILE__));
  include_once $filepath."/../lib/Session.php";
  Session::init();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Register System</title>
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

<?php
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
  Session::destroy();
}
 ?>

  <body>
    <!--header-->
    <header class="container-fluid">
      <!--navbar-->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Login Register System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">

            <?php
              $id = Session::get("id");
              $userlogin = Session::get("login");
              if ($userlogin == true) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="?action=logout">Logout</a>
                </li>
              <?php }else{ ?>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a>
                </li>
              <?php } ?>
          </ul>
        </div>
      </nav>
    </header>
