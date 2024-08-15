<?php
define("BX_USE_MYSQLI", true);
$DBType = "mysql";
$DBHost = "mysql-8.0";
$DBLogin = "root";
$DBPassword = "";
$DBName = "ibs.local";
$DBDebug = false;
$DBDebugToFile = false;

define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
@umask(~(BX_FILE_PERMISSIONS | BX_DIR_PERMISSIONS) & 0777);

define("BX_DISABLE_INDEX_PAGE", true);

define("BX_UTF", true);
mb_internal_encoding("UTF-8");
define('BX_CRON TAB_SUPPORT', true);

//define("BX_CACHE_TYPE", "memcache");
//define("BX_CACHE_SID", $_SERVER["DOCUMENT_ROOT"]."#01");
//define("BX_MEMCACHE_HOST", "localhost");
//define("BX_MEMCACHE_PORT", "11211");
//
//define('BX_SECURITY_SESSION_MEMCACHE_HOST', 'localhost');
//define('BX_SECURITY_SESSION_MEMCACHE_PORT', 11211);