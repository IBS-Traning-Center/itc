<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once('twitteroauth.php');
function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth('U4blwvPkyHJDchxO6Pf3rw', 'GVBOgLOegy4AtoupwoYmnlQ6HERGUpjKPVkPIpXiuSU', $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken("95655603-iC4gpo328hkaN2TjiE1s5omAE2OIFcIhdkys8ZR9a", "3PF8YxySAhSCvjKZjCoH6swpDiF87fjNbDtPba94RpbxA");
/*
$users = $connection->get("/followers/ids.json?cursor=-1&screen_name=TrainingLuxoft&count=500");
echo "<pre>";
$arUsers = (array)$users;
$t=0;
foreach ($arUsers["ids"] as $key=>$user) {
	if ($marker==0) {
		$arItem[$t]=$user;
	} else {
		$arItem[$t].=",".$user;
	}
	$marker++;
	if ($marker==100) {
		$marker=0;
		$t++;
	}
	
}
//$objuser = $connection->get("/users/show.json?user_id=".$user);

foreach ($arItem as $strusers) {
	$objuser = $connection->get("/users/lookup.json?user_id=".$strusers);
	$arUser=(array)$objuser;
	foreach ($arUser as $stduser) {
		$userItem=(array)$stduser;
		//print_r($userItem);
		$arNicks[]=$userItem["screen_name"];
	}
	
}
foreach ($arNicks as $usernick) {
	if (strlen($usernick)>0) {
		$filter = Array("UF_TWITTERNICK" => $usernick); 
		$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter); // выбираем пользователей 
		while ($arUser = $rsUsers->Fetch())  : 
			$siteuser[]=$arUser["ID"];
		endwhile;
	}
}
//print_r($siteuser);

foreach ($siteuser as $user) {
	if (!CheckUsersTrans("GROUP", "TWITTER", $user)) {
		if (CheckYearLimit($user)) {
			CreateTrans("GROUP", "TWITTER", $user);
		}
	}
}

echo "</pre>";
*/

$content = $connection->get("https://api.twitter.com/1.1/statuses/retweets_of_me.json?count=15");
echo "<pre>";
$alltwitts=(array)$content;
$rate_limit = $connection->get('/application/rate_limit_status');
print_r($rate_limit);
foreach ($alltwitts as $twit) {
	$twititem=(array)$twit;
	$postid=$twititem["id"];
	//print_r($twititem);
	if (intval($twititem["retweet_count"])>0 && $twititem["retweeted"]!="1") {
		//sleep(5);
		//print_r('/statuses/retweets/'.$twititem["id"].'.json');
		$retweets = $connection->get('/statuses/retweets.json?id='.$twititem["id"]);
		//print_r($twititem);
		$arRetweet=(array)$retweets;
		foreach ($arRetweet as $obtweet) {
			$arTweet=(array)$obtweet;
			print_r($arTweet);
			$user=(array)$arTweet["user"];
			$arNicks[]=$user["screen_name"];
		}
	};
	
}
$arMemberNick=array_unique($arNicks);
	foreach ($arMemberNick as $usernick) {
		if (strlen($usernick)>0) {
			$filter = Array("UF_TWITTERNICK" => $usernick); 
			$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter); // выбираем пользователей 
			while ($arUser = $rsUsers->Fetch())  : 
				$siteuser[]=$arUser["ID"];
			endwhile;
		}
	}
	print_r($siteuser);
	foreach ($siteuser as $user) {
		if (!CheckUsersTrans("REPOST", "TWITTER", $user, $postid)) {
			if (CheckYearLimit($user)) {
				CreateTrans("REPOST", "TWITTER", $user, $postid);
				}
			}
		}
	
print_r($arMemberNick);


//print_r($alltwitts);
echo "</pre>";