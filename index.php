<?php
include 'inc/header.php';
include 'lib/User.php';
Session::checkSession();
 ?>


    <!--content-->
    <div class="container-fluid">
      <?php
        $loginmsg = Session::get("loginmsg");
        if (isset($loginmsg)) {
          echo $loginmsg;
        }
        Session::set("loginmsg", NULL);
       ?>
      <div class="card">
        <div class="card-header">
          <span class="h4 float-left">User list</span>
          <span class="h4 float-right"><strong>Welcome!</strong>
            <?php
              $username = Session::get("username");
              if (isset($username)) {
                echo $username;
              }
             ?>
          </span>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Serial</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">E-mail Address</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
<?php
$user = new User();
$userData = $user->getUserData();
if ($userData) {
  $i = 0;
  foreach ($userData as $sdata) {
    $i++;
    ?>

              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $sdata['name']; ?></td>
                <td><?php echo $sdata['username']; ?></td>
                <td><?php echo $sdata['email']; ?></td>
                <td><a href="profile.php?id=<?php echo $sdata['id']; ?>" class="btn btn-primary">View</a></td>
              </tr>
<?php } }else { ?>
  <tr><td colspan="5">Data not found...</td></tr>
<?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<?php include 'inc/footer.php'; ?>
