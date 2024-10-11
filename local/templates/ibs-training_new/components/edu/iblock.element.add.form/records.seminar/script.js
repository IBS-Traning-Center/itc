class SeminarDetail
{
    constructor() {
        this.formWrap = document.querySelector("#register");
        this.backgroundModal = document.querySelector('.background-modal');
        this.formWrapClose = document.querySelector('.register-close');
        this.formWrapBtn = document.querySelectorAll(".seminar__order");

        this.addSeminarDetailEventHandler();
    }

    addSeminarDetailEventHandler()
    {   
        
        
        if (this.formWrapBtn) {
            
            this.formWrapBtn.forEach( btn => {
                btn.addEventListener('click', () => {
                    this.openSeminarModal();
                });
            }); 
        }

        if (this.formWrapClose) {
            this.formWrapClose.addEventListener('click', () => {
                this.closeSeminarModal();
            });
        }

        if (this.backgroundModal) {
            this.backgroundModal.addEventListener('click', () => {
                this.closeSeminarModal();
            });
        }
    }

    openSeminarModal()
    {
        if (
            this.formWrapBtn &&
            this.backgroundModal
        ) {
            this.formWrap.style.display = 'block';
            this.backgroundModal.style.display = 'block';
        }
    }

    closeSeminarModal()
    {
        if (
            this.formWrapBtn &&
            this.backgroundModal
        ) {
            this.formWrap.style.display = 'none';
            this.backgroundModal.style.display  = 'none';
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new SeminarDetail();
});