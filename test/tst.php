<?php

$str = "07.10.2019 - 12.12.2019";
$tryGEtDate = date('d.m.Y', strtotime($str));
$str = str_replace(' ', '', $str);
$str = explode("-", $str)[0];
$date = date('d.m.Y', strtotime($str));
echo $date;
