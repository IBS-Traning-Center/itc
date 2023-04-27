<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<script>
      $(document).ready(function() {      	if ( $('form[name=form_element_6_form]').length ){	      	var showActiveInput = $("form[name=form_element_6_form] input[name=ACTIVE]");
	      	var showOnSiteInput = $("form[name=form_element_6_form] tr#tr_PROPERTY_385 input[name='PROP[385][]']");
	      	var showActiveInputAttrChecked = showActiveInput.attr("checked");
	      	if (showActiveInputAttrChecked == false) {	      		showOnSiteInput.attr("disabled","disabled");	      	}			showActiveInput.change(function () {
				var bFlag = "";
				bFlag = $(this).attr("checked");
				if (bFlag){
					showOnSiteInput.attr("disabled","");
				} else {					showOnSiteInput.attr("disabled","disabled").attr("checked","");
				}
	        })
	        var typeOwnerSelect = $("form[name=form_element_6_form]  tr#tr_PROPERTY_386 select[name='PROP[386][]']");
	        var vIdOwnerSelect =  $("form[name=form_element_6_form] select[name='PROP[386][]'] option:selected").val();
	        if ((vIdOwnerSelect == 120)||(vIdOwnerSelect == 121)){	        	$("#tr_PROPERTY_42 input").attr("disabled","disabled");
	        }
	        typeOwnerSelect.change(function() {	        	vIdOwnerSelect = $(this).val();
	        	if ((vIdOwnerSelect == 120)||(vIdOwnerSelect == 121)){	            	$("#tr_PROPERTY_42 input").attr("disabled","disabled");	        	}else{	        		$("#tr_PROPERTY_42 input").attr("disabled","");	        	}
	        })
         }
		<?	global $USER;
			if (in_array(GROUP_FORBID_EXPERTS_IBLOCK_EDIT, $USER->GetUserGroupArray())){?>
			$('div#tbl_iblock_list_9203d3b0f7a363ac5065e8bdcb5d1746_result_div  td a#btn_excel').hide();
			<? } ?>		
      });

	
</script>
