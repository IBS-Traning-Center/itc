<?
  $myID=$_POST[ID];
//phpinfo();
  //echo "$myID";

     $param_ru = $_POST["PROP"][11][0];
     $param_com = $_POST["PROP"][12][0];
     $param_city =  $_POST["PROP"][3][0];
     $param_categ =  $_POST["PROP"][4][0];
     $param_hot =  $_POST["PROP"][5][0];
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

  }  else  {

     $param_internal_code = $_POST["PROP"][2]["$myID:2"];
     $param_email=$_POST["PROP"][8]["$myID:8"];   //emailform value if already this record exist
     $param_ru_description =  $_POST["PROP"][6]["$myID:6"]['VALUE']['TEXT'];
     $param_ru_requirements = $_POST["PROP"][7]["$myID:7"]['VALUE']['TEXT'];
     $param_en_description =  $_POST["PROP"][9]["$myID:9"]['VALUE']['TEXT'];
     $param_en_requirements = $_POST["PROP"][10]["$myID:10"]['VALUE']['TEXT'];
           }

    //echo "$param_en_requirements";
 if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y" && (!$error) && empty($dontsave))
   {
      if (strlen($param_internal_code)<=0)
       {
         $error = new _CIBlockError(2, "INTERNAL_CODE_REQUIRED",  "ВВЕДЕН ПУСТОЙ INTERNAL_CODE");
       }
      if (strlen($param_email)<=0)
       {
         $error = new _CIBlockError(2, "EMAIL_REQUIRED",  "ВВЕДЕН ПУСТОЙ EMAIL");
       }
      if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $param_email))
       {
         $error = new _CIBlockError(2, "EMAIL_IS_INCORRECT",  "EMAIL НЕВЕРЕН");
       }
      if ($param_city==0)
       {
         $error = new _CIBlockError(2, "CITY_IS_ NOT_CHOOSEN",  "НЕ ВЫБРАН ГОРОД");
       }


       if ($param_categ==0)
       {
         $error = new _CIBlockError(2, "CATEGORY_IS_NOT_CHOOSEN",  "НЕ ВЫБРАНА КАТЕГОРИЯ ВАКАНСИИ");
       }

      if (($param_ru==0) and  ($param_com==0))
       {
          $error = new _CIBlockError(2, "SITE_IS_ NOT_CHOOSEN",  "НЕ ВЫБРАН САЙТ");
       }  else {
                  if ($param_ru>0)
                  {
                      if (strlen($param_ru_description)<=0)
                          {
                              $error = new _CIBlockError(2, "RU_DESCRIPTION_REQUIRED",  "ВВЕДЕН ПУСТОЙ RU_DESCRIPTION ЛИБО УБЕРИТЕ ГАЛКУ С RU САЙТА");
                          }
                       if (strlen($param_ru_requirements)<=0)
                          {
                              $error = new _CIBlockError(2, "RU_REQUIREMENTS_REQUIRED",  "ВВЕДЕН ПУСТОЙ RU_REQUIREMENTS ЛИБО УБЕРИТЕ ГАЛКУ С RU САЙТА");
                          }
                  }


                  if ($param_com>0)
                  {
                      if (strlen($param_en_description)<=0)
                          {
                              $error = new _CIBlockError(2, "EN_DESCRIPTION_REQUIRED",  "ВВЕДЕН ПУСТОЙ EN_DESCRIPTION ЛИБО УБЕРИТЕ ГАЛКУ С EN САЙТА");
                          }
                       if (strlen($param_en_requirements)<=0)
                          {
                              $error = new _CIBlockError(2, "EN_REQUIREMENTS_REQUIRED",  "ВВЕДЕН ПУСТОЙ EN_REQUIREMENTS ЛИБО УБЕРИТЕ ГАЛКУ С EN САЙТА");
                          }
                  }

               }
      if ($_POST["WF_STATUS_ID"]==1 && strlen($_POST["ACTIVE_FROM"])<=0)
       {
         $_POST["ACTIVE_FROM"] = date("d.m.Y H:i:s");
       }

   }


/*  echo "param_internal_code = $param_internal_code <br>";
  echo "param_ru = $param_ru <br>";
  echo "param_com = $param_com <br>";
  echo "param_city = $param_city <br>";
  echo "param_categ = $param_categ <br>";
  echo "param_hot = $param_hot <br>";
  echo "param_email = $param_email <br>";
  echo "param_ru_description = $param_ru_description <br>";
  echo "param_ru_requirements = $param_ru_requirements <br>";
  echo "param_en_description = $param_en_description <br>";
  echo "param_en_requirements = $param_en_requirements <br>";
  echo "dontsave = $dontsave <br>";*/
//   if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y" && (!$error) && empty($dontsave) && strlen($form_email)<=0)
//    {
//     $error = new _CIBlockError(2, "EMAIL_REQUIRED",  $form_email . " ВВЕДЕН ПУСТОЙ EMAIL");
//    }




?>
