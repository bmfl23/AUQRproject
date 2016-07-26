<!--
/*
 * IFC: Greek Life 
 * AUQR - Official Personal QR(PQR) System
 *
 * Date: 4/25/2016
 * @author Brandon Fernandez 
 */
-->
<!--/////////AUQR Account/Event Activity(ADMIN VIEW)/////////////-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>AU Qr Account/Event Activity (ADMIN VIEW)</title>

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
          <img class="drawerImg" src="images/AUicon.png"> QR Menu</img>
        </a>
      </div>
        <ul class="nav drawer-nav-list" align="center">
          <li>
            <a href="javascript:void(0);" onclick="navAccountHomepageClicked()" aria-label="home">
              <span class="glyphicon glyphicon-home" aria-hidden="true">
              </span>Account Home</a>
          </li>
          <hr/>
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
          <hr/>
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
    <br/><br/>
    <div class="container-fluid " align="center" style="max-width:980px;">
      <!--^^Align all center & sets max width^^-->    
      
      <header>
        <div class="container-fluid" id="AuQrbanner">
        <br/>
          <table>
            <tbody>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
              <tr><td><img class="img-responsive" src="images/img_userActivity.png"/></td></tr>
              <tr><td colspan="4" valign="top" class="ClassicSpacer"></td></tr>
            </tbody>
          </table>
        <br/>
        </div> 
      </header>

      <hr class="hrDivider" align="center"/>         

      <h1 style="margin-top:0; padding-top:50px;">(ADMIN) View ALL Account Activity Page.</h1>

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

                  // Verify data
                  $auEmail = trim(mysql_escape_string($_GET['email'])); // Set email variable
                  $hash = trim(mysql_escape_string($_GET['hash'])); // Set hash variable

                  //searching db to verify
                  $qry = mysql_query("SELECT * FROM auqr_usertable WHERE email='".$auEmail."' AND hash='".$hash."'AND active='1'") or die(mysql_error()); 
                  $match  = mysql_num_rows($qry);

                  $row = mysql_fetch_assoc($qry);
                  $hash2 = $row['hash'];

                    if($match > 0){
                        $fnameStr = $row['fname'];
                        echo '<div class="statusmsg">Welcome to the Account Activity Page '.$fnameStr.' !</div>';
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
           <!--////////////////////////////////////////////QRY BAR/////////////////////////////////////////////-->
          <br/><hr/><br/>
          <form class="form-inline" role="form" style="float: left;" action = "auqrQueryDB.php" method="POST">
              <div class="form-group">
                <label for="sel1">Search By: </label>
                <select class="form-control" id="sel1" name="sel1" onchange="changeFunc();">
                  <option name ='eventNameOp' id = 'eventNameOp' value ="Event Name">Event Name</option>
                  <option name ='scannerEmailOp' id = 'scannerEmailOp' value ="Scanner Email">Scanner's Email</option>
                  <option name ='attendeeEmailOp' id = 'attendeeEmailOp' value ="Attendee Email">Attendee's Email</option>
                </select>
              </div>

              <label for="selector2">Keyword: </label>
              <div class="form-group" id='selector2' name='selector2'>
                <!--Toggle display of these selectors-->
                <!--Event Names Selector-->
                <select class="form-control" id='eventSelector' name='eventSelector' style="display: block;">
                <?php
                  $enQry = "SELECT DISTINCT eventName FROM auqr_scannedevents ORDER BY eventName ASC";
                  $colNm1 = "eventName"; 
                  eventNameGetter($enQry,$colNm1);
         
                function eventNameGetter($enQry,$colNm1){
                  $selectorResult = mysql_query($enQry);
                  while ($subQry = mysql_fetch_assoc($selectorResult)) { ?>
                  <option><?php echo $subQry[$colNm1]; ?></option>
                  <?php }} ?> 
                </select>
                <!--Scanner Email Selector-->
                <select class="form-control" id='scannerSelector' name='scannerSelector'style="display: none;">
                <?php
                  $seQry = "SELECT DISTINCT senderEmail FROM auqr_scannedevents ORDER BY senderEmail ASC";
                  $colNm2 = "senderEmail"; 
                  scannerEmailGetter($seQry,$colNm2);
         
                function scannerEmailGetter($seQry,$colNm2){
                  $selectorResult = mysql_query($seQry);
                  while ($subQry = mysql_fetch_assoc($selectorResult)) { ?>
                  <option><?php echo $subQry[$colNm2]; ?></option>
                  <?php }} ?> 
                </select>
                <!--Attendee Email Selector-->
                <select class="form-control" id='attendeeSelector' name='attendeeSelector' style="display: none;">
                <?php
                  $aeQry = "SELECT DISTINCT userEmail FROM auqr_scannedevents ORDER BY userEmail ASC";
                  $colNm3 = "userEmail"; 
                  attendeeEmailGetter($aeQry,$colNm3);
         
                function attendeeEmailGetter($aeQry,$colNm3){
                  $selectorResult = mysql_query($aeQry);
                  while ($subQry = mysql_fetch_assoc($selectorResult)) { ?>
                  <option><?php echo $subQry[$colNm3]; ?></option>
                  <?php }} ?> 
                </select>
              </div>
              <div class="form-group" id='queryDBbtn' name='queryDBbtn'>
                <button type="submit" id="qryButton" class="btn btn-primary btn-lg" Style="background-color: #0B0B61;">Query DB. »</button>
              </div>  
          </form>
          <!--////////////////////////////////////////////QRY BAR/////////////////////////////////////////////-->
          <br/><hr/><br/>
          <div class= "auTable" style="float: center;">
                  <table>
                      <tr>
                          <td>Scanner's Email</td>
                          <td>Scanner's Organization</td>
                          <td>Atendee's Email</td>
                          <td>Event Name</td>
                          <td>Location</td>
                          <td>Time Stamp</td>
                      </tr>
                      <?php
                      /* query */

                      $eventQry = "SELECT * FROM auqr_scannedevents ORDER BY timeStamp DESC LIMIT 50";
                      $result = mysql_query($eventQry);
                      /* fetch result */

                      while ($row2 = mysql_fetch_assoc($result)) {
                      ?>
                          <tr>
                              <td><?php echo $row2['senderEmail']?></td>
                              <td><?php echo $row2['orgName']?></td>
                              <td><?php echo $row2['userEmail']?></td>
                              <td><?php echo $row2['eventName']?></td>
                              <td><?php echo $row2['location']?></td>
                              <td><?php echo $row2['timeStamp']?></td>
                          </tr>
                      <?php

                      }
                      ?>
              </table>
          </div>
          <br/>     
          <!--End PHP-->
          <div class = "statusmsg">The Latests entries of Account Activity are displayed Above!(0-50)</div>
            <hr/>
            <p>
              OR
            </p>
            <p> 
            <a href="javascript:void(0);" onclick="navAccountHomepageClicked()">Go Back to Account Homepage »</a>
            </p>
        </div>
      </div>
      <!--Jumbotron END-->
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
    /**/
    function changeFunc() {
      var selectedValue = sel1.options[sel1.selectedIndex].value;
      //if,else if, else : disp~
      if(selectedValue == "Scanner Email"){
        dispScannerSelector();
      }
      else if(selectedValue == "Attendee Email"){
        dispAttendeeSelector();
      }
      else{
        dispEventSelector();
      }
        
    }
    function dispEventSelector(){
      document.getElementById("eventSelector").style.display = "block";
      document.getElementById("scannerSelector").style.display = "none";
      document.getElementById("attendeeSelector").style.display = "none";
    }
    function dispScannerSelector(){
      document.getElementById("eventSelector").style.display = "none";
      document.getElementById("scannerSelector").style.display = "block";
      document.getElementById("attendeeSelector").style.display = "none";
    }
    function dispAttendeeSelector(){
      document.getElementById("eventSelector").style.display = "none";
      document.getElementById("scannerSelector").style.display = "none";
      document.getElementById("attendeeSelector").style.display = "block";
    }
</script>
</body>
</html>