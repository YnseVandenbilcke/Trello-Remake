<?php
  require_once dirname(__FILE__) . "/src/helper/auth.php";
  require_once dirname(__FILE__) . "/src/helper/debug.php";
  require_once dirname(__FILE__) . "/src/repository/trellorepository.php";

  if(isset($_POST['submit'])){
    $progressValue = 0;
    switch($_POST['progress']){
      case "Not started":
        $progressValue = 0;
        break;
      case "In progress":
        $progressValue = 1;
        break;
      case "Finished":
        $progressValue = 2;
        break;
      case "Cancelled":
        $progressValue = 3;
        break;
      default:
        $progressValue = 0;
        break;
    }
    $aantalRijen = TrelloRepository::createTask($_POST['title'], $progressValue, $_POST['listid']);
    if($aantalRijen > 0){
      header("location:index.php?listid=" . $_POST['listid']);
    } else {
      header("location:error.php?error=createTask");
    }
  }
?>