<?php 
// Twitter API anahtarları
$consumerKey = 'A39v0ln4E1Labg8bzJF2qQXAV';
$consumerSecret = '5LtrcFeWe8imCfqYO7pYmAq26eZnEBhCZ3jdeiZ0FGgsyCs8xH';
$accessToken = '1274090207718117377-kJ9xx8RHpPm8V3YgJAQ64W3johZzyj';
$accessTokenSecret = 'UV7sxBFBdCSRh5QzZnH1hK0R7zt3TSBs5nTtexE0wURTz';


// Tweet ID'si
$tweetId = isset($_POST['tweet_id']) ? $_POST['tweet_id'] : '';

if (!empty($tweetId)) {
    // Kütüphaneleri yükle
    require_once('TwitterAPIExchange.php');

    // API isteği için parametreleri ayarla
    $url = 'https://api.twitter.com/1.1/statuses/show.json';
    $getfield = '?id=' . $tweetId;
    $requestMethod = 'GET';

    // API isteği gönder
    $twitter = new TwitterAPIExchange(array(
        'oauth_access_token' => $accessToken,
        'oauth_access_token_secret' => $accessTokenSecret,
        'consumer_key' => $consumerKey,
        'consumer_secret' => $consumerSecret
    ));

    $response = $twitter->setGetfield($getfield)
                      ->buildOauth($url, $requestMethod)
                      ->performRequest();

    // Yanıtı işle
    $tweetData = json_decode($response, true);

    // Tüm verileri yazdır
    echo '<pre>';
    print_r($tweetData);
    echo '</pre>';
}
?>

<!-- HTML Formu -->
<form method="POST">
    Tweet ID'si: <input type="text" name="tweet_id"><br>
    <input type="submit" value="Tweet Verilerini Çek">
</form>
