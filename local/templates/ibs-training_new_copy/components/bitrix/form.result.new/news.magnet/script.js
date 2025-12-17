class newsMagnetFormBlock
{
    constructor(data = {
        magnetFormBtnClass: '.btn-main',
        newsMagnetFormBlockId: 'newsMagnetFormBlock'
    }) {
        this.newsMagnetFormBlock = document.getElementById(data.newsMagnetFormBlockId);
        this.magnetFormBtn = this.newsMagnetFormBlock.querySelectorAll(data.magnetFormBtnClass);

        this.addMagnetFormEventHandler();

        const urlParams = new URLSearchParams(window.location.search);
        const scrollTo = urlParams.get('scrollTo');
        
        if (scrollTo === 'newsMagnetFormBlock') {
            const element = document.getElementById('newsMagnetFormBlock');
            if (element) {
                element.scrollIntoView({});
                
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.delete('scrollTo');
                window.history.replaceState({}, document.title, newUrl.toString());
            }
        }
    }
    addMagnetFormEventHandler()
    {
        if (this.magnetFormBtn) {
            this.magnetFormBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.newsMagnetFormBlock.querySelector('#'+btn.getAttribute("data-scroll")).scrollIntoView({ block: "start", behavior: "smooth" });
                });
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new newsMagnetFormBlock();
});

/* Yandex.Metrika counter */ (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); /* /Yandex.Metrika counter */
ym(23056159, 'getClientID', function(clientID) {
    document.getElementById('clientID').value = clientID;
});