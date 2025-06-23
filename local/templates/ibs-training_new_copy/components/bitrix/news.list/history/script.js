$(document).ready(function () {
    const textBlock = $('#history-item-text');

    $('.history .item').mouseenter(function () {
        let currentText = $(this).find('.item-preview-text').html();
        textBlock.html(' ').html(currentText);
    });
});