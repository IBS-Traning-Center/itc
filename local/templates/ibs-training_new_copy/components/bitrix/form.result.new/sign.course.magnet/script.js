class SignCourseMagnet
{
    constructor(data = {
        closeCourseMagnetModalClass: '.close-course-magnet-modal',
        backgroundModalClass: '.background-modal',
        signCourseMagnetBlockCLass: '.sign-course-magnet-block'
    }) {
        this.closeCourseMagnetModal = document.querySelector(data.closeCourseMagnetModalClass);
        this.backgroundModal = document.querySelector(data.backgroundModalClass);
        this.signCourseMagnetBlock = document.querySelector(data.signCourseMagnetBlockCLass);

        this.addSignCourseEventHandler();
        this.changeFormInput();
    }

    addSignCourseEventHandler()
    {
        if (this.closeCourseMagnetModal && this.backgroundModal && this.signCourseMagnetBlock) {
            this.closeCourseMagnetModal.addEventListener('click', () => {
                this.backgroundModal.style.display = 'none';
                this.signCourseMagnetBlock.style.display = 'none';
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
    new SignCourseMagnet();
});

/* Yandex.Metrika counter */ (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); /* /Yandex.Metrika counter */

ym(23056159, 'getClientID', function(clientID) {
    document.getElementById('clientID').value = clientID;
});