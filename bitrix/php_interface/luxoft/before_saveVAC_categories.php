<?
  $myID=$_POST[ID];
  if ($myID==0)
  {
   $param_encateg = $_POST["PROP"][30]['n0'];
  }  else  {
            $param_encateg = $_POST["PROP"][30]["$myID:30"];
           }

 if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y" && (!$error) && empty($dontsave))
   {
      if (strlen($param_encateg)<=0)
       {
         $error = new _CIBlockError(2, "EN_CATEGORY_REQUIRED",  "ВВЕДЕНА ПУСТАЯ КАТЕГОРИЯ англ.");
         $bVarsFromForm = true;
       }


   }
?>
