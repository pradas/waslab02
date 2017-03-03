<?php 
//Task 6
require_once("DbHandler.php");

setlocale(LC_TIME,"en_US");

$dbhandler = new DbHandler();

$tweets = $dbhandler->getTweets();

$resp = new SimpleXMLElement("<rss></rss>");
$resp->addAttribute('version', '2.0');
$channel = $resp->addChild('channel');
$channel->addChild('title', 'Wall of Tweets 2 - RSS Version');
$channel->addChild('link', 'http://localhost:8080/waslab02/rss.php');
$channel->addChild('description', 'RSS 2.0 feed that retrieves the tweets posted to the web app "Wall of Tweets 2"');
$channel->addChild('language', 'en-us');

foreach($tweets as $tweet) {
	$item = $channel->addChild('item');
	$item->addChild('title', $tweet['text']);
	$item->addChild('link', 'http://localhost:8080/waslab02/wall.php#item_'.$tweet['id']);
	$item->addChild('description', 'This is WoT tweet #'.$tweet['id'].' posted by <b><i>'.$tweet['author'].'</i></b>. It has been liked by <b>'.$tweet['likes'].'</b> people');
	$item->addChild('pubDate', date('r', $tweet['time']));
}

header('Content-type: text/xml');
echo $resp->asXML();