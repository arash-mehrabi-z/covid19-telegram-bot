<?php
    
	$bot_url = "https://api.telegram.org/bot1130417244:AAHy8oXMSKzLuwrWDjTrfFYmJQvIQUP1ys0";
    
    $update = file_get_contents("php://input");
    
    $update_array = json_decode($update, true);
    
    if( isset($update_array["message"]) ) {
        
        $text    = $update_array["message"]["text"];
        $chat_id = $update_array["message"]["chat"]["id"]; 
    }

	// $reply = "پیام شما: ". $GLOBALS['text'];
    // $url = "https://api.telegram.org/bot" . "1130417244:AAHy8oXMSKzLuwrWDjTrfFYmJQvIQUP1ys0" . "/sendMessage";
    // $post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply ];
    // send_reply($url, $post_params);

	// $url = $GLOBALS['bot_url'] . "/deleteMessage";
    // $post_params = [ 'chat_id' => $GLOBALS['chat_id'] , 'message_id' => $msg_id ];
    // send_reply($url, $post_params);

    //-------------------------------------
	// CREATING MENU

    $key1 = 'Canada cases 🇨🇦';
    $key2 = 'Turkey cases 🇹🇷';
    $key3 = '🇮🇷 آمار ایران' ;
    $key4 = 'محافظت از خود در برابر ویروس کرونا جدید';
    $key5 = 'ارتباط با توسعه دهنده - Contact developer';
 
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
        case $key4 : send_protection();    break;
        case $key5 : send_developer_info(); break;

    }

	function show_menu() {
 
        $json_kb = json_encode($GLOBALS['reply_kb_options']);
        $reply = " دنبال کردن آمار تعداد مبتلایان به ویروس کرونا احتمالا فقط باعث نگرانی شما خواهد شد بنابراین توصیه میکنم که از دنبال کردن آمار بپرهیزید";
		$reply .= " ولی توصیه های بهداشتی از مراجع رسمی سلامت را دنبال کنید و به آنها عمل کنید. " ;
		$reply .= "در قسمت محافظت از خود در برابر ویروس کرونا جدید می توانید نمونه ای از مراجع رسمی حوزه سلامت را پیدا کنید. ";
		$reply .= "لطفا یکی از گزینه های زیر را انتخاب کنید." ;
		$reply .= "\n" . "Please select one of the follwing options." ;
        $url = $GLOBALS['bot_url'] . "/sendMessage";
        $post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply , 'reply_markup' => $json_kb ];
        send_reply($url, $post_params);
    }

	function send_turkey() {
		$string = file_get_contents("/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/Turkey.json");
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
        $post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply];
        send_reply($url, $post_params);
	}

	function send_iran() {
		$string = file_get_contents("/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/Iran.json");
		if ($string === false) {
			// deal with error...
		}

		$json_a = json_decode($string, true);
		if ($json_a === null) {
			// deal with error...
		}

        $reply = "*ایران*";
		$reply .= "\nمبتلایان: " . $json_a[0]["confirmed"];
		$reply .= "\nمرگ: " . $json_a[0]["deaths"];
		$reply .= "\nبهبودیافتگان: " . $json_a[0]["recovered"];
        $url = $GLOBALS['bot_url'] . "/sendMessage";
        $post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply];
        send_reply($url, $post_params);
	}

	function send_canada() {
		$string = file_get_contents("/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/Canada.json");
		if ($string === false) {
			// deal with error...
		}

		$json_a = json_decode($string, true);
		if ($json_a === null) {
			// deal with error...
		}

        $reply = "*Canada*";
		
		$reply .= "\nConfirmed: " . $json_a[0]["confirmed"];
		$reply .= "\nDeaths: " . $json_a[0]["deaths"];
		$reply .= "\nRecovered: " . $json_a[0]["recovered"];
		$url = $GLOBALS['bot_url'] . "/sendMessage";
		$post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply];
		send_reply($url, $post_params);
	}

	function send_protection() {

		$reply = "حدود یک ماه از شیوع ویروس کرونای کووید ۱۹ در کشورمان می‌گذرد اما این ویروس هنوز برای خیلی از مردم ناشناخته است و آنها نمی‌دانند چطور باید از خودشان در مقابل آن محافظت کنند تا مبتلا نشوند.

	به گزارش [همشهری آنلاین](www.hamshahrionline.ir/photo/490963/)، خیلی از مردم نمی دانند که این ویروس روی سطوح مختلف تا چند ساعت زنده می ماند، چگونه از روی لباس ها پاک می شود و چطور باید از شر آن خلاص شوند؟

	اینفوگرافیگ زیر به شما نکات بسیار مهم و کاربردی درباره چگونگی حفظ سلامت خود و خانواده تان در برابر این ویروس و نیز راه های از بین بردن آن آموزش می دهد. اطلاعات این اینفوگرافیک مورد تایید سازمان جهانی بهداشت (WHO) است.";


		$url = $GLOBALS['bot_url'] . "/sendMessage";
		$post_params = [ 'chat_id' =>  $GLOBALS['chat_id'] , 'text' => $reply, 'parse_mode' => 'Markdown'];
		send_reply($url, $post_params);

		for($i=0; $i < 9; $i++) {
			$url = $GLOBALS['bot_url'] . "/sendPhoto";
			$post_params = [ 
								'chat_id' => $GLOBALS['chat_id'] , 
								'photo'   => new CURLFILE(realpath('/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/training/'. $i .'.jpg')) ,  
								'caption' => "$i" ,  // optional
							];
			send_reply($url, $post_params);
		}
		// ارسال داکیومنت - فایل
		$url = $GLOBALS['bot_url'] . "/sendDocument";
		$post_params = [ 
							'chat_id'  => $GLOBALS['chat_id'] , 
							'document' => new CURLFILE(realpath("/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/training/دستورالعمل عمومی پیشگیری از ابتلا به ویروس کوئید ۱۹.pdf")) ,  
							'caption'  => "دستورالعمل عمومی پیشگیری از ابتلا به ویروس کوئید ۱۹\nنویسنده: جانگ ون هونگ، استاد تمام دانشگاه فو دن شانگ های چین\nترجمه شده در مرکز بررسی های استراتژیک ریاست جمهوری" ,  // optional
						];
		send_reply($url, $post_params);

		$reply = "اطلاعات بیشتر:" ;
		$reply .= "\n[مرکز آموزش کرونا - معاونت آموزشی سازمان نظام پزشکی جمهوری اسلامی ایران](https://corona.ir/)" ;
		$reply .= "\n\n[اینستاگرام دکتر نیک](https://www.instagram.com/drnik.official/)" ;

		$url = $GLOBALS['bot_url'] . "/sendMessage";
		$post_params = [ 'chat_id' => $GLOBALS['chat_id'] , 'text' => $reply , 'parse_mode' => 'Markdown' ];
		send_reply($url, $post_params);

	
	}

	function send_developer_info() {
		$reply = "@arash_mehrabi_zkz" ;

		$url = $GLOBALS['bot_url'] . "/sendMessage";
		$post_params = [ 'chat_id' => $GLOBALS['chat_id'] , 'text' => $reply ];
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

