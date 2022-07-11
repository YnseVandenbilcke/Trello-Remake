<?php
  require_once dirname(__FILE__) . "/../database/database.php";
  require_once dirname(__FILE__) . "/../model/user.php";
  require_once dirname(__FILE__) . "/../model/todolist.php";
  require_once dirname(__FILE__) . "/../model/task.php";

  class TrelloRepository{
    public static function getAllUsers(){
      $arr = Database::getRows("SELECT * FROM users", null, "User");
      return $arr;
    }

    public static function getUserByEmail($email){
      $item = Database::getSingleRow("SELECT * FROM users WHERE email=?", [$email], "User");
      return $item;
    }

    public static function getUserByID($id){
      $item = Database::getSingleRow("SELECT * FROM users WHERE id=?", [$id], "User");
      return $item;
    }

    public static function getAllLists(){
      $arr = Database::getRows("SELECT * FROM lists", null, "TodoList");
      return $arr;
    }

    public static function getListsByUserID($userid){
      $arr = Database::getRows("SELECT * FROM lists WHERE userID=?", [$userid], "TodoList");
      return $arr;
    }

    public static function getAllTasksFromList($listid){
      $arr = Database::getRows("SELECT * FROM tasks WHERE listID=?", [$listid], "Task");
      return $arr;
    }

    public static function getListByID($listid){
      $item = Database::getSingleRow("SELECT * FROM lists WHERE id=?", [$listid], "TodoList");
      return $item;
    }

    public static function getTaskByID($taskid){
      $item = Database::getSingleRow("SELECT * FROM tasks WHERE id=?", [$taskid], "Task");
      return $item;
    }

    public static function deleteList($listid){
      $res = Database::execute("DELETE FROM lists WHERE id=?", [$listid]);
      return $res;
    }

    public static function deleteTask($taskid){
      $res = Database::execute("DELETE FROM tasks WHERE id=?", [$taskid]);
      return $res;
    }
    
    public static function deleteTasksWithListID($listid){
      $res = Database::execute("DELETE FROM tasks WHERE listid=?", [$listid]);
      return $res;
    }

    public static function createList($listName, $description, $userid){
      $res = Database::execute("INSERT INTO lists(title, description, userID) VALUES(?,?,?)", [$listName, $description, $userid]);
      return $res;
    }

    public static function createTask($title, $progress, $listid){
      $res = Database::execute("INSERT INTO tasks(title, progress, listid) VALUES(?,?,?)", [$title, $progress, $listid]);
      return $res;
    }

    public static function updateList($title, $description, $id){
      $res = Database::execute("UPDATE lists SET title=?, description=? WHERE id=?", [$title, $description, $id]);
      return $res;
    }

    public static function updateTask($title, $progress, $id){
      $res = Database::execute("UPDATE tasks SET title=?, progress=? WHERE id=?", [$title, $progress, $id]);
      return $res;
    }

    public static function createUser($firstname, $lastname, $email, $password, $image){
      $res = Database::execute("INSERT INTO users(firstname, lastname, email, password, image) VALUES(?,?,?,?,?)", [$firstname, $lastname, $email, $password, $image]);
      return $res;
    }
  }
?>