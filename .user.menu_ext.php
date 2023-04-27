<?
global $APPLICATION;
global $USER;
    	$aMenuLinksNew = Array();
    	
    if ($USER->IsAuthorized()) {	
    		
    	$aMenuLinksNew[] = array(
                $USER->GetFullName(),
                SITE_DIR.'personal_test/',
                array(),
                array());
       
        $aMenuLinksNew[] = array(
                "Выход",
                $APPLICATION->GetCurPageParam('logout=yes'),
                array(),
                array());
                
                
    }
                
    $aMenuLinks = array_merge($aMenuLinksNew, $aMenuLinks);

?>