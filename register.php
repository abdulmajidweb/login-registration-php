<?php
include 'inc/header.php';
include 'lib/User.php';
 ?>
<?php
$user = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
  $userRegi = $user->userRegistation($_POST);
}
 ?>
    <!--content-->
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <span class="h4 float-left">User Register</span>
        </div>
        <div class="card-body">

<?php
  if (isset($userRegi)) {
    echo $userRegi;
  }
 ?>

          <!--User login form-->
          <form action="" method="post">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username">
              </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email" class="form-control" id="email">
                </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" name="register" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>

<?php include 'inc/footer.php'; ?>
