<?php

namespace Luxoft\Dev\Tools;

class Email
{
    public static function getScheduleEmailBlock($elementId, $timetableIds)
    {
        global $APPLICATION;
        ob_start();
        $APPLICATION->IncludeComponent(
            'luxoft:email.timetable',
            '',
            [
                'ELEMENT_ID' => $elementId,
                'TIMETABLE_IDS' => $timetableIds,
            ]);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}