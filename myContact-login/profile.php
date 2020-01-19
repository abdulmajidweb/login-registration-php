<?php
	include 'lib/User.php';
  	Session::init();
	Session::checkSession();

	if (isset($_GET["action"]) && $_GET["action"] == "signout") {
  		Session::destroy();
	}

	
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
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
				<nav class="user_nav">
					<ul class="nav float-right">
						<li class="nav-item">
							<a href="#" class="nav-link text-white h5">Profile</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link text-white h5">Add contact</a>
						</li>
						<li class="nav-item">
							<a href="?action=signout" class="nav-link text-white h5">Sign out</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header><!--header section end-->

<div class="content">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</div>



	<!--JQuery-->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!--bootstrap js-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>