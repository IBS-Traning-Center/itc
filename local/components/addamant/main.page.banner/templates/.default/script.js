class MainPageBanner
{
    constructor(data = {
        menuBlockClass: '.main-page-banner-menu',
        mainBlockClass: '.main-page-banner-block',
        mainMenuItemClass: '.main-page-banner-menu_item'
    }) {

        this.menuBlock = document.querySelector(data.menuBlockClass);
        this.mainBlock = document.querySelector(data.mainBlockClass);
        this.mainMenuItem = document.querySelectorAll(data.mainMenuItemClass);

        if (this.menuBlock && window.innerWidth > 1180) {
            this.mainMenuItem.forEach(element => {
                element.addEventListener('mouseover', () => {
                    this.changeMainPhoto(element);
                });
            });
        }
    }

    changeMainPhoto(elem)
    {
        let menuBlockItem = this.mainMenuItem;
        menuBlockItem.forEach(element => {
           if (element.classList) {
               element.classList.remove('active');
           }
        });

        if (elem.classList) {
            elem.classList.add('active');
        }

        let imageLink = elem.dataset.image;
        let mainBlock = this.mainBlock;

        if (imageLink) {
            mainBlock.style.backgroundImage = 'url("' + imageLink + '")';
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new MainPageBanner();
});