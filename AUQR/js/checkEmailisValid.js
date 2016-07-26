<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 * Method:
 *  checkEmailValid.js
 *      - checkEmail() - preforms dynamic valid email input.
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->

function checkEmail()
{
    //Store the email field objects into variables ...
    var emailValid = "no"
    var auEmail = document.getElementById('auEmail');
    //var auDomain = document.getElementById('auDomain');
    var atIndStrt = auEmail.value.indexOf("@");
    var atIndEnd = auEmail.value.length;
    var res = auEmail.value.substring(atIndStrt,atIndEnd);
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage1');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(res == "@auburn.edu"){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        emailValid == "yes"
        auEmail.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Valid Email!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        emailValid == "no"
        auEmail.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Invalid Email!"
        window.alert("Not a valid Auburn Email: " + auEmail.value);
        window.alert("Change: " + res + " to valid @auburn.edu");
    }
}