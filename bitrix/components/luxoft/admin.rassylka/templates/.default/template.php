<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<style>
    .row {
        margin-bottom: 20px;
    }

    ;
    .ui-menu {
        z-index: 999 !important;
    }
</style>
<?
if ($_REQUEST["success"] == "Y") { ?>
    <?
    echo "<h2>Рассылка успешно отправлена</h2><br/>" ?>
<?
} ?>
<div class="row">

</div>
<form action="" method="POST" name="form-rassylka">
    <div class="row">
        <h2>Выберите тип события:</h2><br/>
        <select name="type" class="type">
            <option value="">Выберите тип</option>
            <?
            foreach ($arResult["rass"] as $key => $pismo) { ?>
                <option value="<?= $key ?>"><?= $pismo ?></option>
            <?
            } ?>
        </select>
    </div>
    <h2>Выберите курс по которому будете производить рассылку:</h2>
    <div class="row">
        <br/>
        <input id="search_field" style="width: 400px;" name="coursename" value=""/><br/>
        начните вводить названия курса, а затем выберите из предложенных вариантов
    </div>

    <input type="hidden" name="couseid" class="selectedid" value=""/>

    <div class="row">
        <h2>Укажите email участников для рассылки <b>через запятую:</b></h2><br/>
        <textarea style="width: 400px; height: 165px;" class="email-list" name="email"></textarea>
    </div>
    <input name="rassylka" value="s" class="choose" type="hidden"/>
    <div class="change">
        <div class="row">
            <h2>Откорректируйте шаблон письма</h2><br/>
            Заголовок <br/>
            <input type="text" style="width: 400px;" class="subject" name="subject"/>
        </div>
        <div class="row">
            Текст письма <br/>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:fileman.light_editor",
                "",
                array(
                    "CONTENT" => "",
                    "INPUT_NAME" => "mailbody",
                    "INPUT_ID" => "",
                    "WIDTH" => "100%",
                    "HEIGHT" => "300px",
                    "RESIZABLE" => "Y",
                    "AUTO_RESIZE" => "Y",
                    "VIDEO_ALLOW_VIDEO" => "Y",
                    "VIDEO_MAX_WIDTH" => "640",
                    "VIDEO_MAX_HEIGHT" => "480",
                    "VIDEO_BUFFER" => "20",
                    "VIDEO_LOGO" => "",
                    "VIDEO_WMODE" => "transparent",
                    "VIDEO_WINDOWLESS" => "Y",
                    "VIDEO_SKIN" => "/bitrix/components/bitrix/player/mediaplayer/skins/bitrix.swf",
                    "USE_FILE_DIALOGS" => "Y",
                    "ID" => "",
                    "JS_OBJ_NAME" => ""
                )
            ); ?>
        </div>
    </div>
    <input type="submit" value="Отправить" name="send"/>
</form>
