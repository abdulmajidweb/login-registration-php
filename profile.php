<?php
include 'lib/User.php';
include 'inc/header.php';
 ?>

<?php
if (isset($_GET['id'])) {
  $userId = (int)$_GET['id'];
}
$user = new User();
?>

    <!--content-->
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <span class="h4 float-left">User Profile</span>
          <span class="h4 float-right"><a href="index.php" class="btn btn-primary">Back</a></span>
        </div>
        <div class="card-body">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
  $updateUsr = $user->updateUser($userId, $_POST);
  if ($updateUsr) {
    echo $updateUsr;
  }
}

 ?>

<?php
$userdata = $user->getUserById($userId);
if ($userdata) {

 ?>

          <form action="" method="post">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" value="<?php echo $userdata->name; ?>" class="form-control" id="name">
            </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $userdata->username; ?>" class="form-control" id="username">
              </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email" value="<?php echo $userdata->email; ?>" class="form-control" id="email">
                </div>

<?php
$ssid = Session::get("id");
if ($userId == $ssid) {
 ?>

            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a class="btn btn-primary" href="changepass.php?id=<?php echo $userId; ?>">Password Change</a>
<?php } ?>
          </form>
<?php } ?>
        </div>
      </div>
    </div>

<?php include 'inc/footer.php'; ?>
