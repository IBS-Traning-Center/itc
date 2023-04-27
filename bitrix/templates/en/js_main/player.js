var play_state = true;
var first_index = 1;
var current_index = first_index;
var prev_index = first_index;
var id = "";
var suffix = "_";
var style_show = "";
var style_hide = "none";
var max_count = 0;
var link_prefix = "a_"
var style_active = "active";
var refresh_interval = 10;

function RotatingHeadlines(elem_id, time) {
    id = elem_id;
    refresh_interval = time;
}

function swapHeadline ()
{
	if (play_state)
	{
		prev_index = current_index;

		++current_index;
		if (current_index > max_count)
		{
			current_index = first_index;
		}
		refreshHeadline();
	}
}

function refreshHeadline () {
    if (prev_index != current_index) {
		document.getElementById(id + suffix + current_index).style.display = style_show;
		document.getElementById(link_prefix + id + suffix + current_index).className = style_active;
	    document.getElementById(id + suffix + prev_index).style.display = style_hide;
		document.getElementById(link_prefix + id + suffix + prev_index).className = "";
	}
}

function setHeadline(num) {
    if (play_state)
    {
        play_state	= false;
    }
    prev_index = current_index;
    current_index = num;
    refreshHeadline();
}

$(document).ready(function(){
     
	$('div[@id^=' + id + suffix + ']').each(function(){
        var divNum = this.id.substring ((id + suffix).length, this.id.length);
        this.style.display = (divNum == first_index) ? style_show : style_hide;

	});

	$('a[@id^=' + link_prefix + id + suffix + ']').each(function(){
        max_count++;
        var buttonNum = this.id.substring ((link_prefix + id + suffix).length, this.id.length);
        this.className = (buttonNum == first_index) ? style_active : "";

        $(this).click(function(){
		    setHeadline(buttonNum);
			this.blur();
			return false;
		});
	});
	
	if (document.getElementById (id))
	{
		window.setInterval("swapHeadline()", refresh_interval * 1000);
	}
	
});