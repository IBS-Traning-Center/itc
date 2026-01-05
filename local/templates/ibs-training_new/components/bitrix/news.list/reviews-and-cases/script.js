$(document).ready(function () {
    setTimeout(() => {
        if($('.reviews__item__text').length > 0) {
            $('.reviews__item__text').each(function (index, el) { 
                let textBoxBtn = $(el).find('.readmore');
            
                if (el.scrollHeight > el.clientHeight) {
                    textBoxBtn.css('display', 'inline-flex');
        
                    // textBoxBtn.on('click', function(e) {
                    //     e.prev();
                    //     $(el).css({
                    //         'max-height': 'none',
                    //         'overflow': 'visible',
                    //         'position': 'static'
                    //     });
                    //     textBoxBtn.hide();
                    // });
                }
            });
        }
    }, 1000);
});