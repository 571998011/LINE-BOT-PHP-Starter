<?php
$access_token = 'tYO69OAFrf1t8TOcRLmVCjqdaMLx3fMXgm4YGlvANWE56EjBjolij67ND422KmII/IXz+YfqhRg9+0vfIHiMsgYsUeHy0H5O6mxOiKbXmXRc3QMfBN2a57IVy/kfJDpT2aWNRtTJ3qMrkQvHcAkb0wdB04t89/1O/w1cDnyilFU=';
$servername = "ec2-54-235-181-120.compute-1.amazonaws.com";
$username = "zeczwoatxgggff";
$password = "2c64a703a8847eeebc479d4a21119d2868fb77d2c637b39e209c4c8088883fee";
$dbname = "dd9sbv2pl3npfu";
error_reporting(0);
$conn = pg_connect("host='ec2-54-235-181-120.compute-1.amazonaws.com' port='5432' dbname='dd9sbv2pl3npfu' user='zeczwoatxgggff' password='2c64a703a8847eeebc479d4a21119d2868fb77d2c637b39e209c4c8088883fee'");
// Check connection
$value = "";
$value1 = "";
$value2 = "";

$sql = "SELECT humidity_value FROM hardware_info ORDER BY datetime DESC LIMIT 1;";
$result = pg_query($conn, $sql);
$sql2 = "SELECT temp,weathers,pressure FROM server ORDER BY no DESC LIMIT 1;";
$result2 = pg_query($conn, $sql2);


$sql3 = "SELECT c2image FROM img_info ORDER BY number DESC LIMIT 1;";
$result3 = pg_query($conn, $sql3);
header("Content-type: image/jpg");
$row2 = pg_fetch_row($result3);
echo pg_unescape_bytea($row2[0]);
$value2 = $row2[0];

if (pg_num_rows($result) >= 0) {
    // output data of each row
    while($row = pg_fetch_row($result)) {
        echo $row[0];
	    $value = "ความชื้นในดิน: ".$row[0]." %"."\n";
    }
	while($row1 = pg_fetch_row($result2)) {
        echo $row1[0];
	    $value1 = "อุณหภูมิ: ".$row1[0]." C"."\n"."สภาพอากาศ: ".$row1[1]."\n"."ความกดอากาศ: ".$row1[2]." pha";
    }
	
} else {
    echo "0 results";
}

pg_close($conn);

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			if($text=="Weather"){
				$messages = [
					'type' =>'text',
					'text' => $value.$value1,
				];}else if($text=="Photo" ){
					$messages = [
						'type' => 'image',
						'originalContentUrl'=> 'https://dry-woodland-30767.herokuapp.com/index.php',
						'previewImageUrl'=> 'https://dry-woodland-30767.herokuapp.com/index.php'
					];
				}
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>
