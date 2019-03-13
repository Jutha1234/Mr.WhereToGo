<?php
$access_token = '4gdS3iXEM8IA0PC1jOgVaktQlzVHh+K5zQ5w/GELmMKFndnldIp+4+ZuB1eiGTpD0FwMNBKcOdRs9ZOE/vF26UIkR13LTIe7ezuKRMTMvrNMtc8guFCdiCfZ4Nkycl6+XXAFeKp0Se/VCMHbZb6I1QdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
$userId = '';
if(!file_exists("text.txt")){
   $myfile = fopen("text.txt", "w") or die("Unable to open file!");
   fwrite($myfile, 0);
   fclose($myfile);
}
$myfile = fopen("text.txt", "r") or die("Unable to open file!");
$shortup = (bool)fgets($myfile);
fclose($myfile);
#$shortup = (bool)$_COOKIE[$cookie_name];
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get User 
			if ($event['source']['type'] == 'user') {
				$userId = $event['source']['userId'];			
			}
			elseif ($event['source']['type'] == 'group') {
				$userId = $event['source']['groupId'];			
			}
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			$messages = GetReplyMessage($text,$userId);
				
				
			if (!is_null($messages) ) {

				// Make a POST Request to Messaging API to reply to sender

				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages' => $messages,
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
}


 

