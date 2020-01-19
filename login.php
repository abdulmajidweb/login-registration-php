<?php
include 'inc/header.php';
include 'lib/User.php';
Session::checkLogin();
 ?>
<?php
$user = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $userLog = $user->userLogin($_POST);
}
 ?>

    <!--content-->
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <span class="h4 float-left">User Login</span>
        </div>
        <div class="card-body">

<?php
  if (isset($userLog)) {
    echo $userLog;
  }
?>

          <!--User login form-->
          <form action="" method="post">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>

<?php include 'inc/footer.php'; ?>
