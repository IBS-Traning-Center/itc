<?php

namespace Sprint\Migration;


class Version20240815105443 extends Version
{
    protected $description = "112820 | Главная Страница / Разделы каталога / 94 IB";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists(
            'courseDirections',
            'edu_const'
        );

        $helper->Iblock()->addSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'Внедрение композитных систем ERP',
    'CODE' => 'vnedrenie_kompozitnykh_sistem_erp',
    'SORT' => '1',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '<p>
	 Данное направление включает в себя программу обучения по управлению проектами и построению комплексной архитектуры для целей импортозамещения и цифровой трансформации системообразующих предприятий РФ с использованием композитных ERP-систем.
</p>
<p>
	 Программа будет полезна участникам проектных команд государственного и коммерческого сектора, которые задействованы во внедрении композитных ERP-систем. Формат обучения предполагает самостоятельное изучение электронных материалов с проверкой полученных знаний на итоговом тестировании. А по ряду курсов – и проведение очных практических семинаров для отработки приобретённых знаний.
</p>',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  1 => 
  array (
    'NAME' => 'Методологии и процессы разработки ПО',
    'CODE' => 'metodologii_i_protsessy_razrabotki_po',
    'SORT' => '10',
    'ACTIVE' => 'N',
    'XML_ID' => 'methodology',
    'DESCRIPTION' => 'Технология разработки в значительной мере зависит от типа проекта. Начиная очередной проект, необходимо лишь выбрать один из таких стандартных подходов. В данном разделе представлены курсы, которые знакомят с различными методологиями разработки: IBM Rational Unified Process, Agile и др. ',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Методологии и процессы разработки программного обеспечения',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  2 => 
  array (
    'NAME' => 'Управление проектами разработки ПО',
    'CODE' => 'upravlenie_proektami_razrabotki_po',
    'SORT' => '10',
    'ACTIVE' => 'Y',
    'XML_ID' => 'management',
    'DESCRIPTION' => 'Раздел представлен базовыми и экспертными тренингами по управлению проектами. Акцент делается на проектах по разработке программного обеспечения.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы менеджеров проектов  от  ведущего разработчика ПО  в восточной Европе. Основы Microsoft Project 2010, взаимодействие с командой.  Базовые тренинги дают фундаментальную подготовку, необходимую любому менеджеру проектов начинающего и среднего уровней, экспертные - углубленно раскрывают отдельные темы.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Курсы управления проектами в IT',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  3 => 
  array (
    'NAME' => 'Гибкие методологии разработки ПО (Agile)',
    'CODE' => 'gibkie-metodologii-razrabotki-po-agile',
    'SORT' => '20',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => 'Этот раздел посвящен курсам по разработке программного обеспечения с помощью Agile-подхода. В разделе представлены курсы различного уровня: от обзорных до профессиональных курсов, сертифицированных в ICAgile.',
    'DESCRIPTION_TYPE' => 'text',
    'UF_META' => 'В разделе представлены курсы различного уровня: от обзорных до профессиональных курсов, сертифицированных в ICAgile.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Гибкие методологии разработки ПО (Agile)',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  4 => 
  array (
    'NAME' => 'Курсы по продуктам Atlassian',
    'CODE' => 'kursy-po-poduktam-atlassian',
    'SORT' => '25',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '<p>
	 Миллионы людей по всему миру ежедневно используют продукты Atlassian при разработке ПО, чтобы повысить качество кода, увеличить скорость выпуска и эффективнее управлять проектами и командной работой. В данном разделе представлены курсы по настройке и работе с наиболее популярным продуктом Atlassian – Jira Software.
</p>',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Сертифицированные курсы Atlassian Jira',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  5 => 
  array (
    'NAME' => 'Архитектура ПО',
    'CODE' => 'arkhitektura-po',
    'SORT' => '30',
    'ACTIVE' => 'Y',
    'XML_ID' => 'architecture',
    'DESCRIPTION' => 'Недостаточная надежность, сложность поддержки и обновления, а также быстродействие и масштабируемость – распространенные проблемы IT-архитектуры. На курсах из данного раздела слушатели получат базовые знания и навыки проектирования и анализа архитектур ПО, более углублённо изучат отдельные темы.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы и лекции по базам данных и системам управления базами данных. Шаблоны проектирования приложений.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Обучение системных архитекторов ',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  6 => 
  array (
    'NAME' => 'Современные методы управления данными (BigData, ML)',
    'CODE' => 'sovremennye-metody-upravleniya-dannymi-bigdata-ml',
    'SORT' => '35',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => 'В данной программе собраны курсы по различным подходам к крупномасштабному хранению и обработке данных – как с использованием традиционных хранилищ данных, так и на основе современных распределенных систем. Курсы адресованы разработчикам Big Data. В собранных тренингах рассматриваются различные инструменты управления данными: MongoDB, Cassandra, Hadoop, Spark, Hive, Impala.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  7 => 
  array (
    'NAME' => 'Бизнес-анализ',
    'CODE' => 'biznes-analiz',
    'SORT' => '40',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '<p>
	 Курсы, входящие в эту группу, ориентированы на тех, кто находится на начальном этапе&nbsp;проекта по разработке ПО: кто постоянно общается с представителями заказчика, выявляет их потребности и предлагает решения, позволяющие повысить эффективность их работы. Здесь дается более глубокое понимание процессов, происходящих в реальном бизнесе, описываются принципы выявления и анализа заинтересованных лиц (stakeholders), а также делается акцент на построении правильной межличностной коммуникации со всеми участниками проекта.
</p>
<p>
	 Большая часть раздела посвящена непосредственному изучению BABOK® (Business Analysis Body of Knowledge) ver. 3 в объеме, достаточном для последующей сдачи сертификационных экзаменов IIBA® (International Institute of Business Analysis).
</p>
<p>
	 Поскольку роль бизнес-аналитика в проекте уникальна и требует разносторонних навыков, среди курсов этого раздела представлены также тренинги, позволяющие развить некоторые специфические навыки: проектирование пользовательских интерфейсов, грамотное построение документации различного назначения и другие.
</p>
<p>
	 Курсы этого раздела будут полезны всем, кто уже обладает навыками системного анализа и нуждается в углублении понимания того, как потребности бизнеса могут быть удовлетворены с помощью организационных и программно-технических решений: руководителям проектов (Project managers), владельцам продукта (Product Owners), &nbsp;ИТ-аналитикам (IT Analysts) и др.
</p>',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  8 => 
  array (
    'NAME' => 'Системный анализ',
    'CODE' => 'sistemnyy-analiz',
    'SORT' => '50',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '<p>
	 Программа ориентирована на слушателей, занимающихся сбором, анализом и описанием требований к ПО. &nbsp;Представленные в данном разделе курсы&nbsp;основаны на лучших практиках унифицированного процесса разработки, успешно применяемых в различных методологиях разработки ПО. Изучаемые темы закрепляются во время&nbsp;выполнения&nbsp;практических упражнений. В ряде случаев (по договоренности с группой) практические занятия посвящаются решению конкретных бизнес-кейсов, предложенных самими слушателями.&nbsp;
</p>
<p>
	 Слушатели получают навык документирования требований в виде текстовых спецификаций (Software Requirements Specification), в форме сценариев использования (use cases) и «пользовательских историй» (user stories); а также представление о том, как влияет качество и полнота требований на архитектуру программного продукта и на успешность проекта разработки ПО в целом.
</p>
<p>
	 Большое внимание уделяется навыкам визуального моделирования (в нотациях UML, BPMN, IDEF0). При этом акцент делается не на «рисовании&nbsp;диаграмм», а на подробном осмыслении и анализе объекта моделирования, что позволяет более глубоко понять его структуру и поведение.
</p>
<p>
	 Знаний и навыков, полученных во время обучения, будет достаточно для самостоятельной работы в роли системного&nbsp;аналитика. Курсы этого раздела будут полезны всем, кто причастен к сбору, анализу, управлению и контролю качества требований при разработке&nbsp;ПО. В ходе тренингов используются многие техники, описанные в BABOK® (Business Analysis Body of Knowledge) ver. 3, что создает хорошую основу для дальнейшего углубления навыков системного и бизнес-анализа и продолжения карьеры аналитика. &nbsp;
</p>',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  9 => 
  array (
    'NAME' => 'Системный и бизнес-анализ',
    'CODE' => 'sistemnyy_i_biznes-analiz',
    'SORT' => '50',
    'ACTIVE' => 'N',
    'XML_ID' => 'analytics',
    'DESCRIPTION' => 'Luxoft Training получил статус Endorsed Education Provider (EEP&trade;) of International Institute of Business Analysis (IIBA&reg;), что подтверждает соответствие учебных курсов, предлагаемых Luxoft Training, своду знаний по бизнес-анализу BABOK® (Business Analysis Body of Knowledge). 
<div>Школы системного и бизнес-анализа в нашем каталоге тесно соприкасаются и органично дополняют друг друга. В разделе представлены курсы по системному анализу, сбору и анализу требований, моделированию бизнес-процесов, Business Inteligence и ВАВОК.</div>
 ',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы бизнес и системного аналитика от экспертов-практиков в Luxoft Training. Подготовка и сертификация BABOK. Обучение бизнес-процессам, курсы проектирования интерфейсов.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Обучение системных и бизнес-аналитиков',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  10 => 
  array (
    'NAME' => 'Разработка ПО',
    'CODE' => 'razrabotka_po',
    'SORT' => '60',
    'ACTIVE' => 'N',
    'XML_ID' => 'development',
    'DESCRIPTION' => 'В разделе представлены курсы по разработке ПО с использованием различных платформ и технологий: .NET, Java, C/C++, разработке мобильных и web-приложений и др. Также в разделе представлены общие курсы по разработке без привязки к платформам и технологиям.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования от экспертов-практиков в Luxoft Training. Обучение языкам программирования: Java, .Net, C#, C++, Oracle, HTML5, PHP, Android. Примеры разработки из реальных проектов.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'Программирование для офисных приложений',
        'CODE' => 'programmirovanie_dlya_ofisnyh_prilogeniy',
        'SORT' => '670',
        'ACTIVE' => 'N',
        'XML_ID' => 'office',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
    ),
  ),
  11 => 
  array (
    'NAME' => 'UI/UX: проектирование, тестирование и дизайн',
    'CODE' => 'ui-ux-proektirovanie-testirovanie-i-dizayn',
    'SORT' => '60',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => '1',
    'UF_MAIN_PAGE_IMAGE' => '15617',
  ),
  12 => 
  array (
    'NAME' => 'Безопасность ПО',
    'CODE' => 'bezopasnost-po',
    'SORT' => '70',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => 'В данном разделе представлены тренинги по безопасности программного обеспечения, в том числе веб-приложений. Отдельный акцент делается на уязвимостях, их влиянии на бизнес и способах выявления проблем и ошибок в исходном коде приложения. ',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Обучение IT-специалистов. Курсы по безопасности программного обеспечения, в том числе веб-приложений. ',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => '1',
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  13 => 
  array (
    'NAME' => 'Разработка ПО (общие курсы)',
    'CODE' => 'obshchie_kursy_po_razrabotke_po',
    'SORT' => '71',
    'ACTIVE' => 'Y',
    'XML_ID' => 'development_general',
    'DESCRIPTION' => 'В данном разделе собраны курсы, которые будут полезны всем разработчикам, независимо от используемого языка разработки. ',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования от экспертов-практиков в Luxoft Training. Обучение IT-специалистов: рефакторинг кода, TDD, Agile.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  14 => 
  array (
    'NAME' => 'Разработка ПО (.NET)',
    'CODE' => 'razrabotka_po_net',
    'SORT' => '72',
    'ACTIVE' => 'Y',
    'XML_ID' => 'development_net',
    'DESCRIPTION' => 'В данном разделе собраны курсы, которые будут полезны разработчику на .NET от базового курса для начинающих, в котором даётся обзор платформы, до курсов экспертного уровня, в которых раскрываются отдельные темы на уровне tips&amp;tricks.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования на платформе .Net от крупнейшего разработчика заказного ПО в Восточной Европе. ',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Курсы для .Net и С# разработчиков',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  15 => 
  array (
    'NAME' => 'Разработка ПО (Java)',
    'CODE' => 'razrabotka_po_java',
    'SORT' => '73',
    'ACTIVE' => 'Y',
    'XML_ID' => 'development_java',
    'DESCRIPTION' => 'В данном разделе собраны курсы, которые будут полезны разработчику на Java. Разработка на платформе Java, работа с Java веб-сервисами, разработка бизнес-приложений, рефакторинг кода и многие другие темы, которые будут интересны как новичку, так и опытному разработчику.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования на Java от крупнейшего разработчика заказного ПО в Восточной Европе. Java для начинающих и продвинутых разработчиков. Обучение Java от экспертов-практиков Luxoft.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Курсы Java для начинающих и продвинутых',
    'UF_SHOW_ON_MAIN_PAGE' => '1',
    'UF_MAIN_PAGE_IMAGE' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'JAVA CORE',
        'CODE' => 'java-core',
        'SORT' => '1',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => '1',
        'UF_MAIN_PAGE_IMAGE' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'Java basics',
            'CODE' => 'java-basics',
            'SORT' => '1',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          1 => 
          array (
            'NAME' => 'Java Core APIs',
            'CODE' => 'java-core-apis',
            'SORT' => '2',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          2 => 
          array (
            'NAME' => 'Java 8/9+ features',
            'CODE' => 'java-8-9-features',
            'SORT' => '3',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          3 => 
          array (
            'NAME' => 'Java Practical Seminars',
            'CODE' => 'java-practical-seminars',
            'SORT' => '4',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
        ),
      ),
      1 => 
      array (
        'NAME' => 'EFFECTIVE JAVA',
        'CODE' => 'effective-java',
        'SORT' => '2',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'Effective Java developer',
            'CODE' => 'effective-java-developer',
            'SORT' => '1',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          1 => 
          array (
            'NAME' => 'Java Testing',
            'CODE' => 'java-testing',
            'SORT' => '2',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          2 => 
          array (
            'NAME' => 'Java Build Tools',
            'CODE' => 'java-build-tools',
            'SORT' => '3',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
        ),
      ),
      2 => 
      array (
        'NAME' => 'JAVA ADVANCED',
        'CODE' => 'java-advanced',
        'SORT' => '3',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'Java Advanced courses',
            'CODE' => 'java-advanced-courses',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
        ),
      ),
      3 => 
      array (
        'NAME' => 'JAVA ENTERPRISE',
        'CODE' => 'java-enterprise',
        'SORT' => '4',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'Java integration technologies',
            'CODE' => 'java-integration-technologies',
            'SORT' => '5',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          1 => 
          array (
            'NAME' => 'JEE Application Server technologies',
            'CODE' => 'jee-application-server-technologies',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          2 => 
          array (
            'NAME' => 'JEE technologies',
            'CODE' => 'jee-technologies',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          3 => 
          array (
            'NAME' => 'Java Messaging Servers',
            'CODE' => 'java-messaging-servers',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          4 => 
          array (
            'NAME' => 'Developer Productivity libraries',
            'CODE' => 'developer-productivity-libraries',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          5 => 
          array (
            'NAME' => 'Java Databases',
            'CODE' => 'java-databases',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          6 => 
          array (
            'NAME' => 'Java high-load technologies',
            'CODE' => 'java-high-load-technologies',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
        ),
      ),
      4 => 
      array (
        'NAME' => 'SPRING',
        'CODE' => 'spring',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'Spring Basics',
            'CODE' => 'spring-basics',
            'SORT' => '100',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
          1 => 
          array (
            'NAME' => 'Spring Advanced',
            'CODE' => 'spring-advanced',
            'SORT' => '200',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
        ),
      ),
      5 => 
      array (
        'NAME' => 'JVM-BASED LANGUAGES',
        'CODE' => 'jvm-based-languages',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'JVM-based languages',
            'CODE' => 'jvm-based-languages',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
        ),
      ),
      6 => 
      array (
        'NAME' => 'ChatGPT для Java-разработчиков',
        'CODE' => 'chatgpt-dlya-java-razrabotchikov',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => 'ChatGPT - передовая модель искусственного интеллекта, разработанная OpenAI, способная генерировать тексты, имитирующие человеческую речь. В рамках обучения&nbsp;вы научитесь интегрировать ChatGPT в ваши Java-приложения, создавая уникальные интерактивные инструменты для взаимодействия с пользователями.',
        'DESCRIPTION_TYPE' => 'html',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
      7 => 
      array (
        'NAME' => 'Подготовка к сдаче сертификационного теста',
        'CODE' => 'podgotovka-k-sdache-sertifikatsionnogo-testa',
        'SORT' => '998',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
      8 => 
      array (
        'NAME' => 'Подготовка к сертификации Oracle Java SE8 Programmer',
        'CODE' => 'podgotovka-k-sertifikatsii',
        'SORT' => '999',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'Oracle Java SE8 Programmer',
            'CODE' => 'oracle-java-se8-programmer',
            'SORT' => '500',
            'ACTIVE' => 'Y',
            'XML_ID' => '',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'UF_META' => NULL,
            'UF_EXPERT' => NULL,
            'UF_H_TITLE' => NULL,
            'UF_SHOW_ON_MAIN_PAGE' => NULL,
            'UF_MAIN_PAGE_IMAGE' => NULL,
          ),
        ),
      ),
    ),
  ),
  16 => 
  array (
    'NAME' => 'Разработка ПО (Web)',
    'CODE' => 'razrabotka_po_web',
    'SORT' => '74',
    'ACTIVE' => 'Y',
    'XML_ID' => 'development_web',
    'DESCRIPTION' => 'В данном разделе представлены курсы, которые будут полезны web-разработчику: использование XML, XSD, XSLT, XPATH, Altova, JavaScript и многое другое, что необходимо знать для разработки web-приложений.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования для WEB-разработчиков от экспертов-практиков в Luxoft Training: начинающий и продвинутый уровни. ',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Курсы web-программирования',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  17 => 
  array (
    'NAME' => 'Разработка ПО (C, C++)',
    'CODE' => 'razrabotka_po_c_cplusplus',
    'SORT' => '75',
    'ACTIVE' => 'Y',
    'XML_ID' => 'development_c',
    'DESCRIPTION' => 'В разделе представлены курсы, которые будут полезны разработчикам на С/С++: от обзорного курса, в котором изучаются основы, до изучения лучших практик, стандартных шаблонов и использования GoF-паттернов.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования на языке С, С++ от экспертов-практиков в Luxoft Training для начинающих и продвинутых разработчиков.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Обучение C и C++ разработчиков',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  18 => 
  array (
    'NAME' => 'Разработка ПО (Mobile)',
    'CODE' => 'razrabotka_po_mobile',
    'SORT' => '76',
    'ACTIVE' => 'N',
    'XML_ID' => 'development_mobile',
    'DESCRIPTION' => 'В даном разделе собраны курсы, которые будут полезны разработчику приложений для мобильных устройств. Сейчас раздел представлен базовым курсом, в которых изучаются вопросы разработки программ для ОС Android.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования для разработчиков на платформе Android от экспертов-практиков в Luxoft Training.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Курсы по разработке мобильных приложений',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  19 => 
  array (
    'NAME' => 'Разработка ПО (базы данных)',
    'CODE' => 'razrabotka_po_bazy_dannyh',
    'SORT' => '77',
    'ACTIVE' => 'Y',
    'XML_ID' => 'development_databases',
    'DESCRIPTION' => 'В даном разделе собраны курсы, которые будут полезны разработчику баз данных. В курсах из этого раздела изчучаются языки запросов SQL, PL/SQL, рассматриваются вопросы настройки производительности и многие другие, которые будут интересны и полезны не только начинающим, но и опытным разработчикам.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы программирования от крупнейшего разработчика ПО в Восточной Европе: Oracle и базы данных.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Курсы Oracle и SQL',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  20 => 
  array (
    'NAME' => 'Разработка ПО (PowerCenter)',
    'CODE' => 'razrabotka_po_powercenter',
    'SORT' => '78',
    'ACTIVE' => 'N',
    'XML_ID' => 'development_powercenter',
    'DESCRIPTION' => 'В данном разделе представлены курсы, которые будут полезны разработчикам, работающим с Informatica PowerCenter &ndash; ETL-инструментом, используемым в различных интеграционных проектах и проектах построения хранилищ данных. ',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы по работе с  Informatica Power Center  для разработчиков начинающего и продвинутого уровней от экспертов-практиков в Luxoft Training.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  21 => 
  array (
    'NAME' => 'Разработка ПО (Python)',
    'CODE' => 'python',
    'SORT' => '79',
    'ACTIVE' => 'Y',
    'XML_ID' => 'script',
    'DESCRIPTION' => 'Представлены курсы для  разработчиков на скриптовом языке Python.',
    'DESCRIPTION_TYPE' => 'text',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  22 => 
  array (
    'NAME' => 'Тестирование ПО',
    'CODE' => 'testirovanie',
    'SORT' => '81',
    'ACTIVE' => 'Y',
    'XML_ID' => 'software_testing',
    'DESCRIPTION' => 'Данный раздел включает в себя тренинги, посвященные тестированию ПО как функциональному, в том числе автоматизированному,  так и практически всем видам нефункционального тестирования, в том числе тестированию удобства использования и тестированию производительности.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Курсы по тестированию для начинающих и продвинутых от экспертов-практиков в Luxoft Training.',
    'UF_EXPERT' => '11130',
    'UF_H_TITLE' => 'Курсы и тренинги для тестировщиков',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  23 => 
  array (
    'NAME' => 'Тестирование ПО: консультации гуру',
    'CODE' => 'testirovanie-konsultatsii-guru',
    'SORT' => '85',
    'ACTIVE' => 'N',
    'XML_ID' => '',
    'DESCRIPTION' => 'Курсы данного раздела представляют собой тренинги-консультации гуру тестирования <a href="https://www.luxoft-training.ru/about/experts/alexandrov.html">Александра Александрова</a>. <br>
 Александр – эксперт по управлению качеством ПО, управлению тестированием, анализу и совершенствованию инженерных процессов с опытом работы более 50 лет, эксперт ISTQB, RSTQB. Работает в компании Luxoft, где планирует и управляет тестированием в проектах, разрабатывает тестовые сценарии, проводит тестирование, аудит процессов тестирования и смежных процессов. С 2000 г. ведет тренинги в Luxoft Training, с 2006 г. – тренинг «Quality Assurance» университета Карнеги-Меллон, с 2011 г. – тренинги ISTQB.<br>',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => '11130',
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  24 => 
  array (
    'NAME' => 'Автоматизированное и нагрузочное тестирование ',
    'CODE' => 'avtomatizirovannoe-i-nagruzochnoe-testirovanie',
    'SORT' => '85',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  25 => 
  array (
    'NAME' => 'Управленческая эффективность и коммуникации',
    'CODE' => 'upravlencheskaya_effektivnost_i_kommunikatsii',
    'SORT' => '90',
    'ACTIVE' => 'Y',
    'XML_ID' => 'manager-eff',
    'DESCRIPTION' => 'Раздел представлен тренингами по управленческой эффективности и коммуникациям, в том числе изучаются различные виды коммуникаций, происходящих в практике управления проектами.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Обучение IT-специалистов: курсы по  различным аспектам сопровождения IT-приложений, описанными в ITIL/ITSM от экспертов-практиков в Luxoft Training.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Управленческая эффективность и коммуникации',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'Программа «7 ступеней к лидерству»',
        'CODE' => 'programma_7_stupeney_k_liderstvu',
        'SORT' => '500',
        'ACTIVE' => 'N',
        'XML_ID' => 'leadersteps',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
    ),
  ),
  26 => 
  array (
    'NAME' => 'Личная эффективность и коммуникации',
    'CODE' => 'lichnaya_effektivnost',
    'SORT' => '100',
    'ACTIVE' => 'N',
    'XML_ID' => 'personal-eff',
    'DESCRIPTION' => 'Данный раздел включает в себя базовые и экспертные тренинги по разным видам коммуникаций, происходящих в практике выполнения проектов на исполнительском (инженерном) уровне. Отдельный акцент делается на проектах по разработке программного обеспечения. ',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Обучение IT-специалистов: курсы по различным видам коммуникации внутри IT-проекта. Курсы для развития личностных и управленческих компетенций.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  27 => 
  array (
    'NAME' => 'Экспертиза в предметных областях',
    'CODE' => 'ekspertiza_v_predmetnyh_oblastyah',
    'SORT' => '100',
    'ACTIVE' => 'N',
    'XML_ID' => 'domain',
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'UF_META' => 'Обучение IT-специалистов от ведущего разработчика заказного ПО в Восточной Европе.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  28 => 
  array (
    'NAME' => 'Управление IT-сервисами',
    'CODE' => 'upravlenie_it-servisami',
    'SORT' => '110',
    'ACTIVE' => 'N',
    'XML_ID' => 'service_management',
    'DESCRIPTION' => 'Раздел представлен курсами по различным аспектам сопровождения современных IТ-приложений, описанными в ITIL/ITSM. На поддержку таких приложений на сегодняшний день тратится до 60&ndash;80 % бюджета IТ-службы крупного предприятия, и крайне важно потратить эти средства максимально эффективно.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  29 => 
  array (
    'NAME' => 'Непрофильные курсы',
    'CODE' => 'neprofilnye_kursy',
    'SORT' => '110',
    'ACTIVE' => 'N',
    'XML_ID' => 'it_basis',
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  30 => 
  array (
    'NAME' => 'DevOps и администрирование',
    'CODE' => 'devops-i-administrirovanie',
    'SORT' => '118',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => 'В данном разделе собраны курсы по основным практикам и технологиям DevOps. Рассматриваются темы непрерывной интеграции, непрерывной поставки с применением Docker, Ansible и др. Курсы содержат лабораторные работы, которые на практике позволяют отработать полученные знания.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  31 => 
  array (
    'NAME' => 'Администрирование ПО',
    'CODE' => 'administrirovanie_po',
    'SORT' => '120',
    'ACTIVE' => 'N',
    'XML_ID' => 'administration_software',
    'DESCRIPTION' => 'Данное направление включает в себя тренинги, в которых изучаются вопросы администрирования СУБД Oracle, систем Unix и Linux. ',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Обучение IT-специалистов: курсы по администрированию программного обеспечения: Linux, Oracle от экспертов-практиков в Luxoft Training.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'Microsoft',
        'CODE' => 'microsoft',
        'SORT' => '20',
        'ACTIVE' => 'N',
        'XML_ID' => 'microsoft',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
      1 => 
      array (
        'NAME' => 'Cisco',
        'CODE' => 'cisco',
        'SORT' => '50',
        'ACTIVE' => 'N',
        'XML_ID' => 'cisco',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
      2 => 
      array (
        'NAME' => 'Novell',
        'CODE' => 'novell',
        'SORT' => '70',
        'ACTIVE' => 'N',
        'XML_ID' => 'novell',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => NULL,
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
    ),
  ),
  32 => 
  array (
    'NAME' => 'Подготовка внутренних тренеров ИТ-компаний',
    'CODE' => 'podgotovka_vnutrennih_trenerov_it_kompaniy',
    'SORT' => '130',
    'ACTIVE' => 'N',
    'XML_ID' => 'internal_trainer',
    'DESCRIPTION' => 'В данном разделе представлены курсы для внутренних тренеров ИТ-компаний, во время изучения которых слушатели получат базовые навыки подготовки презентации и проведения выступления, узнают способы мотивации участников и разберут типичные конфликты в тренинге, подходы к оценке результатов обучения.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  33 => 
  array (
    'NAME' => 'Успешный рекрутмент',
    'CODE' => 'uspeshnyy_rekrutment',
    'SORT' => '140',
    'ACTIVE' => 'N',
    'XML_ID' => 'successful_recruitment',
    'DESCRIPTION' => 'Данный раздел включает в себя тренинги, предназначенные для всестороннего обучения и повышения квалификации сотрудников кадровых агентств и внутренних отделов подбора персонала ИТ-компаний.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => 'Обучение и повышение квалификации сотрудников кадровых агентств и внутренних отделов подбора персонала IT-компаний.',
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Курсы для HR-менеджеров',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'Успешный внутренний рекрутёр',
        'CODE' => 'uspeshnyy_vnutrenniy_rekrutyor',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => 'successful_internal_recruiter',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => 'Курсы для HR-менеджеров в компании',
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
      1 => 
      array (
        'NAME' => 'Успешный внешний рекрутёр',
        'CODE' => 'uspeshnyy_vneshniy_rekrutyor',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => 'successful_external_recruiter',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_META' => NULL,
        'UF_EXPERT' => NULL,
        'UF_H_TITLE' => 'Обучение HR-менеджеров',
        'UF_SHOW_ON_MAIN_PAGE' => NULL,
        'UF_MAIN_PAGE_IMAGE' => NULL,
      ),
    ),
  ),
  34 => 
  array (
    'NAME' => 'Финансы и банки',
    'CODE' => 'finansy-i-banki',
    'SORT' => '150',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => 'В данном разделе представлены
курсы, посвященные различным аспектам современных финансовых рынков, финансовых
активов и инструментов, деривативов, инвестиционному банкингу, управлению
активами, корпоративным финансам, управлению рисками, альтернативным
инвестициям, корпоративному и транзакционному банкингу.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => 'Финансы и Банки',
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  35 => 
  array (
    'NAME' => 'Go разработка',
    'CODE' => 'go_razrabotka',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => 'Go, также известный как Golang, является относительно новым языком программирования, разработанным компанией Google.&nbsp;Он был создан с целью ускорить процесс разработки программного обеспечения и предложить альтернативу языкам C и C++.&nbsp;Одной из главных особенностей Go является его простой синтаксис, что делает его доступным для начинающих разработчиков.',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
  36 => 
  array (
    'NAME' => 'Авторизованные курсы Postgres Professional',
    'CODE' => 'avtorizovannye-kursy-postgres-professional',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '<a href="https://postgrespro.ru/"><img width="100" alt="PostgresPro_logo.png" src="/upload/medialibrary/e08/561moxum78vvnjrfdvjb0whvutpy9bnu/PostgresPro_logo.png" height="32" title="PostgresPro_logo.png"></a>&nbsp;<br>
 Учебный центр IBS заключил партнерское соглашение c компанией Postgres Professional — российским разработчиком системы управления базами данных Postgres Pro на основе PostgreSQL. <br>
 <br>
 Обучение рассчитано на специалистов базового и продвинутого уровней. Все курсы состоят из нескольких модулей, каждый из которых включает теоретическую и практическую части.<br>
 <br>
 Материалы подготовлены экспертами Postgres Professional, курсы проводят сертифицированные преподаватели.<br>
 <br>
 После обучения каждый слушатель сможет получить статус сертифицированного специалиста по PostgreSQL, сдав соответствующий экзамен. Это актуально для администраторов БД. Сертификация для разработчиков приложений PostgreSQL в процессе подготовки вендором. Официальный статус сертифицированного администратора БД PostgreSQL присваивается только после сдачи экзамена в Postgres Professional. После прослушивания курсов, участникам будет выдан <a href="http://ibs-training.ru/upload/cert_uc.pdf"><b><u>сертификат.</u></b></a><br>',
    'DESCRIPTION_TYPE' => 'html',
    'UF_META' => NULL,
    'UF_EXPERT' => NULL,
    'UF_H_TITLE' => NULL,
    'UF_SHOW_ON_MAIN_PAGE' => NULL,
    'UF_MAIN_PAGE_IMAGE' => NULL,
  ),
)        );
    }

    public function down()
    {
        //your code ...
    }
}
