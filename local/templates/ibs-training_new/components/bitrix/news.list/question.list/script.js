class QuestionAcord
{
    constructor() {
        this.accBtn = document.getElementsByClassName('question-item-name');
        this.initAcord();
    }

    initAcord()
    {   
        let accBtn = this.accBtn;
        let i;
        for (i = 0; i < accBtn.length; i++) {
            accBtn[i].addEventListener("click", function() {
                this.classList.toggle("active");
                let anserWrap = this.nextElementSibling;
                if (anserWrap.style.maxHeight) {
                    anserWrap.style.maxHeight = null;
                } else {
                    anserWrap.style.maxHeight = anserWrap.scrollHeight + "px";
                }
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new QuestionAcord();
});