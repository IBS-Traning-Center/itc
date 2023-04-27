<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$t_COL=array("00","33","66","99","CC","FF");
?>
<div id="ColorPick" style="visibility:hidden;position:absolute;top:0;left:0 ">
<table cellspacing="0" cellpadding="1" border="0" bgcolor="#666666">
<tr>
<td>
<table cellspacing="1" cellpadding="0" border="0" bgcolor="#FFFFFF">
<?
for($i=0;$i<216;$i++) 
{

$t_R=$i%6;
$t_G=floor($i/36)%6;
$t_B=floor($i/6)%6;

$t_curCOL="#".$t_COL[$t_R].$t_COL[$t_G].$t_COL[$t_B];
echo ($i%18==0) ? "<tr>" : "";
echo "<td bgcolor='".$t_curCOL."' onmousedown=\"alterfont('".$t_curCOL,"','COLOR')\"><img src=/bitrix/images/1.gif border=0 width=10 height=10></td>";
}
?>
</table>
</td>
</tr>
</table></div>

<script language=JavaScript>
var text_enter_url = "<?echo GetMessage("BPC_TEXT_ENTER_URL");?>";
var text_enter_url_name = "<?echo GetMessage("BPC_TEXT_ENTER_URL_NAME");?>";
var text_enter_image = "<?echo GetMessage("BPC_TEXT_ENTER_IMAGE");?>";
var list_prompt = "<?echo GetMessage("BPC_LIST_PROMPT");?>";
var error_no_url = "<?echo GetMessage("BPC_ERROR_NO_URL");?>";
var error_no_title = "<?echo GetMessage("BPC_ERROR_NO_TITLE");?>";

function ShowImageUpload()
{
	win = window.open(null,null,'height=150,width=400');
	<?
		$L = explode("\n",$image_form);
		foreach($L as $line)
		{
			$line = str_replace('"','\"',$line);
			$line = str_replace("\n",'\n',$line);
			$line = str_replace("\r",'\n',$line);
			echo "win.document.write(\"".$line."\");\n";
		}
	?>
	win.document.close();
}

var last_div = '';
function showComment(key, subject, error, comment, userName, userEmail)
{
	if(!imgLoaded)
	{
		if(comment)
		{
			comment = comment.replace(/\n/g, '\\n');
			comment = comment.replace(/'/g, "\\'");
			comment = comment.replace(/"/g, '\\"');
		}
		else
			comment = '';
		setTimeout("showComment('"+key+"', '"+subject+"', '"+error+"', '"+comment+"', '"+userName+"', '"+userEmail+"')", 500);
	}
	else
	{
		<?
		if($arResult["use_captcha"]===true)
		{
			?>
			var im = document.getElementById('captcha');
			document.getElementById('captcha_del').appendChild(im);
			<?
		}
		?>
		var cl = document.getElementById('form_c_del').cloneNode(true);
		var ld = document.getElementById('form_c_del');
		ld.parentNode.removeChild(ld);
		document.getElementById('form_comment_' + key).appendChild(cl);
		document.getElementById('form_c_del').style.display = "block";
		document.form_comment.parentId.value = key;
		document.form_comment.edit_id.value = '';
		document.form_comment.act.value = 'add';
		document.form_comment.post.value = '<?=GetMessage("B_B_MS_SEND")?>';

		document.form_comment.action = document.form_comment.action+"#"+key;

		<?
		if($arResult["use_captcha"]===true)
		{
			?>
			var im = document.getElementById('captcha');
			document.getElementById('div_captcha').appendChild(im);
			im.style.display = "block";
			<?
		}
		?>

		if(error == "Y")
		{
			if(comment.length > 0)
			{
				comment = comment.replace(/\/</gi, '<');
				comment = comment.replace(/\/>/gi, '>');
				document.form_comment.comment.value = comment;
			}
			if(userName.length > 0)
			{
				userName = userName.replace(/\/</gi, '<');
				userName = userName.replace(/\/>/gi, '>');
				document.form_comment.user_name.value = userName;
			}
			if(userEmail.length > 0)
			{
				userEmail = userEmail.replace(/\/</gi, '<');
				userEmail = userEmail.replace(/\/>/gi, '>');
				document.form_comment.user_email.value = userEmail;
			}
			if(subject.length>0 && document.form_comment.subject)
			{
				subject = subject.replace(/\/</gi, '<');
				subject = subject.replace(/\/>/gi, '>');
				document.form_comment.subject.value = subject;
			}
		}
		last_div = key;
	}
	//document.form_comment.comment.focus();
	return false;
}

function editComment(key, subject, comment)
{
	if(!imgLoaded)
	{
		comment = comment.replace(/\n/g, '\\n');
		comment = comment.replace(/'/g, "\\'");
		comment = comment.replace(/"/g, '\\"');
		setTimeout("editComment('"+key+"', '"+subject+"', '"+comment+"')", 500);
	}
	else
	{
		var cl = document.getElementById('form_c_del').cloneNode(true);
		var ld = document.getElementById('form_c_del');
		ld.parentNode.removeChild(ld);
		document.getElementById('form_comment_' + key).appendChild(cl);
		document.getElementById('form_c_del').style.display = "block";
		document.form_comment.edit_id.value = key;
		document.form_comment.act.value = 'edit';
		document.form_comment.post.value = '<?=GetMessage("B_B_MS_SAVE")?>';
		document.form_comment.action = document.form_comment.action+"#"+key;

		if(comment.length > 0)
		{
			comment = comment.replace(/\/</gi, '<');
			comment = comment.replace(/\/>/gi, '>');
			document.form_comment.comment.value = comment;
		}
		if(subject.length>0 && document.form_comment.subject)
		{
			subject = subject.replace(/\/</gi, '<');
			subject = subject.replace(/\/>/gi, '>');
			document.form_comment.subject.value = subject;
		}
		last_div = key;
	}
	
	return false;
}
</script>