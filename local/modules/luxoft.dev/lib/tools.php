<?php

namespace Luxoft\Dev;

class Tools
{
     public static function getUrl($is_absolute = true)
    {
        if($is_absolute) {
            $url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        } else {
            $url = $_SERVER['REQUEST_URI'];
        }
        return $url;
    }
    public static function searchLuxoftName(array $fields, array $validatedFields = []): bool
    {
        $isValidate = count($validatedFields);
        $searchNames = ['luxoft', 'люксофт', 'dxc'];
        $result = false;

        foreach ($fields as $fieldKey => $field) {
            if(
                ($isValidate && !in_array($fieldKey, $validatedFields))
                || gettype($field) !== 'string'
                || empty($field)
            ) {
                continue;
            }

            $field = trim(mb_strtolower($field));
            foreach ($searchNames as $name) {
                if(strpos($field, $name) !== false) {
                    $result = true;
                    break;
                }
            }
        }

        return $result;
    }
}