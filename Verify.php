<?php
$access_token = 'xCdh5IflTKFJ9UZCisDTRg0itxVVQhObx8jub3RGM9gItBPdOVil+DYJznFtX3cJzOw8WvhP3rkRHrJuJmOU19dVIDhzzg35f9Q0abblFhDpDR405+7M2rFKAj+/1PW1irIeUkiCUIPkRndfcrqqywdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;