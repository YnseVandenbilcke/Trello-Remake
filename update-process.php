<?php 
  require_once dirname(__FILE__) . "/src/helper/auth.php";
  require_once dirname(__FILE__) . "/src/helper/debug.php";
  require_once dirname(__FILE__) . "/src/repository/trellorepository.php";

  if(isset($_POST['submitList'])){
    $aantalRijen = TrelloRepository::updateList($_POST['listName'], $_POST['description'], $_POST['listID']);
    header("location:index.php");
  } elseif(isset($_POST['submitTask'])){
      $aantalRijen = TrelloRepository::updateTask($_POST['title'], $_POST['progress'], $_POST['taskid']);
      header("location:index.php?listid=" . $_POST['listid']);
  }
?>