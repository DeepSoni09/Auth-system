<?php
include 'Database-Connection.php';
session_start();

if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true){
  header("Location: Login.php?loginFirst=true");
}

$updatePasswordSuccess = false;
$PasswordMatched = false;
if (isset($_REQUEST['Change-Password'])) {
  $UpdatedPassword = $_REQUEST['Password'];

  if(empty($UpdatedPassword)){
    $UpdatedPasswordRequired = "*Password can't be empty";
    $err1=1;
  }else{

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    $Email = $_SESSION['Email'];

    $hash = password_hash($UpdatedPassword, PASSWORD_DEFAULT);
    $sql_name = "SELECT * FROM `user_data` WHERE `Email`='$Email';";
    $res_name = mysqli_query($conn, $sql_name);
    if (mysqli_num_rows($res_name) > 0) {

      while ($row = mysqli_fetch_assoc($res_name)) {

        if (password_verify($UpdatedPassword, $row['Password'])) {
          $PasswordMatched = true;
        } else {
          $sql = "UPDATE `user_data` SET `Password` = '$hash' WHERE `user_data`.`Email` = '$Email';";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            $updatePasswordSuccess = true;
            session_unset();
            session_destroy();
            header('Location:Login.php?forgotPass=true');
          }
        }
      }
    }
  }
}

}

?>

<?php
if ($PasswordMatched) {
  echo '<div id="toast-success" class="fixed top-5 left-5 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-white" role="alert">
  <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Error icon</span>
        </div>
  <div class="ml-3 text-sm font-normal">Password can\'t be same as previous!</div>
  <a href="forgotPassword.php"  class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-white dark:hover:bg-gray-700" >
      <span class="sr-only">Close</span>
      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
  </a>
</div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="/dist/output.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
</head>

<body>

  <div class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-md w-full">
      <div class="p-4 sm:p-7">
        <div class="text-center">
          <h1 class="text-center text-2xl font-bold mb-3">Forgot password?</h1>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Remember your password?
            <a class="text-blue-600 decoration-2 hover:underline font-medium" href="Login.php">
              Login here
            </a>
          </p>
        </div>

        <form action="forgotPassword.php" method="post">
          <div class="mb-4 mt-6">
            <label class="block text-gray-700 font-bold mb-2" for="password">
              Enter new password
            </label>
            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="Password" placeholder="Enter new password" />

            <div style="color:red;">
                            <?php if (isset($err1)) {
                                echo $UpdatedPasswordRequired;
                            }  ?>
                        </div>
          </div>

          <input type="submit" value="Reset Password" name="Change-Password" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
        </form>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

</body>

</html>