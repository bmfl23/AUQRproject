<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/main.css" type="text/css" media="screen">
    </head>
<body>
    <div>
        <p>This is the php page that should display QR</p>
        <tr><td>
<?php 
    
    include('qrlib.php'); 
         
    $param = trim($_GET['auEmail']); // remember to sanitize that - it is user input!
    // $param = stripslashes(param); 
    // we need to be sure ours script does not output anything!!! 
    // otherwise it will break up PNG binary! 

    ob_start("callback"); 
     
    // here DB request or some processing 
    $codeText = 'my try DEMO - '.$param; 
     
    // end of processing here 
    $debugLog = ob_get_contents(); 
    ob_end_clean(); 
     
    // outputs image directly into browser, as PNG stream 
    QRcode::png($codeText);
?>      
        </td></tr>
    </div>
</body>
</html>