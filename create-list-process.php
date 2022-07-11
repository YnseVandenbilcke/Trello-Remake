<?php
  require_once dirname(__FILE__) . "/src/helper/auth.php";
  require_once dirname(__FILE__) . "/src/helper/debug.php";
  require_once dirname(__FILE__) . "/src/repository/trellorepository.php";

  if(isset($_POST['submit'])){
    $aantalRijen = TrelloRepository::createList($_POST['listName'], $_POST['description'], $_SESSION['loginID']);
    if($aantalRijen > 0){
      header("location:index.php");
    }
  } else {
    echo "Je kwam niet van het form";
  }
?>