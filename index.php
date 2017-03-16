<?php
$servername = "ec2-54-235-181-120.compute-1.amazonaws.com";
$username = "zeczwoatxgggff";
$password = "2c64a703a8847eeebc479d4a21119d2868fb77d2c637b39e209c4c8088883fee";
$dbname = "dd9sbv2pl3npfu";
error_reporting(0);
$conn = pg_connect("host='ec2-54-235-181-120.compute-1.amazonaws.com' port='5432' dbname='dd9sbv2pl3npfu' user='zeczwoatxgggff' password='2c64a703a8847eeebc479d4a21119d2868fb77d2c637b39e209c4c8088883fee'");
// Check connection


$sql = " select * from hardware_info";
$result = pg_query($conn, $sql);

if (pg_num_rows($result) >= 0) {
    // output data of each row
    while($row = pg_fetch_row($result)) {
        echo $row[0];
    }
} else {
    echo "0 results";
}

pg_close($conn);
?>
