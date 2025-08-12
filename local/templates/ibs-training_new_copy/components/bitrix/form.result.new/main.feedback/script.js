class mainFeedbackFormBlock
{
    constructor(data = {
        feedbackFormBtnClass: '.btn-main',
        mainFeedbackFormBlockId: 'mainFeedbackFormBlock'
    }) {
        this.mainFeedbackFormBlock = document.getElementById(data.mainFeedbackFormBlockId);
        this.feedbackFormBtn = this.mainFeedbackFormBlock.querySelectorAll(data.feedbackFormBtnClass);

        this.addFeedbackFormEventHandler();

        const urlParams = new URLSearchParams(window.location.search);
        const scrollTo = urlParams.get('scrollTo');
        
        if (scrollTo === 'mainFeedbackFormBlock') {
            const element = document.getElementById('mainFeedbackFormBlock');
            if (element) {
                element.scrollIntoView({});
                
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.delete('scrollTo');
                window.history.replaceState({}, document.title, newUrl.toString());
            }
        }
    }
    addFeedbackFormEventHandler()
    {
        if (this.feedbackFormBtn) {
            this.feedbackFormBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.mainFeedbackFormBlock.querySelector('#'+btn.getAttribute("data-scroll")).scrollIntoView({ block: "start", behavior: "smooth" });
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