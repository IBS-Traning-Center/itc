class SignCourseComplexDemo
{
    constructor(data = {
        closeCourseModalClass: '.close-course-modal.demo',
        backgroundModalClass: '.background-modal',
        signCourseComplexBlockCLass: '.sign-course-complex-block.demo'
    }) {
        this.closeCourseModal = document.querySelector(data.closeCourseModalClass);
        this.backgroundModal = document.querySelector(data.backgroundModalClass);
        this.signCourseComplexBlock = document.querySelector(data.signCourseComplexBlockCLass);

        this.addSignCourseEventHandler();
        this.changeFormInput();
    }

    addSignCourseEventHandler()
    {
        if (this.closeCourseModal && this.backgroundModal && this.signCourseComplexBlock) {
            this.closeCourseModal.addEventListener('click', () => {
                this.backgroundModal.style.display = 'none';
                this.signCourseComplexBlock.style.display = 'none';
            });
        }
    }

    changeFormInput()
    {
        $(document).on('change keyup input click', 'input.phone', function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new SignCourseComplexDemo();
});

/* Yandex.Metrika counter */ (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); /* /Yandex.Metrika counter */

ym(23056159, 'getClientID', function(clientID) {
    document.getElementById('clientID').value = clientID;
});