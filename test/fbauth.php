<?require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/facebook/facebook.php');

  $config2 = array(
    'appId' => '1421562351392582',
    'secret' => '5cb88c0cb6bd3da5132020b24b6a21e5',
  );
  $facebook2 = new Facebook($config2);
  $token = $facebook2->getAccessToken();
  echo $token;
 
  
  $config = array(
    'appId' => '1421562351392582',
    'secret' => '5cb88c0cb6bd3da5132020b24b6a21e5',

  );
  $facebook = new Facebook($config);
  $facebook->setAccessToken($token);
  $uid = $facebook->getUser(); 
  echo "<pre>";
  $user_profile = $facebook->api('/TrainingCenterLuxoft/likes');
  print_r($user_profile);
  echo "</pre>";
