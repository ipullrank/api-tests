<pre>

<?php 

include_once "restclient.php";

$api = new RestClient(array(
    'base_url' => "http://urls.api.twitter.com/1/urls", 
    'format' => "json"
));
$result = $api->get("count", array("v" => "1.0", "url" =>"http://www.marketingfestival.cz"));

//print_r($result);
if($result->info->http_code == 200)
{
    $twitterResponse = $result->decode_response();
	echo 'tweet count is ' .$twitterResponse->count;
	print_r($twitterResponse);
}