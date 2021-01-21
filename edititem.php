
<?php
/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-4
 * Purpose: update the quantity of the user selected products in the shoppingcarts table based on the userid and product name.
 *          Then repsond to ajax request with a text message
 * 
 */
include "connect.php";
session_start();
// validate the values user inputs
$product= filter_input(INPUT_GET, "item", FILTER_SANITIZE_SPECIAL_CHARS);
$quantity = filter_input(INPUT_GET, "amount", FILTER_VALIDATE_INT);
if(isset($_SESSION["userid"])){
// update quantity of specific item in the shoppincarts table according to the userid and product name
$command = "UPDATE shoppingcarts SET quantity=? WHERE userid= ? AND product = ?" ;
$stmt = $dbh->prepare($command);
$params = [$quantity,$_SESSION["userid"],$product];
$success = $stmt->execute($params);
echo "Change $product to $quantity lb";
}
?>


