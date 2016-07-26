<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->

<!--/////////AUQR HOMEPAGE/////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Account Homepage</title>

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
  <!--/////////////////////////////////////////////////////-->
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
              <tr><td><img class="img-responsive" src="images/img_aubieId.jpg"></td></tr>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
            </tbody>
          </table>
        <br>
        </div> 
      </header>

      <hr class=hrDivider align="center"></hr>         

      <h1 style="margin-top:0; padding-top:50px;">Account Homepage</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container">
          <!--display some info from DB php -->
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
                  $auEmail = trim(mysql_escape_string($_GET['email'])); // Set email variable
                  $hash = trim(mysql_escape_string($_GET['hash'])); // Set hash variable
                  
                  //searching db to verify
                  $qry = mysql_query("SELECT * FROM auqr_usertable WHERE email='".$auEmail."' AND hash='".$hash."'AND active='1'") or die(mysql_error()); 
                  $match  = mysql_num_rows($qry);

                  $row = mysql_fetch_assoc($qry);
                  $hash2 = $row['hash'];

                    if($match == 1){
                        $fnameStr = $row['fname'];
                        $lnameStr = $row['lname'];
                        
                        echo '<div class="statusmsg">Welcome to your Account Homepage '.$fnameStr.' !</div>';

                    }   
                    else{
                        // No match -> invalid url or account has already been activated.
                        echo '<div class="statusmsg">Having troubles connecting to Database....</div>';
                    }
                }
                else{
                  echo '<div class="statusmsg">Invalid approach, You may not be correctly signed in.</div>';
                }
           ?>     
          <!--End PHP-->
          <br>
          <div class = "statusmsg"><!--Your account info is displayed here!--></div>
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="navGenPQRpageClicked()" role="button" Style="background-color: #0B0B61;" aria-label="pQRbtn">
              <span class="glyphicon glyphicon-qrcode" aria-hidden="true">
              </span> Generate PQR »</a>
            <br/>
            <hr/>
            <!--/////////Display Acct Info./////////////-->
            <div class="container-fluid" align="center" style = "background-color: white;">
              <h1 style = "font-size: 100%;">Displayed below is your current account info.</h1>
              <form id ="acctInfoForm" class="form-horizontal" role="form">
              <!--username-->  
              <div class = "form-group">
                  <label class="control-label col-sm-4" for="dispUsername">Username/AU email:</label>
                  <div class="col-sm-4" name="dispUsername" id="dispUsername">       
                      <?php echo $row['email']?>
                  </div>      
              </div>
              <!--f & l name-->
              <div class = "form-group">
                  <label class="control-label col-sm-4" for="dispName">Name:</label>
                  <div class="col-sm-4" name="dispName" id="dispName">     
                      <?php echo $fnameStr." ".$lnameStr ; ?>
                  </div>      
              </div>
              <!--Org-->  
              <div class = "form-group">
                  <label class="control-label col-sm-4" for="dispOrg">Organization:</label>
                  <div class="col-sm-4" name="dispOrg" id="dispOrg">       
                      <?php echo $row['usrOrganization']?>
                  </div>      
              </div>
              <!--Admin Privedges-->  
              <div class = "form-group">
                  <label class="control-label col-sm-4" for="dispAdmin">Admin Privledges:</label>
                  <div class="col-sm-4" name="dispAdmin" id="dispAdmin">       
                      <?php 
                        $adminstatus  = $row['adminstatus'];
                        if ($adminstatus == '1'){
                          echo '<div class="statusmsg">"Access Granted."</div>';
                        }
                        else{
                          echo '<div class="statusmsg">"Permissions Locked."</div>';
                        }
                      ?>
                  </div>      
              </div>
              </form>
            </div>
            <br/>
            <a class="btn btn-primary btn-lg" herf = "javascript:void(0);" onclick="navViewAcctActivityClicked()" aria-label="vwActiv" role="button" Style="background-color: #0B0B61;">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> View Account/Event Activity »</a>            
            <hr/>
            <p>To Change password, Edit account info, or request admin privledges.</p>
            <a class="btn btn-primary btn-lg" herf = "javascript:void(0);" onclick="navManageAccountClicked()" role="button" Style="background-color: #0B0B61;" aria-label="mngAcct">
              <span class="glyphicon glyphicon-wrench" aria-hidden="true">
              </span> Click Here »</a>
            <p>OR</p>
            <p>Log out and return you to the AUQr Homepage.</p> 
            <a href="javascript:void(0);" onclick="logoutClicked()"> log-Out »</a>
            </p>
        </div>
      </div>
      <!--JUMBOTRON END-->
    </div>
</div>
<!--/////////Page Content END////////////////////-->


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

</script>
</body>
</html>