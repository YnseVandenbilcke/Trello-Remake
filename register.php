<?php 
  session_start();
  require_once dirname(__FILE__) . "/src/repository/trellorepository.php";
  require_once dirname(__FILE__) . "/src/helper/debug.php";
?>

<!doctype html>
<html class="h-full bg-gray-50">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<body>
<div class="bg-stone-100 min-h-screen flex">
  <div class="container max-w-lg mx-auto flex-1 flex flex-col items-center justify-center px-2">
    <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
      <h1 class="mb-8 text-3xl font-bold text-center">Sign up</h1>
      <form method="POST" action="register-process.php">
        <input type="text" class="block border border-grey-300 w-full p-3 rounded mb-4" name="firstname" placeholder="First Name" required />
        <input type="text" class="block border border-grey-300 w-full p-3 rounded mb-4" name="lastname" placeholder="Last Name" required />
        <input type="text" class="block border border-grey-300 w-full p-3 rounded mb-4" name="email" placeholder="Email" required />
        <input type="password" class="block border border-grey-300 w-full p-3 rounded mb-4" name="password" placeholder="Password" required />
        <input type="password" class="block border border-grey-300 w-full p-3 rounded mb-4" name="confirm_password" placeholder="Confirm Password" required />
        <button type="submit" name="submit" class="w-full text-center py-3 rounded bg-indigo-700 text-white hover:bg-indigo-500 focus:outline-none my-1">Create Account</button>
      </form>
        
        <div class="text-center text-sm text-grey-dark mt-4">
          By signing up, you agree to the 
          <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
            Terms of Service
          </a> and 
          <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
            Privacy Policy
          </a>
        </div>
      </div>

      <div class="text-grey-dark mt-6">
        Already have an account? 
        <a class="no-underline border-b border-blue text-blue" href="login.php">
          Log in
        </a>.
      </div>
    </div>
  </div>
</body>
</html>