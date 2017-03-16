<?php
$access_token = 'tYO69OAFrf1t8TOcRLmVCjqdaMLx3fMXgm4YGlvANWE56EjBjolij67ND422KmII/IXz+YfqhRg9+0vfIHiMsgYsUeHy0H5O6mxOiKbXmXRc3QMfBN2a57IVy/kfJDpT2aWNRtTJ3qMrkQvHcAkb0wdB04t89/1O/w1cDnyilFU=';
// Get POST body content
public function actionCallback()
    {
        
        $json_string = file_get_contents('php://input');
        $jsonObj = json_decode($json_string); //รับ JSON มา decode เป็น StdObj
        $to = $jsonObj->{"result"}[0]->{"content"}->{"from"}; //หาผู้ส่ง
        $text = $jsonObj->{"result"}[0]->{"content"}->{"text"}; //หาข้อความที่โพสมา
        
        $text_ex = explode(':', $text); //เอาข้อความมาแยก : ได้เป็น Array
        
        if($text_ex[0] == "อยากรู้"){ //ถ้าข้อความคือ "อยากรู้" ให้ทำการดึงข้อมูลจาก Wikipedia หาจากไทยก่อน
            //https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=PHP
            $ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_URL, 'https://th.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles='.$text_ex[1]);
            $result1 = curl_exec($ch1);
            curl_close($ch1);
            
            $obj = json_decode($result1, true);
            
            foreach($obj['query']['pages'] as $key => $val){

                $result_text = $val['extract'];
            }
echo "OK";
