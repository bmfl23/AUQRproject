<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->
<!--/////////emailVerification.php/////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Email Verification Pg</title>

  <base herf="http://auburn.edu/student_info/ifc/webapplication/AUQR/"/>

  <link href="css/auqrStyle.css" rel="stylesheet" type="text/css"/>

  <!--Bootstrap Scripts-->
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

      <h1 style="margin-top:0; padding-top:50px;">Your Auburn Email has been verified.</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container">
          <h1></h1>
            <div id "wrap">
            <!-- start PHP code -->
            <?php
             
                $servername = "acadmysql.duc.auburn.edu";
                $username = "bmf0008";
                $password = "Bboy23";
                $dbname = "AUQR_ifcDB";

                mysql_connect($servername, $username, $password) or die(mysql_error()); // Connect to database server(localhost) with username and password.
                mysql_select_db($dbname) or die(mysql_error()); // Select registrations database.

                if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                  //echo '<div class="statusmsg">If statement 1 now entered...</div>';
                  // Verify data
                  $auEmail = mysql_escape_string($_GET['email']); // Set email variable
                  $hash = mysql_escape_string($_GET['hash']); // Set hash variable
                  
                  //searching db to verify
                  $search = mysql_query("SELECT * FROM auqr_usertable WHERE email='".$auEmail."' AND hash='".$hash."' AND active='0'") or die(mysql_error()); 
                  $match  = mysql_num_rows($search);
                  $row = mysql_fetch_assoc($search);
                  
                    if($match == 1){
                        // We have a match, activate the account
                        mysql_query("UPDATE auqr_usertable SET active='1' WHERE email='".$auEmail."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
                        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
                    }
                    else{
                        // No match -> invalid url or account has already been activated.
                        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
                    }
                }
                else{
                  echo '<div class="statusmsg">Invalid approach, please use the link that has been sent to your email.</div>';
                }
                 
            ?>
            <!-- stop PHP Code -->
            </div>
            <p>
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="navAccountHomepageClicked()" role="button" Style="background-color: #0B0B61;">Go to Account Homepage »</a>
            </p>
        </div>
      </div>
      <!--Jumbotron END-->
    </div>
</div>
<!--/////////Page Content END////////////////////-->

<!--JS functions for NAV Drawer Buttons-->
  <script type="text/javascript">
    function navAccountHomepageClicked(){

      <?php
      echo 'window.location = "AuQrAccountHomepage.php?email='.$auEmail.'&hash='.$hash.'";'; 
      ?>

    }
  </script>

</body>
</html>