<?

      if (strlen($_POST["ACTIVE_FROM"])<=0)
       {
         $_POST["ACTIVE_FROM"] = date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time());
       }


  $myID=$_POST[ID];
//phpinfo();
 // echo "$myID";

     $param_ru = $_POST["PROP"][11][0];
     $param_com = $_POST["PROP"][12][0];
     $param_city =  $_POST["PROP"][3][0];
   //  $param_categ =  $_POST["PROP"][4][0];
   //  $param_hot =  $_POST["PROP"][5][0];
    // $param_ru_description =  $_POST["PROP"][6]['n0']['VALUE']['TEXT'];
    // $param_ru_requirements = $_POST["PROP"][7]['n0']['VALUE']['TEXT'];

 if ($myID==0)
  {

     $param_internal_code = $_POST["PROP"][2]['n0'];
     $param_email=$_POST["PROP"][8]['n0'];      //emailform  value if this record does not exist
     $param_ru_description =  $_POST["PROP"][6]['n0']['VALUE']['TEXT'];
     $param_ru_requirements = $_POST["PROP"][7]['n0']['VALUE']['TEXT'];
     $param_en_description =  $_POST["PROP"][9]['n0']['VALUE']['TEXT'];
     $param_en_requirements = $_POST["PROP"][10]['n0']['VALUE']['TEXT'];
  // $param_ru_description = $_POST["PROP_6__n0__VALUE__TEXT_"];
  // $param_ru_requirements = $_POST["PROP_7__n0__VALUE__TEXT_"];
  // $param_en_description = $_POST["PROP_9__n0__VALUE__TEXT_"];
  // $param_en_requirements = $_POST["PROP_10__n0__VALUE__TEXT_"];

     $param_categ =  $_POST["PROP"][4]['n0']['VALUE'];
     $param_city =  $_POST["PROP"][3]['n0']['VALUE'];
         //PROP[6][1764:6][VALUE][TEXT]
         //PROP[6][n0][VALUE][TEXT]
  }  else  {

     $param_internal_code = $_POST["PROP"][2]["$myID:2"];
     $param_email=$_POST["PROP"][8]["$myID:8"];   //emailform value if already this record exist
     $param_ru_description =  $_POST["PROP"][6]["$myID:6"]['VALUE']['TEXT'];
     $param_ru_requirements = $_POST["PROP"][7]["$myID:7"]['VALUE']['TEXT'];
     $param_en_description =  $_POST["PROP"][9]["$myID:9"]['VALUE']['TEXT'];
     $param_en_requirements = $_POST["PROP"][10]["$myID:10"]['VALUE']['TEXT'];
   //$param_ru_description = $_POST["PROP_6__".$myID."_6__VALUE__TEXT_"];
   //$param_ru_requirements = $_POST["PROP_7__".$myID."_7__VALUE__TEXT_"];
  // $param_en_description = $_POST["PROP_9__".$myID."_9__VALUE__TEXT_"];
  // $param_en_requirements = $_POST["PROP_10__".$myID."_10__VALUE__TEXT_"];
   $param_categ =  $_POST["PROP"][4]["$myID:4"]['VALUE'];
   $param_city = $_POST["PROP"][3]["$myID:3"]['VALUE'];
           }
       $param_en_requirements ="вап";
        $param_en_description ="вап";
    //echo "$param_en_requirements";
 if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y" && (!$error) && empty($dontsave))
   {
      if (strlen($param_internal_code)<=0)
       {
         $error = new _CIBlockError(2, "INTERNAL_CODE_REQUIRED",  "ВВЕДЕН ПУСТОЙ INTERNAL_CODE");
         $bVarsFromForm = true;
       }
      if (strlen($param_email)<=0)
       {
         $error = new _CIBlockError(2, "EMAIL_REQUIRED",  "ВВЕДЕН ПУСТОЙ EMAIL");
         $bVarsFromForm = true;
       }
      if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $param_email))
       {
         $error = new _CIBlockError(2, "EMAIL_IS_INCORRECT",  "EMAIL НЕВЕРЕН");
         $bVarsFromForm = true;
       }
      if ($param_city==0)
       {
         $error = new _CIBlockError(2, "CITY_IS_ NOT_CHOOSEN",  "НЕ ВЫБРАН ГОРОД");
         $bVarsFromForm = true;
       }


       if ($param_categ==0)
       {
        // $error = new _CIBlockError(2, "CATEGORY_IS_NOT_CHOOSEN",  "НЕ ВЫБРАНА КАТЕГОРИЯ ВАКАНСИИ");
        // $bVarsFromForm = true;
       }

      if (($param_ru==0) and  ($param_com==0))
       {
          $error = new _CIBlockError(2, "SITE_IS_ NOT_CHOOSEN",  "НЕ ВЫБРАН САЙТ");
          $bVarsFromForm = true;
       }  else {
                  if ($param_ru>0)
                  {
                      if (strlen($param_ru_description)<=0)
                          {
                              $error = new _CIBlockError(2, "RU_DESCRIPTION_REQUIRED",  "ВВЕДЕН ПУСТОЙ RU_DESCRIPTION ЛИБО УБЕРИТЕ ГАЛКУ С RU САЙТА");
                              $bVarsFromForm = true;
                          }
                       if (strlen($param_ru_requirements)<=0)
                          {
                              $error = new _CIBlockError(2, "RU_REQUIREMENTS_REQUIRED",  "ВВЕДЕН ПУСТОЙ RU_REQUIREMENTS ЛИБО УБЕРИТЕ ГАЛКУ С RU САЙТА");
                              $bVarsFromForm = true;
                          }
                  }


                  if ($param_com>0)
                  {
                      if (strlen($param_en_description)<=0)
                          {
                              $error = new _CIBlockError(2, "EN_DESCRIPTION_REQUIRED",  "ВВЕДЕН ПУСТОЙ EN_DESCRIPTION ЛИБО УБЕРИТЕ ГАЛКУ С EN САЙТА");
                              $bVarsFromForm = true;
                          }
                       if (strlen($param_en_requirements)<=0)
                          {
                              $error = new _CIBlockError(2, "EN_REQUIREMENTS_REQUIRED",  "ВВЕДЕН ПУСТОЙ EN_REQUIREMENTS ЛИБО УБЕРИТЕ ГАЛКУ С EN САЙТА");
                              $bVarsFromForm = true;
                          }
                  }

               }
      if ($_POST["WF_STATUS_ID"]==1 && strlen($_POST["ACTIVE_FROM"])<=0)
       {
         $_POST["ACTIVE_FROM"] = date("d.m.Y H:i:s");
       }

   }






?>