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
$response_format_text = ['contentType'=>1,"toType"=>1,"text"=>$result_text];
if($text == 'บอกมา'){//คำอื่นๆ ที่ต้องการให้ Bot ตอบกลับเมื่อโพสคำนี้มา เช่นโพสว่า บอกมา ให้ตอบว่า ความลับนะ
            $response_format_text = ['contentType'=>1,"toType"=>1,"text"=>"ความลับนะ"];
        }else{//นอกนั้นให้โพส สวัสดี
            $response_format_text = ['contentType'=>1,"toType"=>1,"text"=>"สวัสดี"];
        }
echo "OK";
