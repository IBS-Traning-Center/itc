    function init_masha(){
        MaSha.instance = new MaSha({'select_message': 'upmsg-selectable'});
    }
    if (window.addEventListener){
        window.addEventListener('load', init_masha, false);
    } else {
        window.attachEvent('onload', init_masha);
    }

