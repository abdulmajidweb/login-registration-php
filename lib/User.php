<?php
  include_once 'Session.php';
  include 'Database.php';

  class User{
    private $db;
    public function __construct(){
      $this->db = new Database();
    }
    public function userRegistation($data){
      $name     = $data['name'];
      $username = $data['username'];
      $email    = $data['email'];
      $password = $data['password'];
      $chk_email = $this->emailCheck($email);

      if ($name =="" OR $username == "" OR $email == "" OR $password == "") {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</div>";
        return $msg;
      }

      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $msg = "<div class='alert alert-danger'><strong>Name error!</strong>Only letters and white space allowed.</div>";
        return $msg;
      }

      if (strlen($username) < 3) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Username is too short.</div>";
        return $msg;
      }elseif (!preg_match("/^[a-zA-Z ]*$/", $username)) {
        $msg = "<div class='alert alert-danger'><strong>Username error!</strong>Only letters and white space allowed.</div>";
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
    $sql = "INSERT INTO tbl_user(name, username, email, password) VALUES(:name, :username, :email, :password)";
    $query = $this->db->pdo->prepare($sql);
    $query->bindParam(":name", $name);
    $query->bindParam(":username", $username);
    $query->bindParam(":email", $email);
    $query->bindParam(":password", $password);
    $result = $query->execute();

    if ($result) {
      $msg = "<div class='alert alert-success'><strong>Success!</strong>Thank you. You have been successfully registered.</div>";
      return $msg;
    }else {
      $msg = "<div class='alert alert-danger'><strong>Error!</strong>Sorry! There has been error inserting.</div>";
      return $msg;
    }

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

    public function getLoginUser($email, $password){
      $sql = "SELECT * FROM tbl_user WHERE email=:email AND password=:password LIMIT 1";
      $query = $this->db->pdo->prepare($sql);
      $query->bindParam(":email", $email);
      $query->bindParam(":password", $password);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_OBJ);
      return $result;
    }

    public function userLogin($data){
      $email    = $data['email'];
      $password = md5($data['password']);
      $chk_email = $this->emailCheck($email);

      if ($email == "" OR $password == "") {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</div>";
        return $msg;
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Invalid email address.</div>";
        return $msg;
      }
      if ($chk_email == false) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>The email address not exist.</div>";
        return $msg;
      }
      $result = $this->getLoginUser($email, $password);
      if ($result) {
        Session::init();
        Session::set("login", true);
        Session::set("id", $result->id);
        Session::set("name", $result->name);
        Session::set("username", $result->username);
        Session::set("loginmsg", "<div class='alert alert-success'><strong>Success!</strong> You are logged in.</div>");
        header("location: index.php");
      }else {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Incorrect password.</div>";
        return $msg;
      }
    }

    public function getUserData(){
      $sql = "SELECT * FROM tbl_user ORDER BY id DESC";
      $query = $this->db->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }

    public function getUserById($userId){
      $sql = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
      $query = $this->db->pdo->prepare($sql);
      $query->bindParam(":id", $userId);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_OBJ);
      return $result;
    }

    public function updateUser($userId, $data){
      $name     = $data['name'];
      $username = $data['username'];
      $email    = $data['email'];

      if ($name =="" OR $username == "" OR $email == "") {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</div>";
        return $msg;
      }

      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $msg = "<div class='alert alert-danger'><strong>Name error!</strong>Only letters and white space allowed.</div>";
        return $msg;
      }

      if (strlen($username) < 3) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Username is too short.</div>";
        return $msg;
      }elseif (!preg_match("/^[a-zA-Z ]*$/", $username)) {
        $msg = "<div class='alert alert-danger'><strong>Username error!</strong>Only letters and white space allowed.</div>";
        return $msg;
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $msg = "<div class='alert alert-danger'><strong>Error!</strong>Invalid email address.</div>";
      return $msg;
      }

      $sql = "UPDATE tbl_user SET
        name = :name,
        username = :username,
        email = :email
        WHERE id = :id
      ";
      $query = $this->db->pdo->prepare($sql);
      $query->bindParam(":name", $name);
      $query->bindParam(":username", $username);
      $query->bindParam(":email", $email);
      $query->bindParam(":id", $userId);
      $result = $query->execute();

      if ($result) {
        $msg = "<div class='alert alert-success'><strong>Success!</strong> You have been successfully updated.</div>";
        return $msg;
      }else {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Sorry! There has been error updating.</div>";
        return $msg;
      }
    }

    private function checkPassword($old_pass, $id){
      $password = md5($old_pass);
      $sql = "SELECT password FROM tbl_user WHERE password=:password AND id = :id";
      $query = $this->db->pdo->prepare($sql);
      $query->bindParam(":password", $password);
      $query->bindParam(":id", $id);
      $query->execute();
      if ($query->rowCount() > 0) {
        return true;
      }else {
        return false;
      }
    }

    public function updatePassword($id, $data){
      $old_pass = $data['old_pass'];
      $new_pass = $data['new_pass'];
      if ($old_pass =="" OR $new_pass == "") {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</div>";
        return $msg;
      }
      $chk_pass = $this->checkPassword($old_pass, $id);
      if ($chk_pass == false) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Old password no match.</div>";
        return $msg;
      }
      if (strlen($new_pass) < 6) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Password is too short. Minumum input 6 character.</div>";
        return $msg;
      }

      $password = md5($new_pass);

      $sql = "UPDATE tbl_user SET
        password = :password
        WHERE id = :id
      ";
      $query = $this->db->pdo->prepare($sql);
      $query->bindParam(":password", $password);
      $query->bindParam(":id", $id);
      $result = $query->execute();

      if ($result) {
        $msg = "<div class='alert alert-success'><strong>Success!</strong> Password updated successfully.</div>";
        return $msg;
      }else {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Sorry! Password not updated.</div>";
        return $msg;
      }

    }

  }

 ?>
