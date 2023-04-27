<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/luxoft/fix/CIBlockPropertyElementListGeopoint.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/luxoft/fix/CIBlockPropertyElementListGeopointTypes.php");

function _ShowGeopoints($name, $property_fields, $values, $bInitDef = false, $bVarsFromForm = false, $max_file_size_show=50000, $form_name = "form_element")
{
	global $bCopy;
	$start = 0;

	if(!is_array($property_fields["~VALUE"]))
		$values = Array();
	else
		$values = $property_fields["~VALUE"];
	unset($property_fields["VALUE"]);
	unset($property_fields["~VALUE"]);

	$html = '<table cellpadding="0" cellspacing="0" border="0" class="nopadding" width="100%" id="tb'.md5($name).'">';
	$arUserType = CIBlockProperty::GetUserType($property_fields["USER_TYPE"]);
	$max_val = -1;
	if(($arUserType["PROPERTY_TYPE"] !== "F") || (!$bCopy))
	{
		foreach($values as $key=>$val)
		{
			if($bCopy)
			{
				$key = "n".$start;
				$start++;
			}

			if(!is_array($val) || !array_key_exists("VALUE",$val))
				$val = array("VALUE"=>$val, "DESCRIPTION"=>"");

			$html .= '<tr><td>';
			if(array_key_exists("GetPropertyFieldHtml", $arUserType)) {
				//print_r($arUserType["GetPropertyFieldHtml"]);
				$html .= call_user_func_array($arUserType["GetPropertyFieldHtml"],
					array(
						$property_fields,
						$val,
						array(
							"VALUE"=>'PROP['.$property_fields["ID"].']['.$key.'][VALUE]',
							"DESCRIPTION"=>'PROP['.$property_fields["ID"].']['.$key.'][DESCRIPTION]',
							"FORM_NAME"=>$form_name,
							"MODE"=>"FORM_FILL"
						),
					));
			} else
				$html .= '&nbsp;';
			$html .= '</td></tr>';

			if(substr($key, -1, 1)=='n' && $max_val < intval(substr($key, 1)))
				$max_val = intval(substr($key, 1));
			if($property_fields["MULTIPLE"] != "Y")
			{
				$bVarsFromForm = true;
				break;
			}
		}
	}

	if(!$bVarsFromForm)
	{
		$MULTIPLE_CNT = IntVal($property_fields["MULTIPLE_CNT"]);
		$cnt = ($property_fields["MULTIPLE"]=="Y"? ($MULTIPLE_CNT>0 && $MULTIPLE_CNT<=30 ? $MULTIPLE_CNT : 5) : 1);
		for($i=$max_val+1; $i<$max_val+1+$cnt; $i++)
		{
			$val = array("VALUE"=>$property_fields["DEFAULT_VALUE"], "DESCRIPTION"=>"");
			$key = "n".($start + $i);

			$html .= '<tr><td>';
			if(array_key_exists("GetPropertyFieldHtml", $arUserType)) {
				//print_r($arUserType["GetPropertyFieldHtml"]);
				//print_r($property_fields);
				$html .= call_user_func_array(array("CIBlockPropertyElementListGeopoint", "GetPropertyFieldHtml"),
					array(
						$property_fields,
						$val,
						array(
							"VALUE"=>'PROP['.$property_fields["ID"].']['.$key.'][VALUE]',
							"DESCRIPTION"=>'PROP['.$property_fields["ID"].']['.$key.'][DESCRIPTION]',
							"FORM_NAME"=>$form_name,
							"MODE"=>"FORM_FILL"
						),
					));
			} else
				$html .= '&nbsp;';
			$html .= '</td></tr>';
		}
		$max_val += $cnt;
	}
	if($property_fields["MULTIPLE"]=="Y")
	{
		$html .= '<tr><td><input type="button" value="'.GetMessage("IBLOCK_ELEMENT_EDIT_PROP_ADD").'" onClick="addNewRow(\'tb'.md5($name).'\')"></td></tr>';
	}
	$html .= '</table>';
	echo $html;
}


