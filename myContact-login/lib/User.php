<?php
	include_once 'Session.php';
	include 'Database.php';
	
	class User{
		private $db;
		public function __construct(){
			$this->db = new Database();
		}

		//user sign up
		public function signup($data){
			if ($data['firstName'] == "" OR $data['lastName'] == "" OR $data['email'] == "" OR $data['password'] == "") {
				$msg = "<div class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</div>";
				return $msg;
			}else{
				$firstName = $this->test_input($data['firstName']);
				$lastName = $this->test_input($data['lastName']);
				$email = $this->test_input($data['email']);
				$password = $this->test_input($data['password']);
				$chk_email = $this->emailCheck($email);
			}

			if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
        		$msg = "<div class='alert alert-danger'><strong>First name error!</strong>Only English letters and white space allowed.</div>";
        		return $msg;
      		}

      		if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
        		$msg = "<div class='alert alert-danger'><strong>Last name error!</strong>Only English letters and white space allowed.</div>";
        		return $msg;
      		}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      			$msg = "<div class='alert alert-danger'><strong>Error!</strong>Invalid email address.</div>";
      			return $msg;
    		}

		    if ($chk_email == true) {
		      $msg = "<div class='alert alert-danger'><strong>Error!</strong>The email address already exist.</div>";
		      return $msg;
		    }

		    if (strlen($password) < 6) {
		      $msg = "<div class='alert alert-danger'><strong>Error!</strong> Password is too short. Minumum input 6 character.</div>";
		      return $msg;
		    }

			$password = md5($data['password']);
		    $sql = "INSERT INTO tbl_user(firstName, lastName, email, password) VALUES(:firstName, :lastName, :email, :password)";
		    $query = $this->db->pdo->prepare($sql);
		    $query->bindParam(":firstName", $firstName);
		    $query->bindParam(":lastName", $lastName);
		    $query->bindParam(":email", $email);
		    $query->bindParam(":password", $password);
		    $result = $query->execute();

		    if ($result) {
		      $msg = "<div class='alert alert-success'><strong>Success!</strong> Thank you. You have been successfully sign up.</div>";
		      return $msg;
		    }else {
		      $msg = "<div class='alert alert-danger'><strong>Error!</strong>Sorry! There has been error inserting.</div>";
		      return $msg;
		    }
		}

		


		//test input
		public function test_input($data){
  			$data = trim($data);
  			$data = stripslashes($data);
  			$data = htmlspecialchars($data);
  			return $data;
		}

		public function emailCheck($email){
	      $sql = "SELECT * FROM tbl_user WHERE email=:email";
	      $query = $this->db->pdo->prepare($sql);
	      $query->bindParam(":email", $email);
	      $query->execute();
	      if ($query->rowCount() > 0) {
	        return true;
	      }else {
	        return false;
	      }
    	}

    	// user sign in
    	public function signin($data){
    		if ($data['email'] == "") {
				$msg = "<div class='alert alert-danger'><strong>Error!</strong> Email must not be empty.</div>";
				return $msg;
			}else{
				$email = $this->test_input($data['email']);
				$chk_email = $this->emailCheck($email);
			}

			if ($data['password'] == "") {
				$msg = "<div class='alert alert-danger'><strong>Error!</strong> Password must not be empty.</div>";
				return $msg;
			}else{
				$pass = $this->test_input($data['password']);
				$password = md5($pass);
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	        	$msg = "<div class='alert alert-danger'><strong>Error!</strong>Invalid email address.</div>";
	        	return $msg;
	      	}
	      	if($chk_email == false) {
	        	$msg = "<div class='alert alert-danger'><strong>Error!</strong>The email address not exist.</div>";
	        	return $msg;
	      	}

			$result = $this->getsignin($email, $password);
		    if ($result) {
		        Session::init();
		        Session::set("signin", true);
		        Session::set("id", $result->id);
		        Session::set("firstName", $result->firstName);
		        Session::set("lastName", $result->lastName);
		        header("location: profile.php");
		    }else {
		        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Incorrect password.</div>";
		        return $msg;
		    }

    	}

    	//sign in email , password match
	    public function getsignin($email, $password){
	      $sql = "SELECT * FROM tbl_user WHERE email=:email AND password=:password LIMIT 1";
	      $query = $this->db->pdo->prepare($sql);
	      $query->bindParam(":email", $email);
	      $query->bindParam(":password", $password);
	      $query->execute();
	      $result = $query->fetch(PDO::FETCH_OBJ);
	      return $result;
	    }

	}
?>