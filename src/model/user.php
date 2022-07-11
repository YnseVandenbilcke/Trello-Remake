<?php
  class User{
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    public function __construct($parID=-1, $parFirstname="", $parLastname="", $parEmail="", $parPassword="")
    {
      $this->id = $parID;
      $this->firstname = $parFirstname;
      $this->lastname = $parLastname;
      $this->email = $parEmail;
      $this->password = $parPassword;
    }
  }
?>