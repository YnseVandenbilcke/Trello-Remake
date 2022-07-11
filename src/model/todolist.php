<?php 
  class TodoList{
    public $id;
    public $title;
    public $description;
    public $userID;

    public function __construct($parID=-1, $parTitle="", $parDescription="", $parUserID=-1)
    {
      $this->id = $parID;
      $this->title = $parTitle;
      $this->description = $parDescription;
      $this->userID = $parUserID;
    }
  }
?>