function _ShowGeopointsTypes($name, $property_fields, $values, $bInitDef = false, $bVarsFromForm = false, $max_file_size_show=50000, $form_name = "form_element")
{
	global $bCopy;
	$start = 0;

	if(!is_array($property_fields["~VALUE"]))
		$values = Array();
	else
		$values = $property_fields["~VALUE"];
	unset($property_fields["VALUE"]);
	unset($property_fields["~VALUE"]);

	$html = '<table cellpadding="0" cellspacing="0" border="0" class="nopadding" width="100%" id="tb'.md5($name).'">';
	$arUserType = CIBlockProperty::GetUserType($property_fields["USER_TYPE"]);
	$max_val = -1;
	if(($arUserType["PROPERTY_TYPE"] !== "F") || (!$bCopy))
	{
		foreach($values as $key=>$val)
		{
			if($bCopy)
			{
				$key = "n".$start;
				$start++;
			}

			if(!is_array($val) || !array_key_exists("VALUE",$val))
				$val = array("VALUE"=>$val, "DESCRIPTION"=>"");

			$html .= '<tr><td>';
			if(array_key_exists("GetPropertyFieldHtml", $arUserType)) {
				//print_r($arUserType["GetPropertyFieldHtml"]);
				$html .= call_user_func_array(array("CIBlockPropertyElementListGeopointTypes", "GetPropertyFieldHtml"),
					array(
						$property_fields,
						$val,
						array(
							"VALUE"=>'PROP['.$property_fields["ID"].']['.$key.'][VALUE]',
							"DESCRIPTION"=>'PROP['.$property_fields["ID"].']['.$key.'][DESCRIPTION]',
							"FORM_NAME"=>$form_name,
							"MODE"=>"FORM_FILL"
						),
					));
			} else
				$html .= '&nbsp;';
			$html .= '</td></tr>';

			if(substr($key, -1, 1)=='n' && $max_val < intval(substr($key, 1)))
				$max_val = intval(substr($key, 1));
			if($property_fields["MULTIPLE"] != "Y")
			{
				$bVarsFromForm = true;
				break;
			}
		}
	}

	if(!$bVarsFromForm)
	{
		$MULTIPLE_CNT = IntVal($property_fields["MULTIPLE_CNT"]);
		$cnt = ($property_fields["MULTIPLE"]=="Y"? ($MULTIPLE_CNT>0 && $MULTIPLE_CNT<=30 ? $MULTIPLE_CNT : 5) : 1);
		for($i=$max_val+1; $i<$max_val+1+$cnt; $i++)
		{
			$val = array("VALUE"=>$property_fields["DEFAULT_VALUE"], "DESCRIPTION"=>"");
			$key = "n".($start + $i);

			$html .= '<tr><td>';
			if(array_key_exists("GetPropertyFieldHtml", $arUserType)) {
				//print_r($arUserType["GetPropertyFieldHtml"]);
				//print_r($property_fields);
				$html .= call_user_func_array(array("CIBlockPropertyElementListGeopointTypes", "GetPropertyFieldHtml"),
					array(
						$property_fields,
						$val,
						array(
							"VALUE"=>'PROP['.$property_fields["ID"].']['.$key.'][VALUE]',
							"DESCRIPTION"=>'PROP['.$property_fields["ID"].']['.$key.'][DESCRIPTION]',
							"FORM_NAME"=>$form_name,
							"MODE"=>"FORM_FILL"
						),
					));
			} else
				$html .= '&nbsp;';
			$html .= '</td></tr>';
		}
		$max_val += $cnt;
	}
	if($property_fields["MULTIPLE"]=="Y")
	{
		$html .= '<tr><td><input type="button" value="'.GetMessage("IBLOCK_ELEMENT_EDIT_PROP_ADD").'" onClick="addNewRow(\'tb'.md5($name).'\')"></td></tr>';
	}
	$html .= '</table>';
	echo $html;
}

function _ShowGroupPropertyField_custom($name, $property_fields, $values)
{
//	print "<PRE>";
//	print_r($property_fields);
//	print "</PRE>";
	if(!is_array($values)) $values = Array();

	$res = "";
	$bWas = false;
	$sections = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>$property_fields["LINK_IBLOCK_ID"]));
	while($ar = $sections->GetNext())
	{
		if ($ar["DEPTH_LEVEL"]==1){
		$res .= '<option value="'.$ar["ID"].'"';
		if(in_array($ar["ID"], $values))
		{
			$bWas = true;
			$res .= ' selected';
		}

		$res .= '>'.$ar["NAME"].'</option>';
		}
	}
	//echo '<select name="'.$name.'[]" size="'.$property_fields["MULTIPLE_CNT"].'" '.($property_fields["MULTIPLE"]=="Y"?"multiple":"").'>';
	print_r($ar);
	echo '<select id="types_section" name="'.$name.'[]" size="1">';
	echo '<option value=""'.(!$bWas?' selected':'').'>'.GetMessage("IBLOCK_ELEMENT_EDIT_NOT_SET").'</option>';
	echo $res;
	echo '</select>';
}
function _ShowPropertyField2($name, $property_fields, $values, $bInitDef = false, $bVarsFromForm = false, $max_file_size_show = 50000, $form_name = "form_element")
{
	$type = $property_fields["PROPERTY_TYPE"];
	if($property_fields["USER_TYPE"]!="")
		_ShowUserPropertyField($name, $property_fields, $values, $bInitDef, $bVarsFromForm, $max_file_size_show, $form_name);
	elseif($type=="L") //list property
		_ShowListPropertyField($name, $property_fields, $values, $bInitDef);
	elseif($type=="F") //file property
		_ShowFilePropertyField($name, $property_fields, $values, $max_file_size_show, $bVarsFromForm);
	elseif($type=="G") //section link
	{
		if(function_exists("_ShowGroupPropertyField_custom"))
			_ShowGroupPropertyField_custom($name, $property_fields, $values, $bVarsFromForm);
		else
			_ShowGroupPropertyField($name, $property_fields, $values, $bVarsFromForm);
	}
	elseif($type=="E") //element link
		_ShowElementPropertyField($name, $property_fields, $values, $bVarsFromForm);
	else
		_ShowStringPropertyField2($name, $property_fields, $values, $bInitDef, $bVarsFromForm);
}


