<?php

$keyword = "";
$bookdate = "";
$url = "";

if(isset($_GET['keyword']))
{
    $keyword = $_GET['keyword'];
}else{
    $keyword = "";
}

if(isset($_GET['bookdate']))
{
    $bookdate = $_GET['bookdate'];
}else{
    $bookdate = "";
}

$url = 'https://cloud-3001.lib.cmu.ac.th/exam/reserve/'.$keyword.'/'.$bookdate;
//https://cloud-3001.lib.cmu.ac.th/exam/reserve/1/2022-04-20
//echo $url;

$curl = curl_init();

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