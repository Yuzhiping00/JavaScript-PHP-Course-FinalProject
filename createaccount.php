<?php

/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-8
 * Purpose: insert a new user record into users table after validating the values user input
 *          and hash the password. The password is stored into the table is hashed version, 
 *          which hide information on the server
 */
include "connect.php";
// validate username and password user input
$username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS); 
$password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

// when username is not registered, hash the password and store username and the hashed password into users table
if($username !== null && $username !== "" && $password !== null && $password !== ""){

    $command ="select * from users";
    $stmt = $dbh -> prepare($command);
    $success = $stmt -> execute(); 
    $count = 0; // used to check if username is already in the users table
    if($success){
        while($row = $stmt -> fetch() ){
            if($row["username"]=== $username){
                $count++;
                echo "<h1>Register failed</h1>";
                echo "<p>Your username has already been registered! Please use another username</p>";
                echo " <a href='index.html'>Go back to log in page.</a>";
                break;
          }
        }
        if($count === 0){ // users table has no same username as user input
            $hashPassword = password_hash($username,PASSWORD_BCRYPT);
            // insert a new user into the users table
            $command = "INSERT into users(username, passwords) values (?,?)";
            $stmt = $dbh -> prepare($command);
            $params = [$username, $hashPassword];
            $success2 = $stmt -> execute($params);
            if($success2){
                echo " <h1>Register Successfully!</h1>";
                echo "<a href='index.html'>Go back to the log in page.</a>";
            }
        }
    } 
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create Account Result</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/summary.css">
    <style>
        p{
            color:red;
            margin-bottom: 40px;
            
        }
    </style>
</head>
<body>
</body>
</html>