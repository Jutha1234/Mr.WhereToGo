<?php
$access_token = '4gdS3iXEM8IA0PC1jOgVaktQlzVHh+K5zQ5w/GELmMKFndnldIp+4+ZuB1eiGTpD0FwMNBKcOdRs9ZOE/vF26UIkR13LTIe7ezuKRMTMvrNMtc8guFCdiCfZ4Nkycl6+XXAFeKp0Se/VCMHbZb6I1QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;