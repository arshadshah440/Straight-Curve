<?php /* Template Name: Debug Template */ ?>

<?php
	// $run_call = true;
	// $page = 1;
	// $pages_data = array();

	// while ($run_call) {
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 		CURLOPT_URL => 'https://api.cin7.com/api/v1/Stock?fields=branchName,branchId,available,code&page=' . $page . '&rows=250',
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => '',
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 0,
	// 		CURLOPT_FOLLOWLOCATION => true,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => 'GET',
	// 		CURLOPT_HTTPHEADER => array(
	// 			'Authorization: Basic U3RyYWlnaHRjdXJ2ZUdhckFVOjBkM2Y4ODFiYTc3ODQwYmRiMTcyZWY2YTA3N2Q5Y2Vh'
	// 		),
	// 	));

	// 	$response = curl_exec($curl);
	// 	curl_close($curl);
	// 	echo "<pre>";
	// 	print_r($response);
	// 	echo "</pre>";

	// 	$response = json_decode($response);
	// 	$pages_data[] = $response;
	// 	if (!$response || count($response) < 250) {
	// 		$run_call = false;
	// 	}
	// 	$page++;
	// 	sleep(1);
	// }

	// $data = array_merge(...$pages_data);

	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";
	// return $data;
?>