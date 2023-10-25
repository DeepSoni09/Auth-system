<?php
include 'Database-Connection.php';
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: Login.php?loginFirst=true");
}

if (isset($_REQUEST['Updated-Details'])) {
    $Updated_FirstName = $_REQUEST['FirstName'];
    $Updated_LastName = $_REQUEST['LastName'];

    if (empty($_REQUEST["FirstName"])) {
        $FirstNameEmpty = "*FirstName is required!";
        $err1 = '1';
    } else if (!ctype_alpha($_REQUEST["FirstName"])) {
        $FirstNameLetterOnly = "Only letters allowed!";
        $err2 = 1;
    } else {
        $Updated_FirstName = trim($_REQUEST["FirstName"]);
    }

    if (empty($_REQUEST["LastName"])) {
        $LastNameEmpty = "*LastName is required!";
        $err3 = 1;
    } else if (!ctype_alpha($_REQUEST["LastName"])) {
        $LastNameLetterOnly = "Only letters allowed!";
        $err4 = 1;
    } else {
        $Updated_LastName = trim($_REQUEST["LastName"]);
    }

    if (empty($_REQUEST["Email"])) {
        $EmailRequired = "*Email is required!";
        $err5 = 1;
    } else if (!filter_var($_REQUEST["Email"], FILTER_VALIDATE_EMAIL)) {
        $EmailNotValid = "Enter Valid Email!";
        $err6 = 1;
    } else {
        $Updated_Email = trim($_REQUEST["Email"]);
    }

    if (isset($Updated_FirstName) && isset($Updated_LastName) && isset($Updated_Email)) {

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            $id = $_SESSION['Id'];


            $sql = "UPDATE `user_data` SET `FirstName` = '$Updated_FirstName', `LastName` = '$Updated_LastName', `Email` = '$Updated_Email' WHERE `user_data`.`Id` = '$id';";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                session_unset();
                session_destroy();
                header('Location: Login.php?updateProfile=true');
            }
        }
    } else {
    }
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



    <main id="content" role="main" class="w-full  max-w-md mx-auto p-6">
        <div class="mt-7 bg-white  rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 border-2 border-indigo-300">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Enter Updated Details</h1>

                </div>

                <div class="mt-5">
                    <form action="updateProfile.php" method="post">
                        <div class="grid gap-y-4">
                            <div>
                                <label for="FirstName" class="block text-sm font-bold ml-1 mb-2 dark:text-white">Enter
                                    FirstName</label>
                                <div class="relative">
                                    <input type="text" id="FirstName" name="FirstName" class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" aria-describedby="email-error">
                                    <div style="color:red;">
                                        <?php if (isset($err1)) {
                                            echo $FirstNameEmpty;
                                        } else if (isset($err2)) {
                                            echo $FirstNameLetterOnly;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="LastName" class="block text-sm font-bold ml-1 mb-2 dark:text-white">Enter
                                    LastName</label>
                                <div class="relative">
                                    <input type="text" id="LastName" name="LastName" class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" aria-describedby="email-error">
                                    <div style="color:red;">
                                        <?php if (isset($err3)) {
                                            echo $LastNameEmpty;
                                        } else if (isset($err4)) {
                                            echo $LastNameLetterOnly;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="Email" class="block text-sm font-bold ml-1 mb-2 dark:text-white">Enter
                                    Email</label>
                                <div class="relative">
                                    <input type="text" id="Email" name="Email" class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" aria-describedby="email-error">

                                    <div style="color:red;">
                                        <?php if (isset($err5)) {
                                            echo $EmailRequired;
                                        } else if (isset($err6)) {
                                            echo $EmailNotValid;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Update" name="Updated-Details" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

</body>

</html>