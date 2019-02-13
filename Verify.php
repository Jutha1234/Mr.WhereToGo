<?php
$access_token = 'g1dlaUgE5tp8HCxpUcDcIigBnPkU2wfOzKEbk6w3gJ4+xJ83EiR+F1zZg9g2NwVc0FwMNBKcOdRs9ZOE/vF26UIkR13LTIe7ezuKRMTMvrMOTvVIUGN3OPWL3acavh8stK+Uo+V6A2e4mwbVT4JkWwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;