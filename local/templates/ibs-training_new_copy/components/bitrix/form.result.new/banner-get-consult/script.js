class mainFeedbackFormBlock
{
    constructor(data = {
        feedbackFormBtnClass: '.btn-main',
    }) {
        this.feedbackFormBtn = document.querySelectorAll(data.feedbackFormBtnClass);

        this.addFeedbackFormEventHandler();
    }
    addFeedbackFormEventHandler()
    {
        if (this.feedbackFormBtn) {
            this.feedbackFormBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelector('#'+btn.getAttribute("data-scroll")).scrollIntoView({ block: "start", behavior: "smooth" });
                });
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new mainFeedbackFormBlock();

    
});

/* Yandex.Metrika counter */ (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); /* /Yandex.Metrika counter */
ym(23056159, 'getClientID', function(clientID) {
    document.getElementById('clientID').value = clientID;
});