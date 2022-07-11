<?php 
  session_start();
  require_once dirname(__FILE__) . "/src/repository/trellorepository.php";
  require_once dirname(__FILE__) . "/src/helper/debug.php";

  if(isset($_POST['submit'])){
    $user = TrelloRepository::getUserByEmail($_POST['email']);
    if($user){
      echo "There is already an account on this email";
      print_r_pre($user);
    } else {
      echo "it works";
      if($_POST['password'] == $_POST['confirm_password']){
        $aantalRijen = TrelloRepository::createUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], password_hash($_POST['password'], PASSWORD_BCRYPT), "images/placeholder.jpg");
        if($aantalRijen > 0){
          header("location:login.php");
        } else {
          echo "You did not come from the form";
        }
      } else {
        echo "The passwords are wrong";
        header("location:register.php");
      }
    }
  }
?>