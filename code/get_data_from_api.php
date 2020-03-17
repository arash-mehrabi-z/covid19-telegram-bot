<?php
$worlds_data = file_get_contents('https://mq-covid-19-update.s3-ap-southeast-1.amazonaws.com/api/data/' . date('Y-m-d') . '.json');
$words_data_array = json_decode($worlds_data, true);
$ca = [] ; //store Canada's data here.
$tr = [] ; //store Turkey's data here.
$ir = [] ; //store Turkey's data here.

foreach($words_data_array['items'] as $data) {
	if($data['country_region'] == 'Canada') {
		$ca[] = $data;
	} elseif($data['country_region'] == 'Turkey') {
		$tr[] = $data;
	} elseif($data['country_region'] == 'Iran')  {
		$ir[] = $data;
	}
}

//Store data in files in my server
$json_data = json_encode($ca);
file_put_contents('/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/Canada.json', $json_data);

$json_data = json_encode($tr);
file_put_contents('/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/Turkey.json', $json_data);

$json_data = json_encode($ir);
file_put_contents('/home2/arashmeh/domains/arashmehrabi.ir/public_html/covid19_statistics_bot/data/Iran.json', $json_data);
?>