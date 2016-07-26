<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->
<!--/////////signIn.php/////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Sign in verifivation</title>

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

      <h1 style="margin-top:0; padding-top:50px;">Sorry, Log In Failed!</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container">
            <div id "wrap">
              <!--start php code -->
              <?php
                  if(isset($_POST['auEmail']) && !empty($_POST['auEmail']) AND isset($_POST['pwd1']) && !empty($_POST['pwd1'])){
                          
                          // Both fields are being posted and the're not empty
                          $auEmail = mysql_escape_string($_POST['auEmail']); // Turn post into a local variable
                          $pwd1 = mysql_escape_string(md5(($_POST['pwd1']))); // Turn post into a local variable

                          //////////////Connect to DB/////////////////
                          $servername = "acadmysql.duc.auburn.edu";
                          $username = "bmf0008";
                          $password = "Bboy23";
                          $dbname = "AUQR_ifcDB";

                          mysql_connect($servername, $username, $password) or die(mysql_error()); // Connect to database server(localhost) with username and password.
                          mysql_select_db($dbname) or die(mysql_error()); // Select registrations database.

                          $search = mysql_query("SELECT * FROM auqr_usertable WHERE email='".$auEmail."' AND active='1'") or die(mysql_error()); 
                          //$match  = mysql_num_rows($search);  
                          $row = mysql_fetch_assoc($search);
                          $pwdStr = $row['password'];
                          $hash = mysql_escape_string(trim($row['hash']));
                          $auEmail = mysql_escape_string(trim($row['email']));

                              if($pwd1 == $pwdStr){
                                $msg = 'Login Complete! Thanks';
                                echo '<script>window.location = "AuQrAccountHomepage.php?email='. mysql_escape_string($auEmail) .'&hash='. mysql_escape_string($hash) .'";</script>';
                                
                              }
                              else{
                                //login failed
                                echo '<div class="statusmsg">Login Failed! Please make sure that you enter the correct details and that you have activated your account. If the problem continues please contact an IFC/AUQR Admin for Assistance.</div>';
                              }
                      }
              ?>
              <!-- stop PHP Code -->
            </div>
            <p>
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="navHomeClicked()" role="button" Style="background-color: #0B0B61;">Go Back to Home »</a>
            </p>
        </div>
      </div>
      <!--JUMBOTRON END-->
    </div>
</div>
<!--/////////Page Content END////////////////////-->

</body>
</html>