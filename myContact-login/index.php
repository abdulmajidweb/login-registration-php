<?php
	include 'lib/User.php';
  	Session::init();
	$user = new User();
	Session::checksignin();

	//user sign up
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
		$userSignup = $user->signup($_POST);
	}

	//user sign in
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {
  		$userSignin = $user->signin($_POST);
	}
 ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Contact : Sign In or Sign Up</title>
	<!--bootstrap css-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!--main css-->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<!--header section-->
	<header class="container-fluid pt-3 pb-2">
		<div class="row">
			<div class="col-md-3 col-12 mb-1">
				<a href="index.php" class="text-decoration-none"><h3 class="text-white font-weight-bold"><span class="bg-info rounded p-1 shadow">My</span>Contact</h3></a>
			</div>
			<!--sign in section-->
			<div class="col-md-9 col-12">

<?php
	if (isset($userSignin)) {
		echo $userSignin;
	}
?>

				<!--sign in form-->
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
					<div class="row">
						<div class="col-sm-5 col-12 mb-1">
							<input type="email" name="email" placeholder="Email" class="form-control">
						</div>
						<div class="col-sm-5 col-12 mb-1">
							<input type="password" name="password" placeholder="Password" class="form-control">
						</div>
						<div class="col-sm-2 col-12">
							<input type="submit" name="signin" value="Sign in" class="btn btn-info">
						</div>
					</div>
				</form><!--form end-->
			</div>
		</div>
	</header><!--header section end-->

	<!--section -->
	<section class="container-fluid section">
		<div class="row mt-3 mb-5">
			<div class="col-sm-2 col-0"></div>
			<div class="col-sm-8 col-12">
				<!--sign up card-->
				<div class="card">
					<div class="card-header text-center">
						<h3 class="card-title">Be great at what you do</h3>
						<p>Get started - it's free.</p>
					</div>
					<div class="card-body">

<?php
	if (isset($userSignup)) {
		echo $userSignup;
	}
?>

						<!-- sign up form-->
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
							<div class="row">
								<div class="col-12">
									<label for="firstName">First name</label>
									<input type="text" name="firstName" id="firstName" class="form-control">
								</div>
								<div class="col-12">
									<label for="lastName">Last name</label>
									<input type="text" name="lastName" id="lastName" class="form-control">
								</div>
								<div class="col-12">
									<label for="email">Email</label>
									<input type="email" name="email" id="email" class="form-control">
								</div>
								<div class="col-12">
									<label for="password">Password (6 or more characters)</label>
									<input type="password" name="password" id="password" class="form-control">
								</div>
								<div class="col-12 mt-2">
									<label for="signup" class="text-center h6">By clicking Sign up, you agree to the MyContact User Agreement, Privacy Policy and Cookie Policy.</label>
									<input type="submit" name="signup" value="Sign up" id="signup" class="form-control bg-info mt-2">
								</div>
							</div>
						</form><!--form end-->
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-0"></div>
		</div>
	</section><!--section end-->

	<!--footer-->
	<footer class="container-fluid text-primary pt-4 pb-4 text-center">
		<p class="mt-3 mb-3">Developed by <a href="#" class="text-decoration-none bg-info rounded text-white p-1 shadow">Abdul Majid</a></p>
	</footer>


	<!--JQuery-->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!--bootstrap js-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>