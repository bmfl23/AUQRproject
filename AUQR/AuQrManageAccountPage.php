<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->

<!--////////Manage Account Page//////////////-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AU Qr Manage Account</title>

  <base herf="http://auburn.edu/student_info/ifc/webapplication/AUQR/"/>

  <link href="css/auqrStyle.css" rel="stylesheet" type="text/css"/>

  <!--Bootstrap Scripts-->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!--////jQuery script links///////-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

  <!--////My Custom script links///////-->
  <script src="js/navDrawer.js"></script>

  <script type="text/javascript" src="js/checkPasswordMatches.js"></script>
  <script type="text/javascript" src="js/checkEmailisValid.js"></script>

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
  <!--/////////////////////////////////////////////////-->
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
    <!--////////////NAV DRAWER END////////////////////////-->

<!--////////PAGE CONTENT START//////////////-->
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
              <tr><td><img class="img-responsive" src="images/img_manageAcct.png"></td></tr>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
            </tbody>
          </table>
        <br>
        </div> 
      </header>

      <hr class="hrDivider" align="center"></hr>         

      <h1 style="margin-top:0; padding-top:50px;">Edit Account info.</h1>

      <!--JUMBOTRON-->
      <div class="jumbotron" id="GSjumbo">
        <div class="container-fluid" align="center">
          <h1 style = "font-size: 100%;">Please fill out the fields below to change information.</h1>
            <!--/////////Change Passsword Form /////////////-->
              <form id ="changePassswordForm" class="form-horizontal" role="form" action="changePassword.php" method="POST">
              <!--email-->
              <div class = "form-group">
                <?php
                  $auEmail = trim(mysql_escape_string($_GET['email'])); // Set email variable
                  $hash = trim(mysql_escape_string($_GET['hash'])); // Set hash variable
                ?>  
                  <label class="control-label col-sm-4" for="auEmail">Username/Email:</label>
                  <div class="col-sm-4">
                      <input name="auEmail" id="auEmail" class="form-control" type="email" value=<?php echo $auEmail ;?> readonly>
                      </input>
                  </div>    
              </div>
              <!--PWD-->
              <div class="form-group">
                  <label class="control-label col-sm-4" for="pwd1">New-Password:</label>
                  <div class="col-sm-4">
                      <input name="pwd1" id="pwd1" class="form-control" type="password" placeholder="Enter Password.">
                  </div>          
              </div>
              <div class="form-group">
                  <label class="control-label col-sm-4" for="pwd2">Confirm New-Password:</label>
                  <div class="col-sm-4">
                      <input name="pwd2" id="pwd2" class="form-control" type="password" placeholder="Comfirm Password." onkeyup="checkPass(); return false;">
                      <span id="confirmMessage" class="confirmMessage"></span>
                  </div>          
              </div>
               <div class="form-group">   
                  <button type="submit" id="createButton" class="btn btn-primary btn-lg" Style="background-color: #0B0B61;">Submit Password Change. »</button>
               </div>
               </form>    
            <!--//////////////////////////////////////END/////////////////////////////////////////////////////-->
            <hr/>
            <div class="container-fluid" id = "modOrgButton" name = "modOrgButton">
              <p>Modify organization HERE.</p>
              <form id ="modOrgButtonForm" class="form-horizontal" role="form" action="changeUsrOrganization.php" method="POST">
              <!--email-->
              <div class = "form-group" style="display: none;">
                  <label class="control-label col-sm-4" for="auEmail">Username/Email:</label>
                  <div class="col-sm-4">
                      <input name="auEmail" id="auEmail" class="form-control" type="email" value=<?php echo $auEmail ;?> readonly>
                      </input>
                  </div>    
              </div>
              <!--usrOrganization-->
              <div class = "form-group">
                  <label class="control-label col-sm-4" for="modUsrOrganization">Organization/Group:</label>
                  <div class="col-sm-4">
                      <input name="modUsrOrganization" id="modUsrOrganization" class="form-control" type="text" placeholder="Fraternity/Group.">
                      </input>
                  </div>    
              </div>
              <div class="form-group">   
                  <button type="submit" id="updateOrgButton" class="btn btn-primary btn-lg" Style="background-color: #0B0B61;">Update Organization »</button>
              </div>
              </form>
            </div>
            <hr>
            <!--/////////////////////////////////////////////////////////////////////////-->
            <div class="container-fluid" id = "authReqButton" name = "authReqButton">
              <p>Request Admin Authorization.</p>
              <form id ="authRequestForm" class="form-horizontal" role="form" action="requestAdminAuthorization.php" method="POST">
              <!--email-->
              <div class = "form-group" style="display: none;">
                  <label class="control-label col-sm-4" for="auEmail">Username/Email:</label>
                  <div class="col-sm-4">
                      <input name="auEmail" id="auEmail" class="form-control" type="email" value=<?php echo $auEmail ;?> readonly>
                      </input>
                  </div>    
              </div>
              <div class="form-group">   
                  <button type="submit" id="authUsrButton" class="btn btn-primary btn-lg" Style="background-color: #0B0B61;">Click Here to send request. »</button>
              </div>
              </form>   
            </div>
            <!--/////////////////////////////////////////////////////////////////////////-->
            <hr>   
            <p>
              OR
            <a href="javascript:void(0);" onclick="navAccountHomepageClicked()">Back to Account home »</a>
            </p>
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
</script>
</body>
</html>