function _ShowStringPropertyField2($name, $property_fields, $values, $bInitDef = false, $bVarsFromForm = false)
{
	global $bCopy;
	$start = 0;
   echo "PRIVED";
    echo "<div id=\"types_of_section\">";
	echo '<table cellpadding="0" cellspacing="0" border="0" class="nopadding" width="100%" id="tb'.md5($name).'">';

	$rows = $property_fields["ROW_COUNT"];
	$cols = $property_fields["COL_COUNT"];

	if($property_fields["WITH_DESCRIPTION"]=="Y")
		$strAddDesc = "[VALUE]";
	else
		$strAddDesc = "";

	if(!is_array($values)) $values = Array();
	foreach($values as $key=>$val)
	{
		if($bCopy)
		{
			$key = "n".$start;
			$start++;
		}
		echo '<tr><td>';
		$val_description = "";
		if(is_array($val) && is_set($val, "VALUE"))
		{
			$val_description = $val["DESCRIPTION"];
			$val = $val["VALUE"];
		}
		if($rows>1)
			echo '<textarea name="'.$name.'['.$key.']'.$strAddDesc.'" cols="'.$cols.'" rows="'.$rows.'">'.htmlspecialcharsex($val).'</textarea>';
		else
			echo '<input name="'.$name.'['.$key.']'.$strAddDesc.'" value="'.htmlspecialcharsex($val).'" size="'.$cols.'" type="text">';

		if($property_fields["WITH_DESCRIPTION"]=="Y")
			echo ' <span title="'.GetMessage("IBLOCK_ELEMENT_EDIT_PROP_DESC").'">'.GetMessage("IBLOCK_ELEMENT_EDIT_PROP_DESC_1").'<input name="'.$name.'['.$key.'][DESCRIPTION]" value="'.htmlspecialcharsex($val_description).'" size="18" type="text" id="'.$name.'['.$key.'][DESCRIPTION]"></span>';

		echo "<br>";
		echo '</td></tr>';

		if($property_fields["MULTIPLE"]!="Y")
		{
			$bVarsFromForm = true;
			break;
		}
	}

	if(!$bVarsFromForm)
	{
		$val_description = "";
		$MULTIPLE_CNT = IntVal($property_fields["MULTIPLE_CNT"]);
		$cnt = ($property_fields["MULTIPLE"]=="Y"? ($MULTIPLE_CNT>0 && $MULTIPLE_CNT<=30 ? $MULTIPLE_CNT : 5) + ($bInitDef && strlen($property_fields["DEFAULT_VALUE"])>0?1:0) : 1);
		for($i=0; $i<$cnt;$i++)
		{
			echo '<tr><td>';
			if($i==0 && $bInitDef && strlen($property_fields["DEFAULT_VALUE"])>0)
				$val = $property_fields["DEFAULT_VALUE"];
			else
				$val = "";

			if($rows>1)
				echo '<textarea name="'.$name.'[n'.($start + $i).']'.$strAddDesc.'" cols="'.$cols.'" rows="'.$rows.'">'.htmlspecialcharsex($val).'</textarea>';
			else
				echo '<input name="'.$name.'[n'.($start + $i).']'.$strAddDesc.'" value="'.htmlspecialcharsex($val).'" size="'.$cols.'" type="text">';

			if($property_fields["WITH_DESCRIPTION"]=="Y")
				echo ' <span title="'.GetMessage("IBLOCK_ELEMENT_EDIT_PROP_DESC").'">'.GetMessage("IBLOCK_ELEMENT_EDIT_PROP_DESC_1").'<input name="'.$name.'[n'.($start + $i).'][DESCRIPTION]" value="'.htmlspecialcharsex($val_description).'" size="18" type="text"></span>';

			echo "<br>";
			echo '</td></tr>';
		}
	}
	if($property_fields["MULTIPLE"]=="Y")
	{
		echo '<tr><td><input type="button" value="'.GetMessage("IBLOCK_ELEMENT_EDIT_PROP_ADD").'" onClick="addNewRow(\'tb'.md5($name).'\')"></td></tr>';
	}

	echo '</table>';
	echo '</div>';
}



?>