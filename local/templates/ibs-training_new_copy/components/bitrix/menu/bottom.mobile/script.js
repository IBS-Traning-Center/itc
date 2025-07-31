class BottomMobileMenu
{
    constructor(data = {
        hiddenBottomMobileMenuBlockClass: '.hidden-bottom-mobile-menu-block',
        backgroundHiddenMobileMenuClass: '.background-hidden-mobile-menu',
        moreLinksClass: '.more-links'
    }) {
        this.hiddenBottomMobileMenuBlock = document.querySelector(data.hiddenBottomMobileMenuBlockClass);
        this.backgroundHiddenMobileMenu = document.querySelector(data.backgroundHiddenMobileMenuClass);
        this.moreLinks = document.querySelector(data.moreLinksClass);

        this.addMobileMenuHandlerListener();
    }

    addMobileMenuHandlerListener()
    {
        if (this.moreLinks) {
            this.moreLinks.addEventListener('click', () => {
                if (this.hiddenBottomMobileMenuBlock && this.hiddenBottomMobileMenuBlock.classList) {
                    this.hiddenBottomMobileMenuBlock.classList.add('show');
                }

                if (this.backgroundHiddenMobileMenu && this.backgroundHiddenMobileMenu.classList) {
                    this.backgroundHiddenMobileMenu.classList.add('show');
                }
            });
        }

        if (this.backgroundHiddenMobileMenu) {
            this.backgroundHiddenMobileMenu.addEventListener('click', () => {
                if (this.hiddenBottomMobileMenuBlock && this.hiddenBottomMobileMenuBlock.classList) {
                    this.hiddenBottomMobileMenuBlock.classList.remove('show');
                }

                if (this.backgroundHiddenMobileMenu && this.backgroundHiddenMobileMenu.classList) {
                    this.backgroundHiddenMobileMenu.classList.remove('show');
                }
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new BottomMobileMenu();
});