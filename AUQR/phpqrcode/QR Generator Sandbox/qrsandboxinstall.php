<?php

//include only that one, rest required files will be included from it
include "qrlib.php"

//write code into file, Error corection lecer is lowest, L (one form: L,M,Q,H)
//each code square will be 4x4 pixels (4x zoom)
//code will have 2 code squares white boundary around 

QRcode::png('PHP QR Code :)', 'test.png', 'L', 4, 2);

//same as above but outputs file directly into browser (with appr. header etc.)
//all other settings are default
//WARNING! it should be FIRST and ONLY output generated by script, otherwise
//rest of output will land inside PNG binary, breaking it for sure
QRcode::png('PHP QR Code :)');

//show benchmark
QRtools::timeBenchmark();

//rebuild cache
QRtools::buildCache();

//code generated in text mode - as a binary table
//then displayed out as HTML using Unicode block building chars :)
$tab = $qr->encode('PHP QR Code :)');
QRspec::debug($tab, true);
