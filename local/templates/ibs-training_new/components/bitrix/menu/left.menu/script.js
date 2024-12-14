class LeftMenu
{
    constructor(data = {
        backgroundHiddenMobileMenuClass: '.background-hidden-mobile-menu',
        mobileLeftMenuBlockClass: '.mobile-left-menu-block',
        mobileSelectMenuBlockClass: '.mobile-select-menu-block'
    }) {
        this.backgroundHiddenMobileMenu = document.querySelector(data.backgroundHiddenMobileMenuClass);
        this.mobileLeftMenuBlock = document.querySelector(data.mobileLeftMenuBlockClass);
        this.mobileSelectMenuBlock = document.querySelector(data.mobileSelectMenuBlockClass);

        if (window.innerWidth < 1181) {
            this.addLeftMenuHandlerListener();   
        }
    }

    addLeftMenuHandlerListener()
    {
        if (this.mobileSelectMenuBlock) {
            this.mobileSelectMenuBlock.addEventListener('click', () => {
                if (this.mobileLeftMenuBlock && this.mobileLeftMenuBlock.classList) {
                    this.mobileLeftMenuBlock.classList.add('show');
                }

                if (this.backgroundHiddenMobileMenu && this.backgroundHiddenMobileMenu.classList) {
                    this.backgroundHiddenMobileMenu.classList.add('show');
                }
            });
        }

        if (this.backgroundHiddenMobileMenu) {
            this.backgroundHiddenMobileMenu.addEventListener('click', () => {
                if (this.mobileLeftMenuBlock && this.mobileLeftMenuBlock.classList) {
                    this.mobileLeftMenuBlock.classList.remove('show');
                }

                if (this.backgroundHiddenMobileMenu && this.backgroundHiddenMobileMenu.classList) {
                    this.backgroundHiddenMobileMenu.classList.remove('show');
                }
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new LeftMenu();
});