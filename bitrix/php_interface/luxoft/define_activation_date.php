<?




      if (strlen($_POST["ACTIVE_FROM"])<=0)
       {
         $_POST["ACTIVE_FROM"] = date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time());
       }


?>
