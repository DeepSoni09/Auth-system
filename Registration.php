<?php
include 'Database-Connection.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: index.php?alreadyLoggedin=true");
}

$alreadyexists = false;
$signin = false;
$passnotmatch = false;


if (isset($_REQUEST['Register'])) {

    $ConfirmPassword = trim($_REQUEST["Confirm-Password"]);


    if (empty($_REQUEST["FirstName"])) {
        $FirstNameEmpty = "*FirstName is required!";
        $err1 = '1';
    } else if (!ctype_alpha($_REQUEST["FirstName"])) {
        $FirstNameLetterOnly = "Only letters allowed!";
        $err2 = 1;
    } else {
        $FirstName = trim($_REQUEST["FirstName"]);
    }

    if (empty($_REQUEST["LastName"])) {
        $LastNameEmpty = "*LastName is required!";
        $err3 = 1;
    } else if (!ctype_alpha($_REQUEST["LastName"])) {
        $LastNameLetterOnly = "Only letters allowed!";
        $err4 = 1;
    } else {
        $LastName = trim($_REQUEST["LastName"]);
    }

    if (empty($_REQUEST["Email"])) {
        $EmailRequired = "*Email is required!";
        $err5 = 1;
    } else if (!filter_var($_REQUEST["Email"], FILTER_VALIDATE_EMAIL)) {
        $EmailNotValid = "Enter Valid Email!";
        $err6 = 1;
    } else {
        $Email = trim($_REQUEST["Email"]);
    }

    if (empty($_REQUEST["Password"])) {
        $PasswordEmpty = "*Password cannot be empty!";
        $err7 = 1;
    } else if ($_REQUEST["Password"] != $_REQUEST["Confirm-Password"]) {
        $NotEqualPassword = "Password did not match";
        $err8 = 1;
    } else {
        $Password = trim($_REQUEST["Password"]);
    }

    if (isset($FirstName) && isset($LastName) && isset($Email) && isset($Password)) {


        $sql_name = "SELECT * FROM `user_data` WHERE Email='$Email';";
        $res_name = mysqli_query($conn, $sql_name);
        if (mysqli_num_rows($res_name) > 0) {
            $alreadyexists = true;
        } else {
            if ($Password == $ConfirmPassword) {
                $hash = password_hash($Password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `user_data` (`FirstName`, `LastName`, `Email`, `Password`) VALUES ('$FirstName', '$LastName', '$Email', '$hash');";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $signin = true;

                    header("Location: Login.php?registerSuccess=true");
                }
            } else {
                $passnotmatch = true;
            }
        }
    }
}

?>





<?php

if ($signin) {
    echo '<div id="toast-success" class="fixed top-5 left-5 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-white" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">Account created successfully.</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-white dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>';
}
if ($alreadyexists) {
    echo '<div id="toast-danger" class="fixed top-5 left-5 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-white" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">Email already exists.</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-white dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>';
}
if ($passnotmatch) {
    echo '<div id="toast-warning" class="fixed top-5 left-5 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-white" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Warning icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">Password does\'nt match.</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-white dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="/dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
</head>

<body>

    <?php
    include 'Navbar.php';
    ?>


    <div class="p-10">
        <h1 class="mb-8 font-extrabold text-4xl">Register</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <form action="Registration.php" method="post">
                <div>
                    <label class="block font-semibold" for="name">FirstName</label>
                    <input class="w-full shadow-inner bg-gray-100 rounded-lg placeholder-black text-2xl p-4 border-none block mt-1 w-full" id="name" type="text" name="FirstName">
                    <div style="color:red;">
                        <?php if (isset($err1)) {
                            echo $FirstNameEmpty;
                        } else if (isset($err2)) {
                            echo $FirstNameLetterOnly;
                        } ?>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block font-semibold" for="name">LastName</label>
                    <input class="w-full shadow-inner bg-gray-100 rounded-lg placeholder-black text-2xl p-4 border-none block mt-1 w-full" id="name" type="text" name="LastName">
                    <div style="color:red;">
                        <?php if (isset($err3)) {
                            echo $LastNameEmpty;
                        } else if (isset($err4)) {
                            echo $LastNameLetterOnly;
                        } ?>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-semibold" for="email">Email</label>
                    <input class="w-full shadow-inner bg-gray-100 rounded-lg placeholder-black text-2xl p-4 border-none block mt-1 w-full" id="email" type="text" name="Email">
                    <div style="color:red;">
                        <?php if (isset($err5)) {
                            echo $EmailRequired;
                        } else if (isset($err6)) {
                            echo $EmailNotValid;
                        } ?>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-semibold" for="password">Password</label>
                    <input class="w-full shadow-inner bg-gray-100 rounded-lg placeholder-black text-2xl p-4 border-none block mt-1 w-full" id="password" type="password" name="Password">
                    <div style="color:red;">
                        <?php if (isset($err7)) {
                            echo $PasswordEmpty;
                        } elseif (isset($err8)) {
                            echo $NotEqualPassword;
                        }
                        ?>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-semibold" for="password">Confirm Password</label>
                    <input class="w-full shadow-inner bg-gray-100 rounded-lg placeholder-black text-2xl p-4 border-none block mt-1 w-full" id="password" type="password" name="Confirm-Password">
                </div>

                <div class="flex items-center justify-between mt-8">


                    <input type="submit" class="flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10" value="Register" name="Register">
                    <a href="Login.php" class="font-semibold">
                        Already registered?
                    </a>
                </div>
            </form>

            <aside class="">
                <div class="bg-gray-100 p-8 rounded">
                    <h2 class="font-bold text-2xl">Instructions</h2>
                    <ul class="list-disc mt-4 list-inside">
                        <li>All users must provide a email address and password to create an account.</li>
                        <li>Users must not use offensive, vulgar, or otherwise inappropriate language in their username
                            or profile information</li>
                        <li>Users must not create multiple accounts for the same person.</li>
                    </ul>
                </div>
            </aside>

        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

</body>

</html>