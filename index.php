<?php
// make our connection
$connection = pg_connect("host=ec2-54-243-214-198.compute-1.amazonaws.com dbname=d8hsko3c4c4lhj user=fxujqiwvxjhugr password=7eb01f27f07a9bb76a450401c6322a5671325458ba787719ace0d7df498caf36");

// let me know if the connection fails
if (!$connection) {
    print("Connection Failed.");
    exit;
}

// declare my query and execute
$myresult = pg_exec($connection, "SELECT * FROM weather");

// process results
$myvalue = pg_result($myresult);

// print results
print("My Value: $myvalue<br />\n");
