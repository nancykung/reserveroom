<?php
	
	header ('Content-type: text/html; charset=utf-8');

        $keyword = "";

        if(isset($_POST['keyword']))
        {
                $keyword = $_POST['keyword'];
        }else{
                $keyword = "";
        }

	$curl = curl_init();

	$url = "";
	$url = "https://cloud-3001.lib.cmu.ac.th/exam/slot";

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => array(
	    'Authorization: Bearer A8GS'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	echo $response;
?>