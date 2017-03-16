<?php
    $connection = pg_connect ("host=ec2-54-235-181-120.compute-1.amazonaws.com dbname=dd9sbv2pl3npfu user=zeczwoatxgggff password=2c64a703a8847eeebc479d4a21119d2868fb77d2c637b39e209c4c8088883fee");
    if($connection) {
       echo 'connected';
    } else {
        echo 'there has been an error connecting';
    } 
?>
