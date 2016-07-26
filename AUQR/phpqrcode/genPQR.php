<?php 
    include('qrlib.php'); 
                             
    $param = trim($_POST['auEmail']); // remember to sanitize that - it is user input!
    //$param = stripslashes($param); 
    // we need to be sure our script does not output anything!!! 
    // otherwise it will break up PNG binary! 

    ob_start("callback"); 
                         
    // here DB request or some processing 
    $codeText = $param; 
                         
    // end of processing here 
    $debugLog = ob_get_contents(); 
    ob_end_clean(); 

    //write code into file, Error corection lecer is lowest, L (one form: L,M,Q,H)
    //each code square will be 4x4 pixels (4x zoom)
    //code will have 2 code squares white boundary around 

    //QRcode::png($codeText, 'myQR.png', 'L', 4, 2);
                         
    // outputs image directly into browser, as PNG stream 
    //$thisQR = 
    QRcode::png($codeText);

    //show benchmark
    //QRtools::timeBenchmark();

    //rebuild cache
    //QRtools::buildCache();

    //code generated in text mode - as a binary table
    //then displayed out as HTML using Unicode block building chars :)
    //$tab = $qr->encode('PHP QR Code :)');
    //echo $tab;//try to display
    //QRspec::debug($tab, true);
?>       