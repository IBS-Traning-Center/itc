<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/training/katalog_kursov/kompleksnye-programmy/([a-zA-Z0-9_\\-]+)/($|\\#.+|\\?.+)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/training/katalog_kursov/kompleksnye-programmy/section.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/training/catalog_directions/([a-zA-Z0-9_\\-]+)/($|\\#.+|\\?.+)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/training/catalog_directions/section.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/about/informatsiya-dlya-smi/press-relizy/([0-9]*)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/about/informatsiya-dlya-smi/press-relizy/detail.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/training/katalog_kursov/([a-zA-Z0-9_\\-]+)/($|\\#.+|\\?.+)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/training/katalog_kursov/section.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#/frdo-form/([a-zA-Z0-9_\\-]+)/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1&DATE=$2',
    'ID' => 'bitrix:news.detail',
    'PATH' => '/frdo-form/detail.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/corporate/business_cases/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/corporate/business_cases/detail.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/training/seminar/seminarinfo.html?ID=([0-9]+)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/training/seminar/seminarinfo.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/library/business_cases/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/library/business_cases/detail.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/events/seminar/seminarinfo.html?ID=([0-9]+)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/events/seminar/seminarinfo.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/training/selflearning/([0-9]*)/([0-9]*)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/training/selflearning/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/training/catalog/code/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/training/catalog/section.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/library/analytics/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/library/analytics/detail.php',
    'SORT' => 100,
  ),
  24 => 
  array (
    'CONDITION' => '#^/about/news/([a-zA-Z0-9_\\-]+)/($|\\#.+|\\?.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/about/news/detail.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/training/testing/([0-9]*)/([0-9]*)(/?)(.+)#',
    'RULE' => 'COURSE_ID=$1&TEST_ID=$2',
    'ID' => '',
    'PATH' => '/training/testing/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/training/catalog/word/([a-zA-Z0-9-]+)(/?)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/training/catalog/export.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/training/it-guru/([a-zA-Z0-9-]+).html(.*)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/training/it-guru/detail.php',
    'SORT' => 100,
  ),
  26 => 
  array (
    'CONDITION' => '#^/kurs-last/([a-zA-Z0-9-\\-_\\_]+).html(.*)#',
    'RULE' => 'XML_ID=$1',
    'ID' => '',
    'PATH' => '/kurs-last/index.php',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/summer-school/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/summer-school/index.php',
    'SORT' => 100,
  ),
  69 => 
  array (
    'CONDITION' => '#^/kurs/([a-zA-Z0-9-\\-_\\_]+).html($|\\#.+|\\?.+)#',
    'RULE' => 'CODE=$1',
    'ID' => 'luxoft:courses.detail',
    'PATH' => '/kurs/index.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/kurs_old/([a-zA-Z0-9-\\-_\\_]+).html(.*)#',
    'RULE' => 'XML_ID=$1',
    'ID' => '',
    'PATH' => '/kurs_old/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/master-class/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/master-class/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/school-test/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/school-test/index.php',
    'SORT' => 100,
  ),
  23 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/internship/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/internship/index.php',
    'SORT' => 100,
  ),
  61 => 
  array (
    'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => 'bitrix:im.router',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/soft-labs/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/soft-labs/index.php',
    'SORT' => 100,
  ),
  27 => 
  array (
    'CONDITION' => '#^/contacts/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/contacts/detail.php',
    'SORT' => 100,
  ),
  28 => 
  array (
    'CONDITION' => '#/frdo-form/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => 'bitrix:news.detail',
    'PATH' => '/frdo-form/detail.php',
    'SORT' => 100,
  ),
  31 => 
  array (
    'CONDITION' => '#^/personal/library/([0-9]*)(/?)(.+)#',
    'RULE' => 'ELEMENT_ID=$1',
    'ID' => '',
    'PATH' => '/personal/library/detail.php',
    'SORT' => 100,
  ),
  32 => 
  array (
    'CONDITION' => '#^/training/actions/([0-9]*)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/training/actions/detail.php',
    'SORT' => 100,
  ),
  29 => 
  array (
    'CONDITION' => '#^/it-guru/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/it-guru/index.php',
    'SORT' => 100,
  ),
  30 => 
  array (
    'CONDITION' => '#^/training/seminar/([0-9]+)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/training/seminar/seminarinfo.php',
    'SORT' => 100,
  ),
  33 => 
  array (
    'CONDITION' => '#^/school/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/school/index.php',
    'SORT' => 100,
  ),
  34 => 
  array (
    'CONDITION' => '#^/events/partners/([0-9]*)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/events/partners/detail.php',
    'SORT' => 100,
  ),
  35 => 
  array (
    'CONDITION' => '#^/library/rating/([0-9]*)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/library/rating/detail.php',
    'SORT' => 100,
  ),
  37 => 
  array (
    'CONDITION' => '#^/agile/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/agile/index.php',
    'SORT' => 100,
  ),
  36 => 
  array (
    'CONDITION' => '#^/events/seminar/([0-9]+)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/events/seminar/seminarinfo.php',
    'SORT' => 100,
  ),
  39 => 
  array (
    'CONDITION' => '#^/quiz/([a-zA-Z0-9_\\-]+)(/?)(.+)#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/quiz/index.php',
    'SORT' => 100,
  ),
  40 => 
  array (
    'CONDITION' => '#^/about/media/([0-9]*)(/?)(.+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/about/media/detail.php',
    'SORT' => 100,
  ),
  41 => 
  array (
    'CONDITION' => '#^/events/webinar/([0-9]+)(/?)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/events/webinar/webinarinfo.php',
    'SORT' => 100,
  ),
  42 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  43 => 
  array (
    'CONDITION' => '#^/about/experts/answers/#',
    'RULE' => '',
    'ID' => 'bitrix:support.faq',
    'PATH' => '/about/experts/answers/index.php',
    'SORT' => 100,
  ),
  44 => 
  array (
    'CONDITION' => '#^/clients/clients.html#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/clients/index.html',
    'SORT' => 100,
  ),
  67 => 
  array (
    'CONDITION' => '#^/catalog/direction/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/catalog/direction/index.php',
    'SORT' => 100,
  ),
  47 => 
  array (
    'CONDITION' => '#^/training/category/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/training/category/about.php',
    'SORT' => 100,
  ),
  45 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  46 => 
  array (
    'CONDITION' => '#^/about/experts/ask/#',
    'RULE' => '',
    'ID' => 'bitrix:iblock.element.add.form',
    'PATH' => '/about/experts/ask/index.php',
    'SORT' => 100,
  ),
  48 => 
  array (
    'CONDITION' => '#^/digest-generator/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/digest-generator/index.php',
    'SORT' => 100,
  ),
  50 => 
  array (
    'CONDITION' => '#^/training/school/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/training/school/about.php',
    'SORT' => 100,
  ),
  49 => 
  array (
    'CONDITION' => '#^/internal/school/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/internal/school/about.php',
    'SORT' => 100,
  ),
  68 => 
  array (
    'CONDITION' => '#^/catalog/complex/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/catalog/complex/index.php',
    'SORT' => 100,
  ),
  51 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  19 => 
  array (
    'CONDITION' => '#^/about/experts/#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/about/experts/index.php',
    'SORT' => 100,
  ),
  52 => 
  array (
    'CONDITION' => '#^/training/faq/#',
    'RULE' => '',
    'ID' => 'bitrix:support.faq',
    'PATH' => '/training/faq/index.php',
    'SORT' => 100,
  ),
  53 => 
  array (
    'CONDITION' => '#^/support/#',
    'RULE' => '',
    'ID' => 'bitrix:support.ticket',
    'PATH' => '/support/index.php',
    'SORT' => 100,
  ),
  54 => 
  array (
    'CONDITION' => '#^/rss.php#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/rss/index.php',
    'SORT' => 100,
  ),
  55 => 
  array (
    'CONDITION' => '#^/forum/#',
    'RULE' => '',
    'ID' => 'bitrix:forum',
    'PATH' => '/forum/index.php',
    'SORT' => 100,
  ),
  58 => 
  array (
    'CONDITION' => '#^/club/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork',
    'PATH' => '/club/index.php',
    'SORT' => 100,
  ),
  65 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  66 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
);
