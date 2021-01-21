
<?php
/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-4
 * Purpose: delete the record from the shoppingcarts table based on the userid and product name.
 *          Then repsond to ajax request with a text message
 * 
 */
include "connect.php";
session_start();
// validate the values user inputs
$fruit= filter_input(INPUT_GET, "fruit", FILTER_SANITIZE_SPECIAL_CHARS);
if(isset($_SESSION["username"])){
$command = "DELETE FROM shoppingcarts WHERE userid= ? AND product = ?" ;
$stmt = $dbh->prepare($command);
$params = [$_SESSION["userid"],$fruit];
$success = $stmt->execute($params);
echo "Remove $fruit";
}
?>


