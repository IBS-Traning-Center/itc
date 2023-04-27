<?
  $myID=$_POST[ID];
 
 //phpinfo();
 // $param_encity="";
  if ($myID==0)
  {
   $param_encity = $_POST["PROP"][13]['n0'];
  }  else  {
            // $param_encity = $_POST["PROP"][13][13];
             $param_encity = $_POST["PROP"][13]["$myID:13"];
           //  $param_encity = $_POST["PROP"][13]['n0'];
            }

 if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y" && (!$error) && empty($dontsave))
   {
      if (strlen($param_encity)<=0)
       {
         $error = new _CIBlockError(2, "EN_CITY_REQUIRED",  "ВВЕДЕН ПУСТОЙ ГОРОД англ.");
         $bVarsFromForm = true;
       }


   }
?>
