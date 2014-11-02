<?php 

include_once "restclient.php";
include_once "csv-handlers.php";

$csv = csv_to_array("urls.csv");

$countOfCsvLines = count($csv);

$api = new RestClient(array(
    'base_url' => "http://urls.api.twitter.com/1/urls", 
    'format' => "json"
));

echo '<Table><tr><td>URL</td><td>Tweet Count</td></tr>';


for($x=0;$x<$countOfCsvLines;$x++)
{
	echo '<tr>';
	$result = $api->get("count", array("v" => "1.0", "url" =>$csv[$x]['urls']));
	echo '<td>'.$csv[$x]['urls'].'</td>';
	
	if($result->info->http_code == 200)
	{
	    $twitterResponse = $result->decode_response();
		$socialShares[$x]['urls'] = $csv[$x]['urls'];		
		$socialShares[$x]['tweetCount'] = $twitterResponse->count;
		
	}
	else{
		$socialShares[$x]['tweetCount'] = 'unknown';
	}
	echo '<td>'.$socialShares[$x]['tweetCount'].'</td>';

	echo '</tr>';
		
}
echo '</Table>';
makeCSV($socialShares,"shares.csv");
echo '<a href="shares.csv">Shares.csv</a>';
