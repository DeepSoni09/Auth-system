<?php
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header('Location: Login.php?loginFirst=true');
}

?>

<?php
if(isset($_GET['alreadyLoggedin'])){
    echo '<div id="toast-success" class="fixed top-5 left-5 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-white" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">Already login.</div>
    <a href="index.php"  class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-white dark:hover:bg-gray-700" >
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
    <title>Home</title>
    <link href="/dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-white">
<?php 
include 'Navbar.php';
?>
    <div class="h-screen bg-gray-100 pt-12">

        <div class="max-w-sm mx-auto bg-gray-900 rounded-lg overflow-hidden shadow-lg">
            <div class="border-b px-4 pb-6">
                <div class="text-center my-4">
                    <img class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 mx-auto my-4" src="https://static.vecteezy.com/system/resources/previews/024/983/914/original/simple-user-default-icon-free-png.png" alt="">
                    <div class="py-2">
                        <h3 class="font-bold text-2xl text-white mb-1">
                            <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                echo '<div>' . $_SESSION['Name'] . '</div>';
                            }
                            ?>
                        </h3>
                        <div class="inline-flex text-white items-center">

                            <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                echo '<div>' . $_SESSION['Email'] . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 px-2">
                    <a href="updateProfile.php" class="flex justify-center items-center text-center rounded-full bg-blue-800 text-white font-medium hover:bg-blue-900 px-4 py-2">
                        Update Profile
                    </a>
                    <a href="forgotPassword.php" class="flex-1 text-center rounded-full border-2 border-gray-700 font-medium text-white px-4 py-2">
                        Forgot Password
                    </a>
                </div>
                <div class="text-center py-2 mt-3">
                    <a href="Logout.php" class="flex-1 text-center rounded-full font-medium text-black text-white bg-red-500 px-4 py-2">
                        Logout
                    </a>
                </div>
            </div>

        </div>

    </div>










    


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> -->
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

</body>

</html>