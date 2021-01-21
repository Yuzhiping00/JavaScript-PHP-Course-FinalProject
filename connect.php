<?php
/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-2
 * Purpose: This file is used to connect to the database
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=000822513",
        "000822513",
        "19900805"
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
