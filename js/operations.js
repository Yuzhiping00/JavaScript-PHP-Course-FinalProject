/**
 * Name: Zhiping Yu student number: 000822513
 * File created date: 2020-12-4
 * Purpose: provide event handlers after user triggers some events. In addtion, use ajax to
 *          send request and obtain responses from the server. Finally, display the content 
 *          received on the page 
 * 
 */

window.addEventListener("load", function() {  
    let addFruit = document.getElementById("addme");
    /**
     * When user clicks the add button, send product name and quantity to the server by using
     * get method in a ajax request. Then fetch the additem.php file, get response and display the result. 
     */
    addFruit.addEventListener("click", function(){
    let frame= document.getElementById("wrapper");
    frame.style.visibility="visible";
    let product = document.getElementById("fruits").value;
    let quantity = document.getElementById("quantity").value;
    let url ="additem.php?product="+product+"&quantity="+quantity;
    fetch(url,{credentials: 'include'})
        .then(response => response.text())
        .then(function(text){
            let addinfo = document.getElementById("additem");
            addinfo.innerHTML+= text+"<br><br>";
            addinfo.style.color="Blue";
            addinfo.style.fontSize="20px";  
        })
    });

    
    let editQuantity = document.getElementById("editme");
    /**
     * When user clicks the editme button, send item and amount to the server by using
     * get method in a ajax request. Then fetch the edititem.php file, get response and display the result. 
     */
    editQuantity.addEventListener("click",function(){
        let frame= document.getElementById("wrapper");
        frame.style.visibility="visible";
        let item = document.getElementById("products").value;
        let amount = document.getElementById("amount").value;
        let url = "edititem.php?item="+item+"&amount="+amount;
        fetch(url,{credentials: 'include'})
            .then(response => response.text())
            .then(function(text){
                let edititem = document.getElementById("edititem")
                edititem.innerHTML+= text+"<br><br>";
                edititem.style.color="green";
                edititem.style.fontSize="20px"; 

            })
    })

    let removeit = document.getElementById("removeme");
    /**
     * When user clicks the removeme button, send fruit name to the server by using
     * get method in a ajax request. Then fetch the removeitem.php file, get response and display the result. 
     */
    removeit.addEventListener("click",function(){
        let frame= document.getElementById("wrapper");
        frame.style.visibility="visible";
        let fruit = document.getElementById("items").value;
        let url = "removeitem.php?fruit="+fruit;
        fetch(url,{credentials: 'include'})
            .then(response => response.text())
            .then(function(text){
                let removeitem = document.getElementById("removeitem")
                removeitem.innerHTML+= text+"<br><br>";
                removeitem.style.color="Red";
                removeitem.style.fontSize="20px"; 

            })
    })

    


    
 });