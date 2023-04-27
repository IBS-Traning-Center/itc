<?php
declare(strict_types=1);

//define('C_REST_WEB_HOOK_URL', 'http://web_server_crm/rest/1/7r0gwl9yhbzkxnh8/');
define('C_REST_WEB_HOOK_URL', 'https://crm.ibs-training.ru/rest/1/7r0gwl9yhbzkxnh8/');
define('C_REST_IGNORE_SSL',true);//turn off validate ssl by curl
define('PROPERTY_CRM_ID', 'CRM_DEV_ID');
//define('C_REST_LOG_TYPE_DUMP',true); //logs save var_export for viewing convenience
//define('C_REST_BLOCK_LOG',true);//turn off default logs
//define('C_REST_LOGS_DIR', __DIR__ .'/logs/'); //directory path to save the log