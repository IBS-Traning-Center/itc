function initDOB(item,val) {
	
	if (item.value == val) {
		item.value = '';
	} else {
		if (item.value=='')
			item.value = val;
	}
	
}

function iEnable(item) {
	
	$(item).children('input').attr('checked','checked');
	$(item).parent().prev().children('input').attr('disabled',false).removeClass('disabled');
	$(item).hide();
}