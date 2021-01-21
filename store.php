<?php

/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-3
 * Purpose: Verify if the user has already been in the users table by retrieving password from
 *          the table based on the username input and compare it with input password using password_verify
 *          method. If the username and password are valid, then user logs in successfully, and he or she
 *          can see the products details and perform actions according to the shopping carts. Otherwise,
 *          user's log in will be denied.
 * 
 */
include "connect.php";
session_start();
// validate user's input
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

//use query to check if the username and password has been registered in the users table
$command =  "SELECT * FROM users WHERE username =?";
$stmt = $dbh->prepare($command);
$params = [$username];
$success = $stmt->execute($params);
if ($success && $row = $stmt->fetch()) {
    // verify if the passord user input is same as password in the database. If so, use
    // $_SESSION to store the username and userid for later use
    if (password_verify($password, $row["passwords"])) {
        $_SESSION["username"] = $username;
        $_SESSION["userid"] = $row["userid"];
    } else { // if passords are not matched, destory the session
        session_unset();
        session_destroy();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fresh Fruit Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/operations.js"></script>
    <link rel="stylesheet" href="css/store.css">
</head>

<body>
    <?php

    // if the username has been stored into the associative array, then show the store
    // information to the user including product details and actions user can take
    if (isset($_SESSION["username"])) {
    ?>
        <h1>Welcome to Fresh Fruit <?= $_SESSION["username"] ?>!</h1>
        <div id="images">
            <div id="apples">
                <p>
                    <img src="images/GreenApples.jpg" title="Green Apples" alt="apples" style="width:200px;height:200px;">
                </p>
                <p>ID: 112/Green Apples/1.99/lb</p>
            </div>
            <div id="pears">
                <p>
                    <img src="images/YellowPears.jpg" title="Yellow Pears" alt="pears" style="width:200px;height:200px;">
                </p>
                <p>ID:113/Yellow Pears/3.99/lb</p>
            </div>
            <div id="dragonfruits">
                <p>
                    <img src="images/RedDragonFruites.jpg" title="Dragon Fruits" alt="Dragon Fruits" style="width:200px;height:200px;">
                </p>
                <p>ID:114/Red Dragon Fruits/9.99/lb</p>
            </div>
            <div id="dates">
                <p>
                    <img src="images/SweetDates.jpg" title="dates" alt="dates" style="width:200px;height:200px;">
                </p>
                <p>ID:115/Sweet Dates/5.99/lb</p>
            </div>
            <div id="grapes">
                <p>
                    <img src="images/PurpleGrapes.jpg" title="grapes" alt="grapes" style="width:200px;height:200px;">
                </p>
                <p>ID:116/Purple Grapes/8.99/lb</p>
            </div>
            <div id="orianges">
                <p>
                    <img src="images/AsianOrianges.jpg" title="orianges" alt="orianges" style="width:200px;height:200px;">
                </p>
                <p>ID:117/Asian Orianges/2.99/lb</p>
            </div>
        </div>
        <div id=actions>
            <div id="add">
                <p>
                    <img src="images/addCart.png" title="addcart" alt="addcart" style="width:100px;height:100px;">
                </p>
                <div>

                    <select name="fruits" id="fruits">
                        <option value="Green Apples">Green Apples</option>
                        <option value="Yellow Pears">Yellow Pears</option>
                        <option value="Red Dragon Fruits">Red Dragon Fruits</option>
                        <option value="Sweet Dates">Sweet Dates</option>
                        <option value="Purple Grapes">Purple Grapes</option>
                        <option value="Asian Orianges">Asian Orianges</option>
                    </select>
                    <br><br>
                    <input type="number" id="quantity" placeholder="1" value="1" min="1" autofocus><label for="quantity"> lb</label><br><br>
                    <input type="button" id="addme" value="Add"><br>
                </div>
            </div>
            <div id="edit">
                <p>
                    <img src="images/updateshoppingcart.jpg" title="updateitems" alt="updateitems" style="width:100px;height:100px;">
                </p>
                <div>
                    <select name="products" id="products">
                        <option value="Green Apples">Green Apples</option>
                        <option value="Yellow Pears">Yellow Pears</option>
                        <option value="Red Dragon Fruits">Red Dragon Fruits</option>
                        <option value="Sweet Dates">Sweet Dates</option>
                        <option value="Purple Grapes">Purple Grapes</option>
                        <option value="Asian Orianges">Asian Orianges</option>
                    </select>
                    <br><br>
                    <input type="number" id="amount" placeholder="1" value="1" min="1" autofocus><label for="amount"> lb</label><br><br>
                    <input type="button" id="editme" value="Edit Quantity"><br>
                </div>
            </div>
            <div id="remove">
                <p>
                    <img src="images/clearcart.jpg" title="clearcart" alt="clearcart" style="width:100px;height:100px;">
                </p>
                <div>
                    <select name="items" id="items">
                        <option value="Green Apples">Green Apples</option>
                        <option value="Yellow Pears">Yellow Pears</option>
                        <option value="Red Dragon Fruits">Red Dragon Fruits</option>
                        <option value="Sweet Dates">Sweet Dates</option>
                        <option value="Purple Grapes">Purple Grapes</option>
                        <option value="Asian Orianges">Asian Orianges</option>
                    </select>
                    <br><br>
                    <input type="button" id="removeme" value="Remove"><br>
                </div>
            </div>
        </div>

        <div id="transactions">Transaction Details</div>
        <div id="wrapper">
            <div id="additem"></div>
            <div id="edititem"></div>
            <div id="removeitem"></div>
        </div>
        <div id="checkout">
            <form action="summary.php" method="GET">
                <input type="submit" value="Go to Cart Summary" id="check">
            </form>
        </div>
    <?php
    } else { // if session has been distroied
    ?>
        <h1>Login Error! Access denied.</h1>
        <a href="index.html">Try again.</a>
    <?php
    }
    ?>
</body>

</html>