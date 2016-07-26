<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Method:
 *  navigationClicks.js
 *      - navHomeClicked() - Navigation to page.
 *      - navCreateAcctClicked() - Navigation to page.
 *      - navGenPQRClicked() - Navigation to page.
 *      - navSignInClicked() - Navigation to page.
 *      - navLogOutClicked() - Navigation to page.
 *      - forgotCredentialsClicked() - Navigation to page.
 *
 * Date: 4/14/2016
 * @author Brandon Fernandez 
 */
-->
<!--////navigationClicks.js////-->
  /*Home*/
    function navHomeClicked() {
        window.location = "AuQrHomepage.html";
    }
    /*Create Account*/
    function navCreateAcctClicked() {
        window.location = "AuQrCreateAcctPage.html";
    }
    /*Generate/display personal QR*/
    function navGenPQRClicked() {
        window.location = "AuQrGenPQRdemoPage.html";
    }
    /*sign in*/
    function navSignInClicked() {
        window.location = "AuQrSignInPage.html";
    }
    /*forgot credentials*/
    function forgotCredentialsClicked(){
        window.location = "AuQrForgotCredentials.html";
    }