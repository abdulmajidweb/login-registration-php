<?php
include 'lib/User.php';
include 'inc/header.php';
 ?>

<?php
if (isset($_GET['id'])) {
  $userId = (int)$_GET['id'];
  $ssid = Session::get("id");
  if ($userId != $ssid) {
    header("location:index.php");
  }
}
$user = new User();
?>

    <!--content-->
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <span class="h4 float-left">Change Password</span>
          <span class="h4 float-right"><a href="profile.php?id=<?php echo $userId; ?>" class="btn btn-primary">Back</a></span>
        </div>
        <div class="card-body">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updatepass"])) {
  $updatepass = $user->updatePassword($userId, $_POST);
  if ($updatepass) {
    echo $updatepass;
  }
}

 ?>
          <form action="" method="post">
            <div class="form-group">
              <label for="old_pass">Old Password</label>
              <input type="password" name="old_pass" class="form-control" id="old_pass">
            </div>
              <div class="form-group">
                <label for="new_pass">New Password</label>
                <input type="password" name="new_pass" class="form-control" id="new_pass">
              </div>
            <button type="submit" name="updatepass" class="btn btn-success">Update</button>

          </form>
        </div>
      </div>
    </div>

<?php include 'inc/footer.php'; ?>