function GetReplyMessage($text,$myUserId) {
	$serviceUrl = 'http://vsmsdev.apps.thaibev.com/linebot/linebotWCF';
	$groupWhereToGo = array('ไปไหน','อยู่ไหน','อยู่ไหม');
	$groupWho = array('วสุต','นิน','เอิร์ธ','เอิท','โทนี่','เอ็กซ์','บะห์','อ้อ','ออย','วิท','เต้','น้อย','ดิว','หน่า');
	$groupWhen = array('วันนี้','พรุ่งนี้','เมื่อวาน');

	$haveWhereToGo = searchGroup($groupWhereToGo,$text);
	$who = searchGroup($groupWho,$text);
	$when = searchGroup($groupWhen,$text);

	
	if(stripos($text, "ปิดบอท") !== false){
		$myfile = fopen("text.txt", "w") or die("Unable to open file!");
		fwrite($myfile, 1);
		fclose($myfile);
	} else if(stripos($text, "เปิดบอท")!== false){
		$myfile = fopen("text.txt", "w") or die("Unable to open file!");
		fwrite($myfile, 0);
		fclose($myfile);
	}	
	   
	// Build message to reply back
	if (stripos($text, "สวัสดี") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => 'สวัสดีครับ'
		]];
	} 
	else if ($haveWhereToGo  != "" && $who  != "")
	{
		if($when == "")
			$when = "วันนี้";
		
		$messages = [[
			'type' => 'text',
			'text' => WhereToGo($who,$when)
		]];
	
	}
	else if ($haveWhereToGo  != "" && $who  == "" )
	{
		$messages = [[
			'type' => 'text',
			'text' => 'ใคร' . $haveWhereToGo 
		]];
	}
	else if (stripos($text, "staff"){
		$response = file_get_contents('http://103.70.5.65/~haaohcom/nsd_bot/php/showStaff.php?who=staff&when=were');
		 

		$messages = [[
			'type' => 'text',
			'text' => $response
		]];
	
	}
	else if (stripos($text, "ป้อม") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => '2019-03-01 08:00 - 18:00  ไปงาน Netka meetup ที่พัทยาจ้า '
		]];
	}else if (stripos($text, "วสุต") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => '2019-02-01 10:00 - 12:00  ไป CAT CSS บางรัก  '
		]];
	}else if (stripos($text, "นิน") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => '2019-02-01 10:00 - 12:00  นัดคุยงาน  Siam Piwat'
		]];
	}else if (stripos($text, "โทนี่") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => '2019-02-23 08:00 - 18:00  ลาพักร้อน   ไปดู  คอนเสริตร์  BNK ที่  ICON Siam !!!!! '
		]];
	}else if (stripos($text, "น้อยหน่า") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => '2019-03-11-2019-06-06 08:00 - 18:00  ลาคลอดจ้าไม่ไหวแล้ว '
		]];
	}else if (stripos($text, "เต้") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => '2019-03-01 08:00 - 18:00  ลาไปทำหมัน '
		]];
	}else if (stripos($text, "พี่เอิร์ธ") !== false) {
		$messages = [[
			'type' => 'text',
			'text' => '2019-02-28 - 18:00  ไปหาลูกค้า Interlink '
		]];
	}else if (stripos($text, "555") !== false) {		
		$messages = [[
			'type' => 'sticker',
			'packageId' => '1',
			'stickerId' => '100'
		]];
	}else if (stripos($text, "อิอิ") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'อิอิ ทำไม'
		]];
	} else if (stripos($text, "ฮาๆ") !== false) {		
		$messages = [[
			'type' => 'sticker',
			'packageId' => '1',
			'stickerId' => '100'
		]];
	}else if (stripos($text, "วันนี้ใครลาบ้าง") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'วันนี้ยังไม่มีใครลา'
		]];
	}else if (stripos($text, "ว่าไง") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'ไม่ว่าไงจ้า '
		]];
	} else if (stripos($text, "เล่นอะไรกัน") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'ไม่ได้เล่นจ้านี่คือการทดสอบระบบ'
		]];
	} else if (stripos($text, "ไปเล่นตรงนู๊น") !== false) {		
		$messages = [[
			'type' => 'sticker',
			'packageId' => '1',
			'stickerId' => '10'
		]];
	}  else if (stripos($text, "คุณคือใคร") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'ผมเป็นบอท '
		]];
	} else if (stripos($text, "ไง") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'ชิวๆ'
		]];
	} else if (stripos($text, "จน") !== false) {		
		$messages = [[//
			'type' => 'text',
			'text' => 'พรุ่งนี้รวยๆ'
		]];
	} else if (stripos($text, "รวย") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'เอามาแบ่งบ้าง'
		]];
	} else if (stripos($text, "ต่อ") !== false) {		
		$messages = [[
			'type' => 'text',
			'text' => 'ต่อไหน ใครรู้บ้าง'
		]];
	} else if (stripos($text, "ไบ้หวยหน่อย") !== false) {	
		$digits = 3;
                $randNumber = rand(pow(10, $digits-1), pow(10, $digits)-1);
		$messages = [[
			'type' => 'text',
			'text' => $randNumber
		]];
	} else if (stripos($text, "2 ตัว") !== false) {	
		$digits = 2;
                $randNumber = rand(pow(10, $digits-1), pow(10, $digits)-1);
		$messages = [[
			'type' => 'text',
			'text' => $randNumber
		]];				
	}else{
		$messages = [[
			'type' => 'text',
			'text' => 'ขอโทษครับ ผมไม่เข้าใจ'
		]];
	}
	
	/*if (stripos($text, "Cfx Myinfo") !== false) {	
		$messages = [[
			'type' => 'text',
			'text' => $myUserId
		]];
		
	} else if (stripos($text, "Cfx Acc") !== false) {	
		$messages = [[
			'type' => 'text',
			'text' => "ค่า server โอนมาที่ \n 718-258-018-4 \n กสิกร \n วิทยา จงอุดมพร"
		]];
		
	}else if (stripos($text, "Cfx x2") !== false) {	
		$messages = [[
				 "type"=> "template",
				  "altText"=> "this is a carousel template",
				  "template"=> [
				      "type"=> "carousel",
				      "columns"=> array(
					  [
					    "thumbnailImageUrl"=> "https://fathomless-anchorage-14853.herokuapp.com/x1.jpg",
					    "title"=> "this is menu",
					    "text"=> "description",
					    "actions"=> array(
						[
						    "type"=> "postback",
						    "label"=> "Buy",
						    "data"=> "action=buy&itemid=111"
						],
						[
						    "type"=> "postback",
						    "label"=> "Add to cart",
						    "data"=> "action=add&itemid=111"
						],
						[
						    "type"=> "uri",
						    "label"=> "View detail",
						    "uri"=> "https://fathomless-anchorage-14853.herokuapp.com/x1.jpg",
						]
					    )
					  ],
					  [
					    "thumbnailImageUrl"=> "https://fathomless-anchorage-14853.herokuapp.com/x2.jpg",
					    "title"=> "this is menu",
					    "text"=> "description",
					    "actions"=> array(
						[
						    "type"=> "postback",
						    "label"=> "Buy",
						    "data"=> "action=buy&itemid=222"
						],
						[
						    "type"=> "postback",
						    "label"=> "Add to cart",
						    "data"=> "action=add&itemid=222"
						],
						[
						    "type"=> "uri",
						    "label"=> "View detail",
						    "uri"=> "https://fathomless-anchorage-14853.herokuapp.com/x2.jpg",
						]
					    )
					  ]
				      )
				  ]

		]];
		
	} else if (stripos($text, "Cfx xy") !== false) {	
		$messages = [[
				  "type"=> "template",
				  "altText"=> "this is a buttons template",
				  "template"=> [
				      "type"=> "buttons",
				      "thumbnailImageUrl"=> "https://fathomless-anchorage-14853.herokuapp.com/YDSY4925.JPG",
				      "title"=> "Menu",
				      "text"=> "Please select",
				      "actions"=> array(
					  [
					    "type"=> "message",
					    "label"=> "Yes",
					    "text"=> "yes"
					  ],
					  [
					    "type"=> "message",
					    "label"=> "No",
					    "text"=> "no"
					  ],[
					    "type"=> "uri",
					    "label"=> "View detail",
					    "uri"=> "https://www.dropbox.com/sh/i7jfxjntjldsglo/AAAufjP0Q8jg5SHJl6yJZUv6a?dl=0"
					  ]
				      )
				  ]

		]];
		
	} else if (stripos($text, "Cfx ask") !== false) {
		$splitStr = explode('#',$text);
		if(count($splitStr) >= 4){
			$messages = [[
					  "type"=> "template",
					  "altText"=> $splitStr[1],
					  "template"=> [
					      "type"=> "confirm",
					      "text"=> $splitStr[1],
					      "actions"=> array(
						  [
						    "type"=> "message",
						    "label"=> $splitStr[2],
						    "text"=> $splitStr[2]
						  ],
						  [
						    "type"=> "message",
						    "label"=> $splitStr[3],
						    "text"=> $splitStr[3]
						  ]
					      )
					  ]

			]];
		} else {
			$messages = [[
			'type' => 'text',
			'text' => "ผมไม่เข้าใจ"
		]];
		}
		
	} else if (stripos($text, "Cfx saimai") !== false) {	
		$splitStr = explode('#',$text);
		if(count($splitStr) >= 2) {
			$userId = "C6614ebe54e49c320307197b657d07202";
			$messages = [[
				'type' => 'text',
				'text' => $splitStr[1]
			]];
		}
	} else if (stripos($text, "cfx Fac") !== false) {	
		$feedUrl = 'https://cdn-nfs.forexfactory.net/ff_calendar_thisweek.xml?v=1';
		$xml = simplexml_load_file($feedUrl);
		$txt = '';
		$myDate = '';
		$myOldDate = DateTime::createFromFormat('d-m-Y', '01-01-2017');
		#echo $xml->weeklyevents->event->title;
			foreach($xml->children() as $event)
			{	 
			  $myDate = (string)$event->date;
		          $myTime = (string)$event->time;
			  $strTime = $myDate . ' ' . $myTime;
			  $date =  DateTime::createFromFormat('d-m-Y H:ia', $strTime);			  
			  $date->modify('+7 hours');		
			  
			  if((string)$date->format('d-m-Y') != (string)$myOldDate->format('d-m-Y')){
				#echo $date->format('d-m-Y H:i:s');
				#$myDate = $date->format('d-m-Y');
				$txt .= (string)$date->format('d-m-Y') . "\n";
				$myOldDate = $date;
			   }
			   if($event->impact == 'High'){
				$txt .= ($event->country) . ' ' . (string)($date->format('H:ia')) . ' ' . ($event->title) . "\n";
			   }
			}
		           
		$messages = [[
			'type' => 'text',
			'text' => $txt
		]];
	}*/ 	
	return $messages;
}

function searchGroup($ArrGroup,$text){
	$have_word = "" ;
	foreach ($ArrGroup as $word) {
		if (stripos($text, $word) !== false) {
			 
			$have_word = $word;
		}
	}
	return $have_word ;
}
function WhereToGo($who,$when){

	$ch = curl_init('http://103.70.5.65/~haaohcom/nsd_bot/php/loadBot.php?who=' . $who . '&when=' . $when);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	return  $result;

//	$response = file_get_contents('http://103.70.5.65/~haaohcom/nsd_bot/php/loadBot.php?who=' . $who . '&when=' . $when);
//	return  $response;
}
echo "OK";
