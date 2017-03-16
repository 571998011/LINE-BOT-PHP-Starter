<?php
$access_token = 'tYO69OAFrf1t8TOcRLmVCjqdaMLx3fMXgm4YGlvANWE56EjBjolij67ND422KmII/IXz+YfqhRg9+0vfIHiMsgYsUeHy0H5O6mxOiKbXmXRc3QMfBN2a57IVy/kfJDpT2aWNRtTJ3qMrkQvHcAkb0wdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$json_string = file_get_contents('php://input');
// Parse JSON
$jsonObj = json_decode($json_string);
$to = $jsonObj->{"result"}[0]->{"content"}->{"from"};
$text = $jsonObj->{"result"}[0]->{"content"}->{"text"};
$text_ex = explode(':', $text);
// Validate parsed JSON data
if($text_ex[0] == "อยากรู้"){
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_URL, 'http://api.wunderground.com/api/Your_Key/conditions/q/CA/San_Francisco.json'.$text_ex[1]);
    $result1 = curl_exec($ch1);
    curl_close($ch1);
    
    $obj = json_decode($result1, true);
    
    foreach($obj['query']['pages'] as $key => $val){
        
        $result_text = $val['extract'];
    }
    echo "OK";
