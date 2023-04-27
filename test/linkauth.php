<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// Change these
define('API_KEY',      '75y6j92w5gyjf6'                                          );
define('API_SECRET',   'k7wBtXNO7MWBOA0Q'                                       );
define('REDIRECT_URI', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);
define('SCOPE',        ''                        );
// You'll probably use a database
session_name('linkedin');
session_start();
 
// OAuth 2 Control Flow
if (isset($_GET['error'])) {
    // LinkedIn returned an error
    print $_GET['error'] . ': ' . $_GET['error_description'];
    exit;
} elseif (isset($_GET['code'])) {
    // User authorized your application
    if ($_SESSION['state'] == $_GET['state']) {
        // Get token so you can make API calls
        getAccessToken();
    } else {
        // CSRF attack? Or did you mix up your states?
        exit;
    }
} else { 
    if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
        // Token has expired, clear the state
        $_SESSION = array();
    }
    if (empty($_SESSION['access_token'])) {
        // Start authorization process
        getAuthorizationCode();
    }
}
 
// Congratulations! You have a valid token. Now fetch your profile 
$user = fetch('GET', '/v1/groups/3880622/posts:(id,creation-timestamp,title,summary,creator:(first-name,last-name,picture-url,headline),likes:(person:(site-standard-profile-request)),attachment:(image-url,content-domain,content-url,title,summary),relation-to-viewer)');

//$user = fetch('GET', '/v1/people/~/group-memberships:(group:(id,name),membership-state,show-group-logo-in-profile,allow-messages-from-members,email-digest-frequency,email-announcements-from-managers,email-for-every-new-post)');
$array=(array)$user;
echo "<pre>";
foreach ($array["values"] as $stdpost) {
	$arPost=(array)$stdpost;
	//print_r($arPost[id]);
	$arlike=(array)$arPost["likes"];
	if (intval($arlike["_total"])>0) {
		foreach ($arlike["values"] as $stdLike) {
			$arLike=(array)$stdLike;
			$arPerson=(array)$arLike["person"];
			if ($arPerson["firstName"]!='private') {
				$arPerson["siteStandardProfileRequest"];
				$url=(array)$arPerson["siteStandardProfileRequest"];
				//echo $url["url"];
				$parts = parse_url($url["url"]);
				
				parse_str($parts['query'], $query);
				$userID=$query["id"];
				print_r($arPost['id']."-".$userID."<br/>");
				$filter = Array("UF_LINKEDIN_ID" => $userID); 
				$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter); // выбираем пользователей 
				while ($arUser = $rsUsers->Fetch())  : 
					$siteuser[]=$arUser["ID"];
					if (intval($arUser["ID"])>0) {
						if (!CheckUsersTrans("REPOST", "LINKEDIN", $arUser["ID"], $arPost['id'])) {
							if (CheckYearLimit($arUser["ID"])) {
								CreateTrans("REPOST", "LINKEDIN", $arUser["ID"], $arPost['id']);
							}
						}
					}
				endwhile;
				
			}
			
		}
	}
}


//print_r($user);
echo "</pre>";
exit;
 
function getAuthorizationCode() {
    $params = array('response_type' => 'code',
                    'client_id' => API_KEY,
                    'scope' => SCOPE,
                    'state' => uniqid('', true), // unique long string
                    'redirect_uri' => REDIRECT_URI,
              );
 
    // Authentication request
    $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
     
    // Needed to identify request when it returns to us
    $_SESSION['state'] = $params['state'];
 
    // Redirect user to authenticate
    header("Location: $url");
    exit;
}
     
function getAccessToken() {
    $params = array('grant_type' => 'authorization_code',
                    'client_id' => API_KEY,
                    'client_secret' => API_SECRET,
                    'code' => $_GET['code'],
                    'redirect_uri' => REDIRECT_URI,
              );
     
    // Access Token request
    $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
     
    // Tell streams to make a POST request
    $context = stream_context_create(
                    array('http' => 
                        array('method' => 'POST',
                        )
                    )
                );
 
    // Retrieve access token information
    $response = file_get_contents($url, false, $context);
 
    // Native PHP object, please
    $token = json_decode($response);
 
    // Store access token and expiration time
    $_SESSION['access_token'] = $token->access_token; // guard this! 
    $_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
    $_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time
     
    return true;
}
 
function fetch($method, $resource, $body = '') {
    $params = array('oauth2_access_token' => $_SESSION['access_token'],
                    'format' => 'json',
					'count'=> 50,
					'order'=> 'popularity'
              );
     
    // Need to use HTTPS
    $url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
    // Tell streams to make a (GET, POST, PUT, or DELETE) request
    $context = stream_context_create(
                    array('http' => 
                        array('method' => $method,
                        )
                    )
                );
 
 
    // Hocus Pocus
    $response = file_get_contents($url, false, $context);
 
    // Native PHP object, please
    return json_decode($response);
}