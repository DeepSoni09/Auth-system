<?php
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header('Location: Login.php?loginFirst=true');
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
                    <img class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 mx-auto my-4" src="https://randomuser.me/api/portraits/women/21.jpg" alt="">
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
                <div class="flex gap-2 px-2 ">
                    <a href="updateProfile.php" class="flex justify-center items-center text-center rounded-full bg-blue-800 text-white font-medium hover:bg-blue-900 px-4 py-2">
                        Update Profile
                    </a>
                    <a href="forgotPassword.php" class="flex-1 text-center rounded-full border-2 border-gray-700 font-medium text-white px-4 py-2">
                        Forgot Password
                    </a>
                </div>
                <div class="text-center py-2 mt-3">
                    <a href="Logout.php" class="flex-1 text-center rounded-full font-medium text-black text-white dark:bg-red-500 px-4 py-2">
                        Logout
                    </a>
                </div>
            </div>

        </div>

    </div>










    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

</body>

</html>