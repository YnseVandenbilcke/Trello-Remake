<?php 
  class Task {
    public $id;
    public $title;
    public $progress;
    public $listID;

    public function __construct($parID=-1, $parTitle="", $parProgress=-1, $parListID=-1)
    {
      $this->id = $parID;
      $this->title = $parTitle;
      $this->progress = $parProgress;
      $this->listID = $parListID;
    }
  }
?>