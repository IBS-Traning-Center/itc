<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?/*<a href='http://oauth.vk.com/authorize?client_id=4163203&scope=groups,wall,offline&redirect_uri=https://ibs-training.ru/test/vkauth.php&response_type=code'>GO</a>
<?if (strlen($_REQUEST["code"])>0) {?>
<?$file=file_get_contents("https://oauth.vk.com/access_token?client_id=4163203&client_secret=jVJ4N0LS52gpzAdBTYNu&code=".$_REQUEST["code"]."&redirect_uri=https://ibs-training.ru/test/vkauth.php")?>
<?echo $file;?>
<?}*/?>
<?/*95350baca5a9ac72f40fed5bbf267bc57a749b58fa6516ce989b196625be27e6676de5819de54c9153faf*/?>
<?/*4308454*/?>
<?/*GROUP_ID=26072950*/?>
<?
$file=file_get_contents('https://api.vk.com/method/groups.getMembers.xml?group_id=26072950&v=5.8&access_token=95350baca5a9ac72f40fed5bbf267bc57a749b58fa6516ce989b196625be27e6676de5819de54c9153faf');
$group_users=simplexml_load_string($file);
foreach ($group_users->users->uid as $userid) {
	$arMember[]=(string)$userid;
}
$file2=file_get_contents('https://api.vk.com/method/users.get.xml?uids='.implode(",",$arMember).'&fields=nickname,screen_name');
$userinfo=simplexml_load_string($file2);
foreach ($userinfo->user as $userinfo) {
	
	$nick=(string)$userinfo->screen_name;
	if (strlen($nick)==0) {

	} else {
		$arMemberNick[]=$nick;
	}
}
foreach ($arMemberNick as $usernick) {
	$filter = Array("UF_VKNICK" => $usernick); 
	$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter); // выбираем пользователей 
	while ($arUser = $rsUsers->Fetch())  : 
		$siteuser[]=$arUser["ID"];
	endwhile;
}
foreach ($siteuser as $user) {
	if (!CheckUsersTrans("GROUP", "VK", $user)) {
		if (CheckYearLimit($user)) {
			CreateTrans("GROUP", "VK", $user);
		}
	}
}
?>


<?$file=file_get_contents('https://api.vk.com/method/wall.get.xml?count=100&owner_id=-26072950');
$wall=simplexml_load_string($file);
echo "<pre>";
foreach ($wall->post as $post) {
	$count=(string)$post->reposts->count;
	//print_r($post);
	if ($count>0) {
		$postid=(string)$post->id;
		$filenew=file_get_contents('https://api.vk.com/method/wall.getReposts.xml?post_id='.$postid.'&owner_id=-26072950');
		$repost=simplexml_load_string($filenew);
		$arResposted=array();
		$arMemberNick=array();
		$siteuser=array();
		foreach ($repost->items as $obItem) {
			$t=0;
			foreach ($obItem->post as $post) {
				$arResposted[]=(string)$post->to_id;
				$t=1;
			}
			if ($t=0) {
				$arResposted[]=(string)$obItem->post->to_id;
			}
			//print_r($obItem->post->to_id);
			
			$file2=file_get_contents('https://api.vk.com/method/users.get.xml?uids='.implode(",",$arResposted).'&fields=nickname,screen_name');
			$userinfo=simplexml_load_string($file2);

			foreach ($userinfo->user as $userinfo) {
				$nick=(string)$userinfo->screen_name;
				if (strlen($nick)==0) {
				
					} else {
				$arMemberNick[]=$nick;
				}
			}
			//print_r($arMemberNick);
			foreach ($arMemberNick as $usernick) {
				$filter = Array("UF_VKNICK" => $usernick); 
				$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter); // выбираем пользователей 
				while ($arUser = $rsUsers->Fetch())  : 
					$siteuser[]=$arUser["ID"];
				endwhile;
			}
			foreach ($siteuser as $user) {
				
				if (!CheckUsersTrans("REPOST", "VK", $user, $postid)) {
					if (CheckYearLimit($user)) {
						CreateTrans("REPOST", "VK", $user, $postid);
					}
				}
			}
		
		}
	}
}
echo "</pre>";


?>