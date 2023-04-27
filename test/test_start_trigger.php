<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
class SenderTriggerTestNotFinished extends \Bitrix\Sender\TriggerConnectorClosed
{
   /*
    * @return string
    *
    * Название триггера
    */
   public function getName()
   {
      return 'Начал тест, но не закончил';
   }

   /*
    * @return string
    *
    * Уникальный код триггера
    */
   public function getCode()
   {
      return "not_finished_course";
   }

   /*
    * @return bool
    *
    * Может ли триггер использоваться как цель,
    * а не только для запуска
    */
   public static function canBeTarget()
   {
      return false;
   }

   /*
    * @return bool
    *
    * Функция, которая сообщает, запускать ли рассылку для данного события.
    *
    */
   public function filter()
   {
        if (CModule::IncludeModule("learning"))
		{
			$res = CTestAttempt::GetList(
				Array("ID" => "ASC"), 
				Array("STATUS" => "B", "<DATE_START"=> date("d.m.Y")." 00:00:00", ">DATE_START"=> date("d.m.Y", strtotime('-1 day'))." 00:00:00")
				
		
			);

			$arUnique=array();
			while ($arAttempt = $res->GetNext())
			{
			
					//print_r($arAttempt);
					$rsUser = CUser::GetByID($arAttempt["USER_ID"]);
					$arUser = $rsUser->Fetch();
					if (!in_array($arUser["ID"], $arUnique)) {
						$userListDb[]=array("NAME"=> $arUser["NAME"], "EMAIL"=> $arUser["EMAIL"], "USER_ID"=>$arUser["ID"]);
						$arUnique[]=$arUser["ID"];
					}
					
			}
		
			if (count($userListDb)>0) {
				$this->recipient = $userListDb;
				print_r($this->recipient);
				return true;
			}
			else
			{
				return false;
			}
		}
   }


   /*
    * @return string
    *
    * Форма настройки триггера
    */
   

   /*
    * @return array|\Bitrix\Main\DB\Result|\CDBResult
    *
    * Функция, которая из данных события
    * вернет данные о получателе рассылки
    */
   public function getRecipient()
   {
      // возвращаем сохраненные адресаты
      return $this->recipient;
   }
}

$rec = new SenderTriggerTestNotFinished;
$rec->filter();?>