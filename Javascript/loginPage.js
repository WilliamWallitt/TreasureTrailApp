// ;==========================================
// ; Title:  Front end Javascript request's (Login Page)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================

$("#login").focus(function(){
    $(this).removeAttr('placeholder');
 });
 
 
 $("#login").focusout(function(){
    $(this).attr('placeholder', 'username');
 });
 
 $("#password").focus(function(){ 
    $(this).removeAttr('placeholder');
 });
 
 
 $("#password").focusout(function(){
    $(this).attr('placeholder', 'password');
 });
 
function checkLoginCredentials() {
 
    let username = document.getElementById("login").value;
    let password = document.getElementById("password").value;

    if (username.length == 0 || password.length == 0) {
        alert("Please fill in the required fields");
        return;
    } 
    // Create a new user,
    fetch("../app/verify_account.php", {
    headers: { "Content-Type": "application/json; charset=utf-8" },
    method: 'POST',
    body: JSON.stringify({
        username: username,
        password: password
    })
    }).then(response => {
    return response.json();
    }).then(data => {

        if (data == false) {
            document.getElementById("login").value = "";
            document.getElementById("password").value = "";

            alert("Error: Invalid Username or Password");

            return;
        }
        window.location.href = "../views/ModifyDataPage.php";

    });
    return false;
}
 
 
