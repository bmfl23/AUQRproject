<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->
<!--/////////createAccount.php/////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Create Account Submission/Confirmmation Pg</title>

  <base herf="http://auburn.edu/student_info/ifc/webapplication/AUQR/"/>

  <link href="css/auqrStyle.css" rel="stylesheet" type="text/css"/>

  <!--Bootstrap scripts-->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!--////jQuery script links///////-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

  <!--////My Custom script links///////-->
  <script src="js/navDrawer.js"></script>
  <script type="text/javascript" src="js/navigationClicks.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.drawer').drawer({
        desktopEvent:'click'
      });
    });
  </script>

</head>

<body style="background-color:white;">

  <!--Nav Drawer Sart-->
  <!--/////////////////////////////////////////////////////-->
  <button class="drawer-toggle btn btn-outline-white" aria-label="menu">Menu 
      <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
  </button>     

    <div class="drawer drawer-default">
      <nav class="drawer-nav" role="navigation">
      <div class="drawer-brand" align="center">
        <a href="javascript:void(0);" onclick="navHomeClicked()">
          <img class="drawerImg" src="images/AUicon.png" > QR Menu
        </a> 
        </div>
        <ul class="nav drawer-nav-list" align="center">
          <li>
            <a href="javascript:void(0);" onclick="navHomeClicked()" aria-label="home">
              <span class="glyphicon glyphicon-home" aria-hidden="true">
              </span> Home</a>
          </li>
          <hr>
          <li>
            <a href="javascript:void(0);" onclick="navCreateAcctClicked()" aria-label="createAcct">
              <span class="glyphicon glyphicon-plus" aria-hidden="true">
              </span> Create Account</a>
          </li>
          <li>
            <a href="javascript:void(0);" onclick="navGenPQRClicked()" aria-label="pQR">
              <span class="glyphicon glyphicon-qrcode" aria-hidden="true">
              </span> Generate Personal QR</a>
          </li>
          <hr>
          <li>
            <a href="javascript:void(0);" onclick="navSignInClicked()" aria-label="signIn">
              <span class="glyphicon glyphicon-user" aria-hidden="true">
              </span> Sign-In</a>
          </li>
        </ul>
      </nav>
    </div>
    <!--//////////////////////////////////////////////////-->
    <!--Nav Drawer End-->

<!--/////////Page Content Start////////////////////-->
<div class="drawer-overlay">
    <br><br>
    <div class="container-fluid " align="center" style="max-width:980px;">
      <!--^^Align all center & sets max width^^-->    
      
      <header>
        <div class="container-fluid" id="AuQrbanner">
        <br>
          <table>
            <tbody>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
              <tr><td><img class="img-responsive" src="images/img_aubie.jpg"></td></tr>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
            </tbody>
          </table>
        <br>
        </div> 
      </header>

      <hr class=hrDivider align="center"></hr>         

      <h1 style="margin-top:0; padding-top:50px;">Attempting Confirmation</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container">
            <div id "wrap">
              <!--start php code -->
              <?php
                if(isset($_POST['usrFname']) && !empty($_POST['usrFname'])
                  AND isset($_POST['usrLname']) && !empty($_POST['usrLname'])
                  AND isset($_POST['auEmail']) && !empty($_POST['auEmail'])
                  AND isset($_POST['pwd1']) && !empty($_POST['pwd1'])
                  AND isset($_POST['pwd2']) && !empty($_POST['pwd2'])
                  AND isset($_POST['usrOrganization'])
                  AND ($_POST['pwd1'] == $_POST['pwd2']))
                {
                    //form submitted
                    $usrFname = mysql_escape_string($_POST['usrFname']); // Turn our post into a local variable
                    $usrLname = mysql_escape_string($_POST['usrLname']); // Turn our post into a local variable
                    $auEmail = mysql_escape_string($_POST['auEmail']); // Turn our post into a local variable
                    $pwd1 = mysql_escape_string($_POST['pwd1']); // Turn our post into a local variable
                    $pwd2 = mysql_escape_string($_POST['pwd2']); // Turn our post into a local variable
                    $usrOrganization = mysql_escape_string($_POST['usrOrganization']); // Turn our post into a local variable

                    //////////////Connect to DB/////////////////
                    $servername = "acadmysql.duc.auburn.edu";
                    $username = "bmf0008";
                    $password = "Bboy23";
                    $dbname = "AUQR_ifcDB";

                    mysql_connect($servername, $username, $password) or die(mysql_error()); // Connect to database server(localhost) with username and password.
                    mysql_select_db($dbname) or die(mysql_error()); // Select registrations database.

                    ////////GEN rand hash & pswrd////////
                    $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
                    // Example output: f4552671f8909587cf485ea990207f3b

                    //random pwd may not be needed
                    $randomPwd = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
                    // Example output: 4568

                    //need to create if statement that checks to see if account info already exist
                    $qry = mysql_query("SELECT * FROM auqr_usertable WHERE email='".$auEmail."'") or die(mysql_error()); 
                    $match = mysql_num_rows($qry);
                    
                      if($match == 0){
                      //matching will look at Email/username if exists

                      mysql_query("INSERT INTO auqr_usertable (email, password, fname, lname, hash, usrOrganization) VALUES(
                          '". mysql_escape_string($auEmail) ."', 
                          '". mysql_escape_string(md5($pwd1)) ."', 
                          '". mysql_escape_string($usrFname) ."', 
                          '". mysql_escape_string($usrLname) ."',
                          '". mysql_escape_string($hash) ."',
                          '". mysql_escape_string($usrOrganization) ."') ") or die(mysql_error());

                      //////////SEND VERIFICATION EMAIL///////
                      $to = $auEmail; // Send email to our user
                      $subject = 'Account Created | Verification'; // Give the email a subject 
$message = 
'

Thanks for Createing an Account!
Your account Information has been added to the IFC Database. 
You can now login with the following credentials after you have activated your account by follownig the link provided below.
   
------------------------
Username: '.$auEmail.'
Password: '.$pwd1.'
------------------------
                                   
Please click this link to activate your account:
http://auburn.edu/student_info/ifc/webapplication/AUQR/emailVerification.php?email='.$auEmail.'&hash='.$hash.'

'; 
// Our message above including the link......
                      $headers = 'From: noreply@auqr.com' . "\r\n"; // Set from headers
                      mail($to, $subject, $message, $headers); // Send our email
                      echo '<div class="statusmsg">A Confirmation message has been sent to your AU EMAIL.</div>';

                    }
                    else{
                      echo '<div class="statusmsg">A user with these Credentials already exists please try again.</div>';
                      echo '<div class="statusmsg">If you believe this to be an error then please contact an IFC admin on our support page.</div>';
                    }
                }
                else{
                  echo '<div class="statusmsg">Please review the information you submitted and make sure is all correct.</div>';
                  echo '<div class="statusmsg">If you are seeing this message your passwords may not have matched, or some required fields may not be filled out.</div>';
                }
              ?>
              <!-- stop PHP Code -->
            </div>
        </div>
      </div>
      <!--JUMBOTRON END-->
    </div>
</div>
<!--/////////Page Content END////////////////////-->
</body>
</html>
