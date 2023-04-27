<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бесплатные семинары");
?>
<?if (!$USER->IsAuthorized() && (in_array('99', CUser::GetUserGroup($USER->GetID())) || in_array('1', CUser::GetUserGroup($USER->GetID())))) {?>
    <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
            "REGISTER_URL" => "register.php",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => "profile.php",
            "SHOW_ERRORS" => "Y"
        )
    );?>
<?} else {?>
    <div id='content'>
        <div class="learn-box">
            <h2>Бесплатные курсы</h2>
        </div>
        <div class="search-wrap">
            <form>
                <input style="width: 577px;" type="text" name="search-l" value="<?=$_REQUEST["search-l"]?>" placeholder="Поиск по курсам"/>
                <button style="float: right;" name="search" value="поиск">Поиск</button>
            </form>
        </div>
        <?$APPLICATION->IncludeComponent("luxoft:learning.course.list", "course-list", array(
            "COURSE_DETAIL_TEMPLATE" => "course/?COURSE_ID=#COURSE_ID#",
            "SORBY" => "SORT",
            "SORORDER" => "ASC",
            "CHECK_PERMISSIONS" => "Y",
            "COURSES_PER_PAGE" => "30",
            "SET_TITLE" => "Y"
        ),
            false
        );?>
    </div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>