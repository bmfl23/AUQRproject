<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->
<!--/////////changeUsrOrganization.php/////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Password Change Confirmmation Pg</title>

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

      <h1 style="margin-top:0; padding-top:50px;">Attempting Organization/Group Modification.</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container">
            <div id "wrap">
              <!--start php code -->
              <?php
                if(isset($_POST['auEmail']) && !empty($_POST['auEmail'])
                  AND isset($_POST['modUsrOrganization']) && !empty($_POST['modUsrOrganization']))
                {
                    $auEmail = mysql_escape_string($_POST['auEmail']); // Turn our post into a local variable
                    $org = mysql_escape_string($_POST['modUsrOrganization']); // Turn our post into a local variable

                    //////////////Connect to DB/////////////////
                    $servername = "acadmysql.duc.auburn.edu";
                    $username = "bmf0008";
                    $password = "Bboy23";
                    $dbname = "AUQR_ifcDB";

                    mysql_connect($servername, $username, $password) or die(mysql_error()); // Connect to database server(localhost) with username and password.
                    mysql_select_db($dbname) or die(mysql_error()); // Select registrations database.

                    //need to create if statement that checks to see if account info already exist
                    $qry = mysql_query("SELECT * FROM auqr_usertable WHERE email='".$auEmail."'") or die(mysql_error()); 
                    $match = mysql_num_rows($qry);

                    $row = mysql_fetch_assoc($qry);
                    $hash = $row['hash'];
                    
                      if($match == 1){
                        //matching will look at Email/username if exists
                        mysql_query("UPDATE auqr_usertable SET usrOrganization='". mysql_escape_string($org) ."' WHERE email='".$auEmail."'") or die(mysql_error());
                        echo '<div class="statusmsg">You are now associated with : '.$org.'.</div>';
                        echo '<div class="statusmsg">Please be respectful and mindful of this privilege.</div>';
                      }
                      else{
                        echo '<div class="statusmsg">Woops! Something went wrong when communicating with the server. Please try again later.</div>';
                        echo '<div class="statusmsg">Your Organization has NOT been changed.</div>';
                      }
                  }
                  else{
                    echo '<div class="statusmsg">Your Organization has NOT been changed.</div>';
                    echo '<div class="statusmsg">Please review the information you submitted and make sure is all correct.</div>';
                    echo '<div class="statusmsg">If you are seeing this message your passwords may not have matched, or some required fields may not be filled out.</div>';
                  }
                ?>
                <!-- stop PHP Code -->
            </div>
            <p>
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="navAccountHomepageClicked()" role="button" Style="background-color: #0B0B61;">Go to Account Homepage »</a>
            </p>
        </div>
      </div>
      <!--JUMBOTRON END-->
    </div>
</div>
<!--/////////Page Content END////////////////////-->
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
