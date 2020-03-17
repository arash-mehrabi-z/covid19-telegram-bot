<?php
    
    $bot_url = "https://api.telegram.org/bot1130417244:AAHy8oXMSKzLuwrWDjTrfFYmJQvIQUP1ys0";
    
    $update = file_get_contents("php://input");
    
    $update_array = json_decode($update, true);
    
    if( isset($update_array["message"]) ) {
        
        $text    = $update_array["message"]["text"];
        $chat_id = $update_array["message"]["chat"]["id"]; 
    }

    //-------------------------------------
	// CREATING MENU

    $key1 = 'Canada\'s Cases';
    $key2 = 'Turkey\'s Cases';
    $key3 = 'آمار ایران' ;
    $key4 = 'محافظت از خود در برابر کرونا ویروس';
    $key5 = 'About developer - درباره برنامه نویس';
 
    $reply_keyboard = [
                        [$key1 , $key2] ,
                        [$key3] ,
                        [$key4] ,
                        [$key5] ,
                      ];
 
    $reply_kb_options = [
                            'keyboard'          => $reply_keyboard ,
                            'resize_keyboard'   => true ,
                            'one_time_keyboard' => false ,
                        ];
    
    //-------------------------------------
	// When pressing menu buttons
	switch($text) {
 
        case "/start" : show_menu();  break;
 
        case $key1 : send_canada();  break;
        case $key2 : send_turkey();    break;
        case $key3 : send_iran();    break;
        case $key4 : send_video();    break;
        case $key5 : send_document(); break;
        case $key6 : send_sticker();  break;
        case $key7 : send_location(); break;
        case $key8 : send_contact();  break;
    }

	function show_menu() {
 
        $json_kb = json_encode($GLOBALS['reply_kb_options']);
        $reply = "لطفا یکی از گزینه های زیر را انتخاب کنید.";
		$reply .= "\n" . "Please select one of the follwing options." ;
        $url = $GLOBALS['bot_url'] . "/sendMessage";
        $post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply , 'reply_markup' => $json_kb ];
        send_reply($url, $post_params);
    }

	function send_turkey() {
        $string = file_get_contents("/home2/arashmeh/domains/arashmehrabi.ir/public_html/telegram-bot/data/Turkey.json");
		if ($string === false) {
			// deal with error...
		}

		$json_a = json_decode($string, true);
		if ($json_a === null) {
			// deal with error...
		}

        $reply = "*Turkey*";
		$reply .= "\nConfirmed: " . $json_a[0]["confirmed"];
		$reply .= "\nDeaths: " . $json_a[0]["deaths"];
		$reply .= "\nRecovered: " . $json_a[0]["recovered"];
        $url = $GLOBALS['bot_url'] . "/sendMessage";
        $post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply, 'parse_mode' => 'Markdown' ];
        send_reply($url, $post_params);
    }

	function send_canada() {
        $string = file_get_contents("/home2/arashmeh/domains/arashmehrabi.ir/public_html/telegram-bot/data/Canada.json");
		if ($string === false) {
			// deal with error...
		}

		$json_a = json_decode($string, true);
		if ($json_a === null) {
			// deal with error...
		}

        $reply = "*Canada*\n-------";
		foreach($json_a as $arr) {
			$reply .= "\nProvince: " . $arr["province_state"];
			$reply .= "\nConfirmed: " . $arr["confirmed"];
			$reply .= "\nDeaths: " . $arr["deaths"];
			$reply .= "\nRecovered: " . $arr["recovered"];
			$reply .= "\n-------\n"
		}
		$url = $GLOBALS['bot_url'] . "/sendMessage";
		$post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply, 'parse_mode' => 'Markdown' ];
		send_reply($url, $post_params);
    }
	//-------------------------------------
    
    function send_reply($url, $post_params) {
        
        $cu = curl_init();
        curl_setopt($cu, CURLOPT_URL, $url);
        curl_setopt($cu, CURLOPT_POSTFIELDS, $post_params);
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);  // get result
        $result = curl_exec($cu);
        curl_close($cu);
        return $result;
    }
    
    //-------------------------------------

?>