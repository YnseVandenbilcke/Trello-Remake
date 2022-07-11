<?php 
  require_once dirname(__FILE__) . "/src/helper/debug.php";
  require_once dirname(__FILE__) . "/src/helper/auth.php";
  require_once dirname(__FILE__) . "/src/repository/trellorepository.php";

  checkLoggedin(); // Check if the user is logged in, otherwise send back to login.php

  $user = TrelloRepository::getUserByID($_SESSION['loginID']);
  $lists = TrelloRepository::getAllLists();

  function showProgress($parProgress){
    switch($parProgress){
      case 0:
        echo "bg-slate-300";
        break;
      case 1:
        echo "bg-yellow-300";
        break;
      case 2:
        echo "bg-green-300";
        break;
      case 3:
        echo "bg-red-300";
        break;
      default:
        echo "";
        break;
    }
  }

  if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){ // Check if the action is to delete an item
      if(isset($_GET['listid'])){ // Check if the action is to delete a list
        $response = TrelloRepository::deleteList($_GET['listid']);
        $responseDeleteAllTasks = TrelloRepository::deleteTasksWithListID($_GET['listid']);
        if($response > 0 && $responseDeleteAllTasks > 0){
          header("location:index.php");
        } else {
          header("location:error.php?error=deleteList");
        }
      } elseif(isset($_GET['taskid'])){ // Check if the action is to delete a task
        $response = TrelloRepository::deleteTask($_GET['taskid']);
        if($response > 0){
          header("location:index.php");
        } else {
          header("location:erorr.php?error=deleteTask");
        }
      }
    }
  }

?>

<!doctype html>
<html class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./src/code.js"></script>
  <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body class="h-full">
<!-- This example requires Tailwind CSS v2.0+ -->
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="index.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Dashboard</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <button type="button" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
              <span class="sr-only">View notifications</span>
              <!-- Heroicon name: outline/bell -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
            </button>

            <!-- Profile dropdown -->
            <div class="ml-3 relative">
              <div>
                <button type="button" class="js-user-menu-button max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true" data-hidden="false">
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full" src="<?php echo $user->image ?>" alt="<?php echo $user->image ?>">
                </button>
              </div>

              <div class="js-user-menu origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="visibility: hidden;">
                <!-- Active: "bg-gray-100", Not Active: "" -->
                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>

                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>

                <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
              </div>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button" class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!--
              Heroicon name: outline/menu

              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!--
              Heroicon name: outline/x

              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Dashboard</a>

        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>

        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>

        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a>

        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Reports</a>
      </div>
      <div class="pt-4 pb-3 border-t border-gray-700">
        <div class="flex items-center px-5">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="<?php echo $user->image ?>" alt="<?php echo $user->image ?>">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium leading-none text-white"><?php echo $user->firstname . " " . $user->lastname; ?></div>
            <div class="text-sm font-medium leading-none text-gray-400"><?php echo $user->email; ?></div>
          </div>
          <button type="button" class="ml-auto bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
            <span class="sr-only">View notifications</span>
            <!-- Heroicon name: outline/bell -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>
        </div>
        <div class="mt-3 px-2 space-y-1">
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Your Profile</a>

          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Settings</a>

          <a href="logout.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Sign out</a>
        </div>
      </div>
    </div>
</nav>

  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900"><?php 
        if(isset($_GET['listid'])){
          $list = TrelloRepository::getListByID($_GET['listid']);
          echo $list->title;
        } else {
          echo "Dashboard";
        }
      ?></h1>
    </div>
  </header>
  <main>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <?php 
        if(isset($_GET['listid'])){ // Change the button from 'Create a list' to 'Create a task' depending if listid is set from the querystring
      ?>
        <a href="create-task.php?listid=<?php echo $_GET['listid'] ?>" class="block w-fit px-3 py-2 rounded-md text-base font-medium text-gray-800 my-2 hover:text-white hover:bg-gray-700">Create a task</a>
                <!-- Legend -->
        <div class="border-b-2 border-slate-400">
          <div class="grid grid-cols-4 gap-4">
            <div>
              <div class="py-1 bg-slate-300 w-full rounded-lg"></div>
              <p class="flex justify-center pt-1">Not started</p>
            </div>
            <div>
              <div class="py-1 bg-yellow-300 w-full rounded-lg"></div>
              <p class="flex justify-center p-1">In progress</p>
            </div>
            <div>
              <div class="py-1 bg-green-300 w-full rounded-lg"></div>
              <p class="flex justify-center p-1">Finished</p>
            </div>
            <div>
              <div class="py-1 bg-red-300 w-full rounded-lg"></div>
              <p class="flex justify-center p-1">Cancelled</p>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <a href="create-list.php" class="block w-fit px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:text-white hover:bg-gray-700">Create a list</a>
        <?php }?>

      <!-- Replace with your content -->
      <div class="px-4 py-4 sm:px-0">
          <!-- Here starts the box -->
          <div class=" mx-auto py-2">
            <div class="grid grid-cols-4 gap-4">
              <?php 
              if(!isset($_GET['listid'])){
                $colorList = [
                  "bg-red-300", "bg-green-300", "bg-cyan-300", "bg-fuchsia-300", "bg-orange-300", "bg-lime-300"
                ];
                $colorListBorder = [
                  "border-red-400", "border-green-400", "border-cyan-400", "border-fuchsia-400", "border-orange-400", "border-lime-400"
                ];
                $index = 0;
                $lists = TrelloRepository::getListsByUserID($_SESSION['loginID']);
                foreach($lists as $list){ 
                  ?> 
                <div class="w-full h-56 shadow-lg pb-full rounded-xl flex flex-col <?php echo $colorList[$index]; ?>">
                  <a href="index.php?listid=<?php echo $list->id ?>" class="flex mx-auto justify-center text-lg p-4 font-bold font-sans border-b-4 w-3/4 <?php echo $colorListBorder[$index]; ?>"><?php echo $list->title ?></a>
                  <div class="flex px-3 justify-center m-auto">
                    <a href="index.php?listid=<?php echo $list->id ?>" class="font-semibold text-center"><?php echo $list->description ?></a>
                  </div>
                  <div class="flex items-end flex-row justify-around pb-3">
                    <a href="?action=delete&listid=<?php echo $list->id ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <a href="update.php?listid=<?php echo $list->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  </div>
                </div>
                <?php 
                  if($index == 5){
                      $index = 0;
                  } else {
                    $index++;  
                  }
                }
              } else { 
                  $tasksFromList = TrelloRepository::getAllTasksFromList($_GET['listid']);
                  foreach($tasksFromList as $task){ 
                    ?>
                    <div class="w-full h-56 shadow-lg pb-full rounded-xl flex flex-col <?php echo showProgress($task->progress); ?>">
                      <a href="#" class="flex justify-center text-lg p-4 font-bold font-sans"><?php echo $task->title ?></a>
                      <div class="flex items-end flex-row justify-around pb-3 mt-auto">
                        <a href="?action=delete&taskid=<?php echo $task->id ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a href="update.php?taskid=<?php echo $task->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                    </div>
               <?php
                }}
                ?>
            </div>
          </div>
          <!-- Here ends the box -->
      </div>
      <!-- /End replace -->
    </div>
  </main>
</div>
</body>
</html>