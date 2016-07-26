<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->       
<!--////////GENERATE QR Page//////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Generate Qr</title>

  <base herf="http://auburn.edu/student_info/ifc/webapplication/AUQR/"/>

  <link href="css/auqrStyle.css" rel="stylesheet" type="text/css"/>

  <!--Bootstrap Scripts-->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!--////jQuery script links///////-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

  <!--////My Custom script links///////-->
  <script src="js/navDrawer.js"></script>

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
  <!--//////////////////////////////////////////////////////////////////-->
  <button class="drawer-toggle btn btn-outline-white" aria-label="menu">Menu 
      <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
  </button>      

    <div class="drawer drawer-default">
      <nav class="drawer-nav" role="navigation">
      <div class="drawer-brand" align="center">
        <a href="javascript:void(0);" onclick="navAccountHomepageClicked()">
          <img class="drawerImg" src="images/AUicon.png" > QR Menu
        </a>
      </div>
        <ul class="nav drawer-nav-list" align="center">
          <li>
            <a href="javascript:void(0);" onclick="navAccountHomepageClicked()" aria-label="home">
              <span class="glyphicon glyphicon-home" aria-hidden="true">
              </span>Account Home</a>
          </li>
          <hr>
          <li>
            <a href="javascript:void(0);" onclick="navGenPQRpageClicked()" aria-label="pQR">
              <span class="glyphicon glyphicon-qrcode" aria-hidden="true">
              </span> Generate Personal QR</a>
          </li>
          <li>
            <a href="javascript:void(0);" onclick="navViewAcctActivityClicked()" aria-label="createAcct">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true">
              </span> View Account/Event Activity</a>
          </li>
          <li>
            <a href="javascript:void(0);" onclick="navManageAccountClicked()" aria-label="createAcct">
              <span class="glyphicon glyphicon-wrench" aria-hidden="true">
              </span> Manage Account</a>
          </li>
          <hr>
          <li>
            <a href="javascript:void(0);" onclick="logoutClicked()" rel="nofollow" aria-label="logOut">
              <span class="glyphicon glyphicon-log-out" aria-hidden="true">
              </span> Log-Out</a>
          </li>
        </ul>
      </nav>
    </div>
    <!--//////////////////////////////////////////////////-->
    <!--Nav Drawer End-->

<!--///////////PAGE CONTENT/////////////////////////////-->
<div class="drawer-overlay">
    <br><br>
    <div class="container-fluid " align="center" style="max-width:980px;">
      <!--^^Align all center & sets max width^^-->    
      <header>
        <div class="container-fluid" id="AuQrbanner">
        <br/>
          <table>
            <tbody>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
              <tr><td><img class="img-responsive" src="images/img_genQr.png"></td></tr>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
            </tbody>
          </table>
        <br/>
        </div> 
      </header>

      <hr class="hrDivider" align="center"></hr>         

      <h1 style="margin-top:0; padding-top:50px;">AU QR Generate Qr.</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container">
          <h1 style = "font-size: 100%;" >Click the button below to generate personal Qr Code.</h1>
            <!--Start Qr gen php-->
            <!--/////////QR GEN CODE/////////////-->     
            <?php
              include('phpqrcode/qrlib.php');

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
          
                $param = trim($_GET['email']); // remember to sanitize that - it is user input! 

                ob_start("callback"); 
                                     
                // here DB request or some processing 
                $codeText = $param; 
                                     
                // end of processing here 
                $debugLog = ob_get_contents(); 
                ob_end_clean(); 

                //write code into file, Error corection lecer is lowest, L (one form: L,M,Q,H)
                //each code square will be 10x10 pixels (10x zoom)
                //code will have 4 code squares white boundary around 
                $emailSplit = explode("@", $codeText);
                $usr = trim($emailSplit[0]);
                $imgPath = trim("image/png/".$usr."QR.png");
                QRcode::png($codeText, "image/png/".$usr."QR.png", 'L', 10, 4);          
            ?>
          <div class="container-fluid" id="PQRimg" style="display: none;">
            <br>
              <table>
                <tbody>
                  <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
                  <tr><td><img class="img-responsive" src=<?php echo $imgPath;?>><!--<?php //QRcode::png($codeText);?>--></td></tr>
                  <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
                </tbody>
              </table>
            <br>
          </div>
            <?php
              }
              else{
                echo '<div class="statusmsg">Invalid approach, validation Failed.</div>';
                echo '<div class="statusmsg">Something went wrong try signing out and back in before attempting again.</div>';
              }           
            ?>
          <!--/////////QR GEN CODE END/////////////-->
          <!--DISPLAYS GENERATED QR-->
          <!--Create toggle that dislpays/hides the examplrPQRimg table-->
          <a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="toggleTable()" role="button" Style="background-color: #0B0B61;">Generate Qr »</a>

          <div class="container-fluid">  
              <p>
                OR
              <a href="javascript:void(0);" onclick="navAccountHomepageClicked()">Back to Account homepage »</a>
              </p>
          </div>
        </div>
      </div>
      <!--JUMBOTRON END-->
    </div>
  </div>
  <!--/////////////Page Content END ///////////////////////-->

<script type="text/javascript">

  /*Account Home*/
    function navAccountHomepageClicked() {
        <?php
            echo 'window.location = "AuQrAccountHomepage.php?email='. mysql_escape_string($auEmail) .'&hash='. mysql_escape_string($hash) .'";';
        ?>
    }
    /*generate qr*/
    function navGenPQRpageClicked() {
        <?php
            echo 'window.location = "AuQrGenPQRpage.php?email='. mysql_escape_string($auEmail) .'&hash='. mysql_escape_string($hash) .'";';
        ?>
    }
    /*account activity*/
    function navViewAcctActivityClicked() {
      <?php
        $adminstatus  = $row['adminstatus'];
        if ($adminstatus == '1'){
          echo 'window.location = "AuQrAccountActivityPageAdminView.php?email='. mysql_escape_string($auEmail) .'&hash='. mysql_escape_string($hash) .'";';
        }
        else{
          echo 'window.location = "AuQrAccountActivityPageUserView.php?email='. mysql_escape_string($auEmail) .'&hash='. mysql_escape_string($hash) .'";';
        }
      ?>
    }
    /*manage account*/
    function navManageAccountClicked() {
        <?php
            echo 'window.location = "AuQrManageAccountPage.php?email='. mysql_escape_string($auEmail) .'&hash='. mysql_escape_string($hash) .'";';
        ?>
    }
    /*log out*/
    function logoutClicked(){
      window.location = "AuQrHomepage.html";
    }
    /*Toggle QR*/
    function toggleTable() {
        document.getElementById("PQRimg").style.display = "block";
    }
</script>
</body>
</html> 