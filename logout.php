<?php
/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-4
 * Purpose: create a log out page and user can go to the sign in page by using the link.
 *          However, user cannot go back to the previous papge because the session is destroied.
 * 
 */
session_start();
session_unset();
session_destroy();
?><!DOCTYPE html>
<html>

<head>
    <title>Login Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/summary.css">
</head>

<body>
    <h1>You are logged out.</h1>
    <a href="index.html">Log in again</a>
</body>

</html>