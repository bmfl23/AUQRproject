<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->
<!--/////////requestAdminAuthorization.php/////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Admin Authorization request Pg</title>

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

      <hr class="hrDivider" align="center"></hr>         

      <h1 style="margin-top:0; padding-top:50px;">Your Request Has been sent.</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container">
          <h1></h1>
            <div id "wrap">
            <!-- start PHP code -->
            <?php
$ifcEmail = "bmf0008@auburn.edu";        
//////////SEND REQUEST Admin EMAIL///////
$to = $ifcEmail; // Send email to ifc
$subject = 'Requesting Admin Privledges | Authorization'; // Give the email a subject 
$message = 
'
------------------------
Username: '.$auEmail.'
------------------------
Would like to request Admin Privledges!
If you TRUST this user and wish to grant them access to admin privledges click the link provided below.

Otherwise: please Send them an Email telling them why you denied their request.
                                   
Click this link to Authorize:
http://auburn.edu/student_info/ifc/webapplication/AUQR/authorizeUser.php?email='.$auEmail.'

'; 
// Our message above including the link......
          $headers = 'From: noreply@auqr.com' . "\r\n"; // Set from headers
          mail($to, $subject, $message, $headers); // Send our email
          echo '<div class="statusmsg">Your request has been sent and is being processed.</div>';
          echo '<div class="statusmsg">Please allow 1-3 buisness Days for request to be processed.</div>';
        ?>
            <!-- stop PHP Code -->
            </div>
            <p>
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="navAccountHomepageClicked()" role="button" Style="background-color: #0B0B61;">Return to Account Homepage »</a>
            </p>
        </div>
      </div>
      <!--Jumbotron END-->
    </div>
</div>
<!--/////////Page Content END////////////////////-->
<!--pulling the hash-->
<?php
  $servername = "acadmysql.duc.auburn.edu";
  $username = "bmf0008";
  $password = "Bboy23";
  $dbname = "AUQR_ifcDB";

  mysql_connect($servername, $username, $password) or die(mysql_error()); // Connect to database server(localhost) with username and password.
  mysql_select_db($dbname) or die(mysql_error()); // Select registrations database.

  //searching db to verify
  $qry = mysql_query("SELECT * FROM auqr_usertable WHERE email='".$auEmail."'AND active='1'") or die(mysql_error()); 
  $match  = mysql_num_rows($qry);

  $row = mysql_fetch_assoc($qry);
  $hash = $row['hash'];
?>

<!--JS functions for NAV Drawer Buttons-->
  <script type="text/javascript">
    /*Account Home*/
    function navAccountHomepageClicked() {
        <?php
            echo 'window.location = "AuQrAccountHomepage.php?email='. mysql_escape_string($auEmail) .'&hash='. mysql_escape_string($hash) .'";';
        ?>
    }
  </script>

</body>
</html>