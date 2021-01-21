
<?php
/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-4
 * Purpose: insert a new record into the table based on the userid, product name and quantity.
 *          Then repsond to ajax request with a text message
 * 
 */
include "connect.php";
session_start();
// validate the values user inputs
$product= filter_input(INPUT_GET, "product", FILTER_SANITIZE_SPECIAL_CHARS);
$quantity = filter_input(INPUT_GET, "quantity", FILTER_VALIDATE_INT);
if(isset($_SESSION["username"])){
// Insert a new item into the shoppingcarts table in the database
$command = "INSERT INTO shoppingcarts(userid,product,quantity) VALUES(?,?,?)";
$stmt = $dbh->prepare($command);
$params = [$_SESSION["userid"],$product, $quantity];
$success = $stmt->execute($params);
echo "Add $product $quantity lb";
}
?>


