<?php
 /**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-8
 * Purpose: Use session management to check if user has logged in successfully. if so,
 *          provide the summary of the user's shopping cart including products name and 
 *          quantity based on the userid. Then user can use links to go back to the previous
 *          page to add, remove or edit the products from the carts. Centaily, user can go 
 *          forward to log out page.
 *          
 * 
 */
 include "connect.php";
 session_start();

?><!DOCTYPE html>
<html>
<head>
    <title>Show Summary</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/summary.css">
        
</head>

<body>
    
    <div id="details">    
    <?php
    if(isset($_SESSION["username"])){
        
    ?>
    <h1>This is your Cart Summary</h1>
    
    <?php
        
        // select the product name and quantity from the shoppingcarts table based on userid
        $command = "SELECT * FROM shoppingcarts WHERE userid= ? order by product";
        $stmt = $dbh->prepare($command);
        $params = [$_SESSION["userid"]];
        $success = $stmt->execute($params);
        // if userid is valid, display the product name and quantity
        if($success){
            while($row = $stmt -> fetch()){
                echo "<p>$row[product] $row[quantity]lb(s)</p><br>";
            }
        } 
        // provide two links to go back to the previous page or next page
        echo "<a href='store.php'>Go Back</a><br><br>";
        echo "<a href='logout.php'>Move Forward</a><br><br>";

        ?>
        <?php   
        }else{ // if username is invalid, display error message
            echo "<h1>Not Logged in. Access denied.</h1>";
            echo "<a href='index.html'>Log in Again</a><br><br>";
        }
    ?>
    <div id="images">
        <img src="images/shoppingcart.jpg" title="fruit">
        <img src="images/store.jpg" title="store">
    </div>
    
    </div>
</body>

</html>