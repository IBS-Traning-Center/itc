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